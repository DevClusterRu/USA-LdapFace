<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class RoleController extends BaseController
{

    protected $data;

    public function __construct()
    {
        if (!$this->isSuper()) { //условия для ограничения просмотра роута, запретить
            header("Location: /");
            exit();
        }
        $this->data["page_name"] = "Список ролей";
    }

    private function getAllRoles() //получение из бд всех ролей
    {
        $db = \Config\Database::connect();
        $builder = $db->table('roles');
        $builder->select('roles.id, roles.role_name, roles.created_at, roles.updated_at');
        return $builder->get()->getResultArray();
    }


    public function index()
    {
       $this->isAuth();
        $this->data["usersAll"]=$this->getAllRoles();
       //передача переменной юзерсОл во вью
        return view('dashboard/roles', $this->data);
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
        $this->data["usersAll"]=$this->getAllRoles(); //передача переменной юзерсОл во вью
        return view('dashboard/roles', $this->data);
    }

}