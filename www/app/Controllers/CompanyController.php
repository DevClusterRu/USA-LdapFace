<?php namespace App\Controllers;

use \App\Models\Company;

class CompanyController extends BaseController
{
    //Здесь мы создаем свойство класса companys  оно будет содержать модель таблицы companys
    protected static $companys;

    //Метод __construct() - это конструктор класса, этот метод вызывается 1 раз при обращении к классу (при создании объекта класса)
    public function __construct()
    {

        if(session()->get("userRole")<4) { //условия для ограничения просмотра роута, запрет
            header("Location: /");
            exit();
        }
        //Заполняем companys объектом таблицы
        $this->companys = new Company();

    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        //Не используем билдер, подключаемся к модели Companys и применяем метод findAll() (все записи)
        $data = [
            "companys" => $this->companys->findAll(),
        ];
        return view('dashboard/companys', $data);
    }

    //Теперь у нас всего 1 метод управления страницей, он умеет обрабатывать все нужные нам ПОСТ запросы
    public function operation()
    {
        //Из контроллера можно напрямую обращаться в $this->request, не инициализируя его
        if ($this->request->getPost("delete")) {
            if (!$this->request->getPost("checkboxDel")){
                header("Location: /companys");
            }
            foreach ($this->request->getPost("checkboxDel") as $item) {
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
                    ]);
                header("Location: /companys");
            } else {
                $this->companys
                    ->insert([
                        'name' => $this->request->getPost("name"),
                        'inn' => $this->request->getPost("inn"),
                        'kpp' => $this->request->getPost("kpp"),
                    ]);
                header("Location: /companys");
            }
        }

        if ($this->request->getPost("updating")) {
            $row = $this->companys
                ->where(["id" => $this->request->getPost("updating")])
                ->first();
            $data = [
                "companys" => $this->companys->findAll(),
                "curCompany" => $row,
            ];
            return view('dashboard/companys', $data);
        }

        if ($this->request->getPost("cancel")) {

            header("Location: /companys");
        }
    }
}
