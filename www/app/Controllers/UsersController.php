<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class UsersController extends BaseController {



    private function getAllUsers() //получение из бд всех ролей
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id, users.username, users.created_at, users.updated_at, roles.role_name');
        $builder->join('roles', 'users.role_id = roles.id');
     //   $builder->join('company', 'users.name = company.id');
        return $builder->get()->getResultArray();
    }

    private function getCompanys() //получение из бд всех ролей
    {
        $db = \Config\Database::connect();
        $builder = $db->table('companys');
        $builder->select('id, name');
        return $builder->get()->getResultArray();
    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }



//        $users = new \App\Models\User(); //объект модели юзер. общение с бд через модель
//        $usersList = $users->select([])->findAll();//выборка из бд

//        echo '<pre>';
//        var_dump($query);
//        die();

        $data = [
            "usersAll"=>$this->getAllUsers(),
            "companys" => $this->getCompanys(),
        ];  //

        return view('dashboard/users',$data);
    }


    public function usersOperation1()
    {

        $data = [
            "serverAll" => $this->getAllUsers()
        ];

        //   return view('dashboard/serverlist', $data);


        $request = service('request');
        if ($request->getPost("submit") && $request->getPost("id")) {
            $this->getAllUsers();
            $data["serverAll"] = $this->getAllUsers();
            return view('dashboard/serverlist', $data);
        }elseif ($request->getPost("submit")) {
            $this->getAllUsers();
            $data["serverAll"] = $this->getAllUsers();
            return view('dashboard/serverlist', $data);
        }elseif ($request->getPost("cancel")) {
            header("Location: /serverlist");
            //  return view('dashboard/serverlist', $data);
        }
        return view('dashboard/serverlist', $data);
    }

    public function usersOperation2(){


        $request = service('request');
        if($request->getPost("delBut")){
            $this->delUsers();
        } elseif ($request->getPost("resBut")){
            $this->passwordReset();
        }

    }


        public function delUsers() //при нажатии кнопки удаления
    {
        $request = service('request');//c вью на контроллер
        $items = $request->getPost("checkboxDel");

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        foreach ($items as $item) {
            $builder->delete(["id" => $item]);
        }

        $data = [
            "usersAll"=>$this->getAllUsers()
        ];  //

        return view('dashboard/users',$data);
    }

    public function passwordReset() {

//        $request = service('request');//c вью на контроллер
//        $items = $request->getPost("checkboxRes");
//        $response = $client->request('PUT', '/put', ['json' => ['foo' => 'bar']]);


//        foreach ($items as $item) {
//            echo $item;
//        }




//        $data = [
//            "usersAll"=>$this->getAllUsers()
//        ];  //
//        return view('dashboard/users',$data);

    }



}