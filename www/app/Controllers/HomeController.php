<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class HomeController extends BaseController
{
    public function index()
    {
        if (session()->get("user_id")) {
            header("Location: /workspace");
            exit();
        }
        return view('login');
    }

    public function logout()
    {
        session()->destroy();
        header("Location: /");
        exit();
    }

    public function register()
    {
        return view('register');
    }

    private static function fillSession($auth)
    {
        session()->set([
            'userId' => $auth["id"],
            'userEmail' => $auth["email"],
            'userRole' => $auth["role"],
            'userRoleTitle' => self::$roles[$auth["role"]],
            'userAvatar' => $auth[0]->avatar,
            'userName' => self::shortName($auth["username"]),
        ]);
        header("Location: /workspace");
        exit();
    }

    public function tryRegister()
    {
        $request = service('request');
        if ($request->getMethod() == 'post') {

            $username = $request->getPost('username');
            $password = $request->getPost('password');
            $users = new \App\Models\User();
            $exists = $users->select(["username" => $username])->get();
            if ($exists) {
                //TODO Need baloon, info about duplicate name
                return view('register');
            }

            $u = [
                "username" => $username,
                "password"=>password_hash($password,PASSWORD_BCRYPT),
            ];
            $users->save($u);


            return self::tryAuth($request);

        }
        return view('register');
    }

    public function tryAuth($request = false)
    {
        if (!$request){
            $request = service('request');
        }
        echo $request->getPost('username');
        $users = new \App\Models\User();
        $u = $users->where("username",$request->getPost('username'))->first();
        if (password_verify($request->getPost('password'),$u["password"])){
            self::fillSession($u);
        } else {
            return view('login');
        }
    }

}
