<?php namespace App\Controllers;

use App\Libraries\Finances;
use App\Models\Credit;
use App\Models\Service;
use App\Models\User;
use App\Models\UserSelectedService;
use App\Models\Invoice;
use \App\Models\Server;
use App\Models\Company;
use App\Libraries\LdapChannelLibrary;

use CodeIgniter\HTTP\RequestInterface;

class ProfileController extends BaseController
{
    protected $userModel;
    protected $serviceModel;
    protected $userSelectedService;
    protected $invoices;
    protected $data;
    protected $companys;
    protected $servers;
    protected $services;
    protected $credits;

    public function __construct()
    {
        $this->credits = new Credit();
        $this->userModel = new User();
        $this->serviceModel = new Service();
        $this->userSelectedService = new UserSelectedService();
        $this->invoices = new Invoice();
        $this->companys = new Company();
        $this->servers = new server();
        $this->data["page_name"] = "Профайл";
        $this->services = new Service();
    }

    function index()
    {
        //TODO curl
//         var_dump(LdapChannelLibrary::curlRequest()); //курл ,вставить после приглашения
//        die();

        //LdapChannelLibrary::createOrganization("test.lab","DC=test,DC=lab","xSpase");
        $this->isAuth();
        $this->data["userInfo"] = $this->userModel->find(session()->get("userId"));
        $this->data["servicesAll"] = $this->serviceModel->findAll();
        $this->data["userServicesList"] = $this->userSelectedService->where("user_id", session()->get("userId"))->findAll();
        $this->data["invoices"] = $this->invoices->findAll();
        $this->data["credits"]=$this->credits
            ->where("UNIX_TIMESTAMP(created_at) >= UNIX_TIMESTAMP() - 86400")
            ->where("user_id",session()->get("userId"))
            ->findAll();
        return view('dashboard/profile', $this->data);
        //SELECT * FROM `credits` WHERE user_id = 100 AND UNIX_TIMESTAMP(created_at) >= UNIX_TIMESTAMP() - 86400;
    }


    function changeUserInfo()
    {
        $request = service('request');//c вью на контроллер
        $phone = $request->getPost("phone");
        $email = $request->getPost("email");
        $user = new \App\Models\User();
        $dataInfo = [
            'phone' => $phone,//в левой части мы указываем имя поля таблицы, в правой переменную нового значения поля
            'email' => $email,
        ];

        $user->update(session()->get("userId"), $dataInfo); //обвновляет бд
        header("Location: /profile");
    }

    function changeUserPassword()
    {
        $request = service('request');//c вью на контроллер
        $password1 = $request->getPost("password1");//переменная из вью (из объекта реквест)
        $password2 = $request->getPost("password2");
        $user = new \App\Models\User(); //объект таблицы бд юзер

        if ($password1 == $password2) {

            $userInfo = $this->userModel->where('id', session()->get("userId"))->first();
            $companInfo = $this->companys->where('id', $userInfo["company_id"])->first();
            $servInfo = $this->servers->where('id', $companInfo["server_id"])->first();

            //здесь отправить запрос в лдап на замену пароля
            $resp = LdapChannelLibrary::dropPassword($servInfo["domain"], "CN=" . $userInfo ["username"] . "," . "OU=" . $companInfo["name"] . " - Пользователи" . "," . "OU=" . $companInfo["name"] . "," . $servInfo["baseDn"]);

            $respJson = json_decode($resp->getBody());

            if ($respJson->result == false) {
                header("Location: /profile?error=passExists");
                exit();
            }
            $dataPassword = [
                'password' => password_hash($password1, PASSWORD_BCRYPT) //запись в бд значения переменной
            ];
        }
        $user->update(session()->get("userId"), $dataPassword);
        header("Location: /profile");

    }

    function аddInvoice()
    {
        if ($this->request->getPost("addButton")) {
            $user = session()->get("userId");
            if ($this->request->getPost("amount") != 0 && $this->request->getPost("amount") !== "") {
                $this->invoices
                    ->insert([
                        'user_id' => $user,
                        'amount' => $this->request->getPost("amount"),
                        'status' => "new",
                    ]);
                header("Location: /invoices");
            }
            header("Location: /profile");
        } elseif ($this->request->getPost("cancel")) {
            header("Location: /profile");
        }
    }

//    function getPaymentPersInfo()
//    {
//        $db = \Config\Database::connect();
//        $builder = $db->table('PaymentPers');
//        $builder->select('type_of_service, current_service, price, get_bills, payment_before');
//        return $builder->get()->getResultArray();
//    }

    function activateServices() //на кнопку
    { //кнопка активировать сервисы у директора
        // Finances::debetCredit($auth["id"])

        //foreach ($this->request->getPost("checkboxDel") as $item) {
        $services = $this->request->getPost("checkboxService");
        if (!$services){
            header("Location: /profile");
            exit();
        }

        $totalCost = 0;
        $balance= Finances::debetCredit(session()->get("userId"));//сколько на счету денег у директора
        foreach ($services as $item) {

            $serviceRow = $this->services
                ->where("id", $item) //айди равно выделенному чекбоксу
                ->first();

            $totalCost += $serviceRow["cost"];//цена текущей услуги
            if ($balance-$totalCost<0){
                header("Location: /profile?error=lowBalance");
                exit();
            }
            $this->credits
                ->insert([
                    "user_id"=>session()->get("userId"),
                    "service_id"=>$serviceRow["id"],
                    "amount"=>$serviceRow["cost"],
                ]);

        }//выделенные сервисы в итем
      //$totalCost - сумма выбранных сервисов через чекбоксы



         session()->set($balance);
        header("Location: /profile");
        //session()->set("balance", Finances::debetCredit($auth["id"]));//устанавливаем новый баланс директору

    }




}
