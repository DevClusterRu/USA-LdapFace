<?php namespace App\Controllers;

use App\Libraries\LdapChannelLibrary;
use \App\Models\Company;
use \App\Models\Server;


class CompanyController extends BaseController
{
    //Здесь мы создаем свойство класса companys  оно будет содержать модель таблицы companys
    protected $companys;
    protected $data;
    protected $servers;

    //Метод __construct() - это конструктор класса, этот метод вызывается 1 раз при обращении к классу (при создании объекта класса)
    public function __construct()
    {
        if (!$this->isSuper()) { //условия для ограничения просмотра роута, запрет
            header("Location: /");
            exit();
        }
        //Заполняем companys объектом таблицы
        $this->companys = new Company();
        $this->servers = new server();
        $this->data["page_name"] = "Компании";
        $this->data ["servers"] = $this->servers->findAll();
    }

    public function index()
    {
        $this->isAuth();
        //Не используем билдер, подключаемся к модели Companys и применяем метод findAll() (все записи)
        $this->data ["companys"] = $this->companys
            ->join('servers', 'companys.server_id = servers.id')
            ->select('companys.id, companys.name, companys.inn, companys.kpp, companys.server_id, servers.domain as server_domain, servers.baseDn as server_baseDn')
            ->where('companys.deleted_at IS NULL')
            ->get()
            ->getResultArray();

        return view('dashboard/companys', $this->data);
    }

    //Теперь у нас всего 1 метод управления страницей, он умеет обрабатывать все нужные нам ПОСТ запросы
    public function operation()
    {
        //Из контроллера можно напрямую обращаться в $this->request, не инициализируя его
        if ($this->request->getPost("delete")) {
            if (!$this->request->getPost("checkboxDel")) {
                header("Location: /companys");
            }
            foreach ($this->request->getPost("checkboxDel") as $item) {

                $companInfo = $this->companys->where('id', $item)->first();
                $servInfo = $this->servers->where('id', $companInfo["server_id"])->first();
//                //здесь отправить запрос в лдап на удаление компании
//                echo "<pre>";
//                var_dump($servInfo["domain"],"OU=".$companInfo["name"].",".$servInfo["baseDn"]);
//                die();

                $resp1 = LdapChannelLibrary::deleteObject($servInfo["domain"], "OU=" . $companInfo["name"] . " - Группы доступа" . "," . "OU=" . $companInfo["name"] . "," . $servInfo["baseDn"]);
                $resp1Json = json_decode($resp1->getBody());
                if ($resp1Json->result == false) {  //логирование

                    header("Location: /companys?error=delCompanyExists");
                    exit();
                }
                $resp2 = LdapChannelLibrary::deleteObject($servInfo["domain"], "OU=" . $companInfo["name"] . " - Пользователи" . "," . "OU=" . $companInfo["name"] . "," . $servInfo["baseDn"]);
                $resp2Json = json_decode($resp2->getBody());
                if ($resp2Json->result == false) {
                    header("Location: /companys?error=delCompanyExists");
                    exit();
                }

                $resp3 = LdapChannelLibrary::deleteObject($servInfo["domain"], "OU=" . $companInfo["name"] . "," . $servInfo["baseDn"]);
                $resp3Json = json_decode($resp3->getBody());
                if ($resp3Json->result == false) {
                    header("Location: /companys?error=delCompanyExists");
                    exit();
                }
                $this->companys->delete($item);
            }
            header("Location: /companys");
        }

        if ($this->request->getPost("addEdit")) {
            if ($this->request->getPost("id")) {
                $this->companys
                    ->update($this->request->getPost("id"), [
                        'name' => $this->request->getPost("name"),
                        'inn' => $this->request->getPost("inn"),
                        'kpp' => $this->request->getPost("kpp"),
                        'server_id' => $this->request->getPost("server"),
                    ]);
                header("Location: /companys");
            } else {

                $servInfo = $this->servers->where('id', $this->request->getPost("server"))->first();

                //Creating company in LDAP
                $checkOne = LdapChannelLibrary::createOrganization($servInfo["domain"], $servInfo["baseDn"], $this->request->getPost("name"));
                //check answer!

                $checkOneJson = json_decode($checkOne->getBody());

                if ($checkOneJson->result == false) {
                    header("Location: /companys?error=companyExists");
                    exit();
                }
                $checkTwo = LdapChannelLibrary::createOrganization($servInfo["domain"], "OU=" . $this->request->getPost("name") . "," . $servInfo["baseDn"], $this->request->getPost("name") . " - Группы доступа");
                //check answer!
//                                echo "<pre>";
//                var_dump($checkTwo->getBody());
//                die();

                $checkTwoJson = json_decode($checkTwo->getBody());
                if ($checkTwoJson->result == false) {
                    header("Location: /companys?error=companyExists");
                    exit();
                }
                $checkThree = LdapChannelLibrary::createOrganization($servInfo["domain"], "OU=" . $this->request->getPost("name") . "," . $servInfo["baseDn"], $this->request->getPost("name") . " - Пользователи");
                $checkThreeJson = json_decode($checkThree->getBody());
                if ($checkThreeJson->result == false) {
                    header("Location: /companys?error=companyExists");
                    exit();
                }


                $this->companys
                    ->insert([
                        'name' => $this->request->getPost("name"),
                        'inn' => $this->request->getPost("inn"),
                        'kpp' => $this->request->getPost("kpp"),
                        'server_id' => $this->request->getPost("server"),
                    ]);
                header("Location: /companys");
            }
        }

        if ($this->request->getPost("updating")) {
            $row = $this->companys
                ->where(["id" => $this->request->getPost("updating")])
                ->first();
            $this->data["companys"] = $this->companys->findAll();
            $this->data["curCompany"] = $row;

            return view('dashboard/companys', $this->data);
        }

        if ($this->request->getPost("cancel")) {
            header("Location: /companys");
        }
    }
}
