<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class RoleController extends BaseController
{


    private function getAllRoles() //получение из бд всех ролей
    {
        $db = \Config\Database::connect();
        $builder = $db->table('roles');
        $builder->select('roles.id, roles.role_name, roles.created_at, roles.updated_at');
        return $builder->get()->getResultArray();
    }


    public function index()
    {

        if (!session()->get("userId")) {
            header("Location: /roles");
            exit();
        }

        $data = [
            "usersAll" => $this->getAllRoles()
        ];  //передача переменной юзерсОл во вью

        return view('dashboard/roles', $data);
    }

    public function delRoles()
    {
        $request = service('request');//c вью на контроллер . чекбоксы который выделе пользователь
        $items = $request->getPost("checkboxDel");

        $db = \Config\Database::connect();
        $builder = $db->table('roles');
        foreach ($items as $item) {
            $builder->delete(["id" => $item]);

        }
        $data = [
            "usersAll" => $this->getAllRoles()
        ];  //передача переменной юзерсОл во вью

        return view('dashboard/roles', $data);
    }


}