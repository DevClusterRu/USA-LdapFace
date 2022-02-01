<?php namespace App\Controllers;

use \App\Models\User;


class HomeController extends BaseController
{

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        header("Location: /profile");
        exit();
    }

    public function login()
    {
        return view('login');
    }


    public function logout()
    {
        session()->destroy();
        $this->logMessage("Пользователь ". session()->get("userName")." вышел"); // в лог выход
        header("Location: /");
        exit();
    }

    private static function fillSession($auth)
    {
        session()->set([ // в сессию обращаемся по ключам слева
            'userId' => $auth["id"],
            'userRole' => $auth["role_id"],
            'userName' => self::shortName($auth["username"]),
        ]);
    }

    public function tryAuth()
    {
        $users = new User();
        $u = $users->where("username", $this->request->getPost('username'))->first();
        if (password_verify($this->request->getPost('password'), $u["password"])) {
            self::fillSession($u);

            $this->logMessage("Пользователь ".$u["username"]." авторизовался"); //обращаюсь к методу который действует в рамках объекта в котором нахолжусь( а он- объект от хом контролелра невидемый)

            header("Location: /profile");
            exit();
        } else {
            return view('login');
        }
    }


}
