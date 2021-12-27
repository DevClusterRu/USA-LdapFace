<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class UsersController extends BaseController {


    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }

        $db      = \Config\Database::connect();
        $builder = $db->table('users');
//        $builder->select('*');
        $builder->select('users.username, users.created_at, users.updated_at, roles.role_name');
        $builder->join('roles', 'users.role_id = roles.id');
        $query = $builder->get()->getResultArray();

//        $users = new \App\Models\User(); //объект модели юзер. общение с бд через модель
//        $usersList = $users->select([])->findAll();//выборка из бд

//        echo '<pre>';
//        var_dump($query);
//        die();



        $data = [
            "usersAll"=>$query
        ];  //


        return view('dashboard/users',$data);
    }





}