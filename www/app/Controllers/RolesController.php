<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class RolesController extends BaseController {

    public function index(){

        if (!session()->get("userId")) {
            header("Location: /roles");
            exit();
        }


        $db      = \Config\Database::connect();
        $builder = $db->table('roles');
//        $builder->select('*');
        $builder->select('roles.id, roles.role_name, roles.created_at, roles.updated_at');
        $query = $builder->get()->getResultArray();


        $data = [
            "usersAll"=>$query
        ];  //

        return view('dashboard/roles',$data);
    }

public function delUser(){
    $request = service('request');

        var_dump($request->getPost("checkboxDel"));
}

}