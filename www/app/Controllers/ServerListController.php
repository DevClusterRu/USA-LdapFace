<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class ServerListController extends BaseController {



    private function getAllServersList() //получение из бд всех серверов
    {
        $db = \Config\Database::connect();
        $builder = $db->table('serverList');
        $builder->select('serverList.id, serverList.domain, serverList.ip, serverList.login, serverList.password');
        return $builder->get()->getResultArray();
    }

    public function index() {
        if (!session()->get("userId")) {
            header("Location: /serverlist");
            exit();
        }
        $data = [
            "serverAll" => $this->getAllServersList()
        ];  //передача переменной юзерсОл во вью
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

            return view('dashboard/serverlist', $data);
        }



    }
