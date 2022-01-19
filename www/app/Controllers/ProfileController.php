<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class ProfileController extends BaseController
{
    function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        $data = [
            "userInfo" => $this->curentUserInfo(),
        ];

        return view('dashboard/profile', $data);


    }

    function curentUserInfo()
    {
        $user = new \App\Models\User();
        $info = $user->find(session()->get("userId"));
        return $info;
    }

    function changeUserInfo()
    {
        $request = service('request');//c вью на контроллер
        $phone = $request->getPost("phone");
        $email = $request->getPost("email");

        $user = new \App\Models\User();

        $dataInfo = [
            'phone' => $phone,//в левой части мы указываем имя поля таблицы, в правой переменную нового значения поля
            'email' => $email,
        ];

        $user->update(session()->get("userId"), $dataInfo); //обвновляет бд
        header("Location: /profile");
    }

    function changeUserPassword()
    {
        $request = service('request');//c вью на контроллер
        $password1= $request->getPost("password1");//переменная из вью (из объекта реквест)
        $password2= $request->getPost("password2");

        $user = new \App\Models\User(); //объект таблицы бд юзер


        if ($password1==$password2) {
            $dataPassword = [
                'password' => password_hash($password1,PASSWORD_BCRYPT) //запись в бд значения переменной
            ];
            }
        $user->update(session()->get("userId"), $dataPassword);
        header("Location: /profile");

    }

}
