<?php namespace App\Controllers;

use App\Models\Service;
use App\Models\UserAutoUpdateService;
use App\Models\UserSelectedService;

class ServiceController extends BaseController
{

    protected $services;
    protected $userSelectedService;
    protected $userAutoUpdateService;
    protected $data;


    public function __construct()
    {

        $request = \Config\Services::request();

        if (session()->get("userRole") == 1 || (session()->get("userRole") == 2 && !$request->isAJAX())) { //условия для ограничения просмотра роута,запретить
            header("Location: /");
            exit();
        }
        $this->services = new Service();
        $this->userSelectedService = new UserSelectedService();
        $this->userAutoUpdateService = new UserAutoUpdateService();
        $this->data["page_name"] = "Список услуг";
        $this->data["services"]=$this->services->findAll();

    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }

         // будующая переменная -> берет из свойства класса (равно объекту модели) , метод выбирает все записи из таблицы ивозвращает их в виде массива
      return view('dashboard/services', $this->data);
    }

    public function operation()
    {
        //Из контроллера можно напрямую обращаться в $this->request, не инициализируя его
        if ($this->request->getPost("delete")) {
            if (!$this->request->getPost("checkboxDel")) {
                header("Location: /services");
                exit();
            }
            foreach ($this->request->getPost("checkboxDel") as $item) {
                $this->services->delete($item);
            }
            header("Location: /services");
        }

        if ($this->request->getPost("addEdit")) {
            if ($this->request->getPost("id")) {
                $this->services
                    ->update($this->request->getPost("id"), [
                        'name' => $this->request->getPost("name"),
                        'type_service' => $this->request->getPost("typeservice"),
                        'cost' => $this->request->getPost("cost"),

                    ]);
                header("Location: /services");
            } else { //создание

                $this->services
                    ->insert([
                        'name' => $this->request->getPost("name"),
                        'type_service' => $this->request->getPost("typeservice"),
                        'cost' => $this->request->getPost("cost"),
                    ]);
                header("Location: /services");
            }
        }

        if ($this->request->getPost("updating")) {//получила элемент с формы
            $row = $this->services
                ->where(["id" => $this->request->getPost("updating")])//запрос прилетевший с формы
                ->first();

            $this->data["curService"]=$row;// строчка которая пришла в форму при нажатии апдейтинг
           //на вью переменная сервисес равно списку всех элементов
           return view('dashboard/services', $this->data);
        }
    }


    function bindToUser()
    { //привязка сервиса к юзеру
        $checkboxSelected = $this->request->getPost("checkboxService");//получаем айди сервиса ( номер строчки)
        $checkboxSelectedDo = $this->request->getPost("doCheckbox");//получаем вид действия, строку сет или ансет

        if ($checkboxSelectedDo == "set") {
            $this->userSelectedService->insert(["user_id" => session()->get("userId"), "service_id" => $checkboxSelected]);
        } else {
            $this->userSelectedService
                ->where(["user_id" => session()->get("userId"), "service_id" => $checkboxSelected])
                ->delete();
        }
    }

    function autoUpdateToUser(){ //связь автообновления с пользователем
        { //привязка сервиса к юзеру
            $checkboxAutoUpdateSelector = $this->request->getPost("checkboxAutoUpdateSelector");//получаем айди сервиса ( номер строчки)
            $checkboxAutoUpdateSelectorDo = $this->request->getPost("doCheckbox");//получаем вид действия, строку сет или ансет

            if ($checkboxAutoUpdateSelectorDo == "set") {
                $this->userAutoUpdateService->insert(["user_id" => session()->get("userId"), "service_id" => $checkboxAutoUpdateSelector]);
            } else {
                $this->userAutoUpdateService
                    ->where(["user_id" => session()->get("userId"), "service_id" => $checkboxAutoUpdateSelector])
                    ->delete();
            }
        }



    }

}
