<?php namespace App\Controllers;

use App\Models\Service;

class ServiceController extends BaseController
{

    protected $services;

    public function __construct()
    {
        $this->services = new Service();
    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        $data = [
            "services" => $this->services->findAll(), // будующая переменная -> берет из свойства класса (равно объекту модели) , метод выбирает все записи из таблицы ивозвращает их в виде массива
        ];
        return view('dashboard/services', $data);
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

            $data = [
                "services" => $this->services->findAll(),//на вью переменная сервисес равно списку всех элементов
                "curService" => $row,// строчка которая пришла в форму при нажатии апдейтинг
            ];
            return view('dashboard/services', $data);
        }
    }





}