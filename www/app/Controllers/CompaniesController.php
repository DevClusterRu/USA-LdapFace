<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class CompaniesController extends BaseController
{


    private function getAllСompanies() //получение из бд всех серверов
    {
        $db = \Config\Database::connect();
        $builder = $db->table('company');
        $builder->select('company.id, company.name, company.inn, company.kpp');
        return $builder->get()->getResultArray();
    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        $data = [
            "companiesAll" => $this->getAllСompanies()
        ];  //передача переменной юзерсОл во вью
        return view('dashboard/companies', $data);
    }

    public function companiesOperation1()
    {

        $data = [
            "companiesAll" => $this->getAllСompanies()
        ];

        $request = service('request');
        if ($request->getPost("delBut")) {
            $this->delСompanies();
            $data["companiesAll"] = $this->getAllСompanies();
            return view('dashboard/companies', $data);
        } elseif ($request->getPost("updating")) {
            $this->editСompanies();
            return view('dashboard/companies', $data);
        }
        return view('dashboard/companies', $data);
    }

    public function companiesOperation2()
    {

        $data = [
            "companiesAll" => $this->getAllСompanies()
        ];




        $request = service('request');
        if ($request->getPost("submit") && $request->getPost("id")) {
            $this->updСompanies();
            $data["companiesAll"] = $this->getAllСompanies();
            return view('dashboard/companies', $data);
        }elseif ($request->getPost("submit")) {
            $this->addСompanies();
            $data["companiesAll"] = $this->getAllСompanies();
            return view('dashboard/companies', $data);
        }elseif ($request->getPost("cancel")) {
            header("Location: /companies");
           //  return view('dashboard/companies', $data);
        }
        return view('dashboard/companies', $data);
    }

    public function delСompanies()
    {
        $request = service('request');//c вью на контроллер . чекбоксы который выделе пользователь
        $items = $request->getPost("checkboxDel");

        $db = \Config\Database::connect();
        $builder = $db->table('company');
        foreach ($items as $item) {
            $builder->delete(["id" => $item]);
        }
        $data = [
            "companiesAll" => $this->getAllСompanies()
        ];  //передача переменной из списка серверов во вью

        header("Location: /companies");
    //    return view('dashboard/companies', $data);

    }

    public function updСompanies()
    {
        $request = service('request');//c вью на контроллер . чекбоксы который выделе пользователь
        //    $items = $request->getPost("checkboxDel");

        $db = \Config\Database::connect();
        $builder = $db->table('company');
        //    foreach ($items as $item) {
        //$builder->delete(["id" => $item]);
        $builder->where('id', $request->getPost("id"));
        $data = [

            'name' => $request->getPost("name"),
            'inn' => $request->getPost("inn"),
            'kpp' => $request->getPost("kpp"),

        ];

        $builder->update($data);     // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')

        header("Location: /companies");

    }


    public function addСompanies()
    {

        $request = service('request');//c вью на контроллер . чекбоксы который выделе пользователь
        //    $items = $request->getPost("checkboxDel");

        $db = \Config\Database::connect();
        $builder = $db->table('company');
        //    foreach ($items as $item) {
        //$builder->delete(["id" => $item]);
        $data = [
            'name' => $request->getPost("name"),
            'inn' => $request->getPost("inn"),
            'kpp' => $request->getPost("kpp"),
        ];

        $builder->insert($data);     // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')

        header("Location: /companies");
        // return view('dashboard/companies', $data);
    }

    public function editСompanies()
    {
        $request = service('request');//c вью на контроллер . чекбоксы который выделе пользователь

        $domain_id = $request->getPost("updating");

        $db = \Config\Database::connect();
        $builder = $db->table('company');
        $row = $builder->getWhere(['id' => $domain_id])->getFirstRow();
        //   $editBut = $request->getPost("updating");

        //    var_dump($row);  Вывод на экран
        //   die();


        $data = [
            "companiesAll" => $this->getAllСompanies(),
            "curCompany" => $row
        ];  //передача переменной из списка серверов во вью

        return view('dashboard/companies', $data);

    }

}
