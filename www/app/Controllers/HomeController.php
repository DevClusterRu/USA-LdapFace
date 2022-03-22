<?php namespace App\Controllers;

use App\Libraries\Logging;
use App\Libraries\Mailer;
use \App\Models\User;
use App\Libraries\Finances;


class HomeController extends BaseController
{

    public function index()
    {
        var_dump(config("App")->baseURL);

        die();


        $this->isAuth();
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
        Logging::logMessage("Пользователь " . session()->get("userName") . " вышел"); // в лог выход
        header("Location: /");
        exit();
    }

    private static function fillSession($auth)
    {
        session()->set([ // в сессию обращаемся по ключам слева
            'userId' => $auth["id"],
            'userRole' => $auth["role_id"],
            'userName' => self::shortName($auth["username"]),
            'userCompany' => $auth["company_id"],
            'gpoUpDown' => "hidden",
            'userUpDown' => "hidden",
            'profileInvUpDown' => "hidden",
            'profileUpDown' => "hidden",
            'serverUpDown' => "hidden",
            'serviceUpDown' => "hidden",
            'companyUpDown' => "hidden",
        ]);
        session()->set("balance", Finances::debetCredit($auth["id"]));//устанавливаем новый баланс директору
    }

    public function tryAuth()
    {
        $users = new User();
        $u = $users->where("username", $this->request->getPost('username'))->first();
        if (password_verify($this->request->getPost('password'), $u["password"])) {
            self::fillSession($u);
            Logging::logMessage("Пользователь " . $u["username"] . " авторизовался"); //обращаюсь к методу который действует в рамках объекта в котором нахолжусь( а он- объект от хом контролелра невидемый)
            header("Location: /profile");
            exit();
        } else {
            return view('login');
        }
    }

    public function rollUpWindows()
    {
        $paramSelected = $this->request->getPost("param");//получаем айди сервиса ( номер строчки)
        $actionSelectedDo = $this->request->getPost("action");//получаем вид действия, строку сет или ансет

        if ($actionSelectedDo == "block") {
            if ($paramSelected == "addFormGP" ){ session()->set(['gpoUpDown' => "",]); }
            if ($paramSelected == "addFormProfile" ){ session()->set(['profileUpDown' => "",]); }
            if ($paramSelected == "addFormProfileInv" ){ session()->set(['profileInvUpDown' => "",]); }
            if ($paramSelected == "addFormUser" ){ session()->set(['userUpDown' => "",]); }
            if ($paramSelected == "addFormServer" ){ session()->set(['serverUpDown' => "",]); }
            if ($paramSelected == "addFormService" ){ session()->set(['serviceUpDown' => "",]); }
            if ($paramSelected == "addFormCompany" ){ session()->set(['companyUpDown' => "",]); }
        } elseif ($actionSelectedDo == "none") {
            if ($paramSelected == "addFormGP" ){ session()->set(['gpoUpDown' => "hidden",]); }
            if ($paramSelected == "addFormProfile" ){ session()->set(['profileUpDown' => "hidden",]); }
            if ($paramSelected == "addFormProfileInv" ){ session()->set(['profileInvUpDown' => "hidden",]); }
            if ($paramSelected == "addFormUser" ){ session()->set(['userUpDown' => "hidden",]); }
            if ($paramSelected == "addFormServer" ){ session()->set(['serverUpDown' => "hidden",]); }
            if ($paramSelected == "addFormService" ){ session()->set(['serviceUpDown' => "hidden",]); }
            if ($paramSelected == "addFormCompany" ){ session()->set(['companyUpDown' => "hidden",]); }
        }
    }


}
