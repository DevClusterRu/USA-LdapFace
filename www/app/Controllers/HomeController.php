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
        header("Location: /");
        exit();
    }

    private static function fillSession($auth)
    {
        session()->set([
            'userId' => $auth["id"],
            'userRole' => $auth["role_id"],
            'userName' => self::shortName($auth["username"]),
        ]);
        header("Location: /profile");
        exit();
    }

    public function tryAuth()
    {
        $users = new User();
        $u = $users->where("username", $this->request->getPost('username'))->first();
        if (password_verify($this->request->getPost('password'), $u["password"])) {
            self::fillSession($u);
        } else {
            return view('login');
        }
    }


}
