<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class ServerListController extends BaseController
{


    private function getAllServersList() //получение из бд всех серверов
    {
        $db = \Config\Database::connect();
        $builder = $db->table('serverList');
        $builder->select('serverList.id, serverList.domain, serverList.ip, serverList.login, serverList.password');
        return $builder->get()->getResultArray();
    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        $data = [
            "serverAll" => $this->getAllServersList()
        ];  //передача переменной юзерсОл во вью
        return view('dashboard/serverlist', $data);
    }

    public function serverlistOperation1()
    {

        $data = [
            "serverAll" => $this->getAllServersList()
        ];

        $request = service('request');
        if ($request->getPost("delBut")) {
            $this->delServersList();
            $data["serverAll"] = $this->getAllServersList();
            return view('dashboard/serverlist', $data);
        } elseif ($request->getPost("updating")) {
            $this->editServersList();
            return view('dashboard/serverlist', $data);
        }
        return view('dashboard/serverlist', $data);
    }

    public function serverlistOperation2()
    {

        $data = [
            "serverAll" => $this->getAllServersList()
        ];

        //   return view('dashboard/serverlist', $data);


        $request = service('request');
        if ($request->getPost("submit") && $request->getPost("id")) {
            $this->updServersList();
            $data["serverAll"] = $this->getAllServersList();
            return view('dashboard/serverlist', $data);
        }elseif ($request->getPost("submit")) {
            $this->addServersList();
            $data["serverAll"] = $this->getAllServersList();
            return view('dashboard/serverlist', $data);
        }elseif ($request->getPost("cancel")) {
            header("Location: /serverlist");
           //  return view('dashboard/serverlist', $data);
        }
        return view('dashboard/serverlist', $data);
    }

    public function delServersList()
    {
        $request = service('request');//c вью на контроллер . чекбоксы который выделе пользователь
        $items = $request->getPost("checkboxDel");

        $db = \Config\Database::connect();
        $builder = $db->table('serverList');
        foreach ($items as $item) {
            $builder->delete(["id" => $item]);
        }
        $data = [
            "serverAll" => $this->getAllServersList()
        ];  //передача переменной из списка серверов во вью

        header("Location: /serverlist");
    //    return view('dashboard/serverlist', $data);

    }

    public function updServersList()
    {
        $request = service('request');//c вью на контроллер . чекбоксы который выделе пользователь
        //    $items = $request->getPost("checkboxDel");

        $db = \Config\Database::connect();
        $builder = $db->table('serverList');
        //    foreach ($items as $item) {
        //$builder->delete(["id" => $item]);
        $builder->where('id', $request->getPost("id"));
        $data = [

            'domain' => $request->getPost("domain"),
            'ip' => $request->getPost("ip"),
            'login' => $request->getPost("login"),
            'password' => $request->getPost("password"),
        ];

        $builder->update($data);     // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')

        header("Location: /serverlist");

    }


    public function addServersList()
    {

        $request = service('request');//c вью на контроллер . чекбоксы который выделе пользователь
        //    $items = $request->getPost("checkboxDel");

        $db = \Config\Database::connect();
        $builder = $db->table('serverList');
        //    foreach ($items as $item) {
        //$builder->delete(["id" => $item]);
        $data = [
            'domain' => $request->getPost("domain"),
            'ip' => $request->getPost("ip"),
            'login' => $request->getPost("login"),
            'password' => $request->getPost("password"),
        ];

        $builder->insert($data);     // Produces: INSERT INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')

        header("Location: /serverlist");
        // return view('dashboard/serverlist', $data);
    }

    public function editServersList()
    {
        $request = service('request');//c вью на контроллер . чекбоксы который выделе пользователь

        $domain_id = $request->getPost("updating");

        $db = \Config\Database::connect();
        $builder = $db->table('serverList');
        $row = $builder->getWhere(['id' => $domain_id])->getFirstRow();
        //   $editBut = $request->getPost("updating");

        //    var_dump($row);  Вывод на экран
        //   die();


        $data = [
            "serverAll" => $this->getAllServersList(),
            "curServer" => $row
        ];  //передача переменной из списка серверов во вью

        return view('dashboard/serverlist', $data);

    }

}
