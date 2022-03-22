<?php namespace App\Controllers;

use App\Libraries\LdapChannelLibrary;
use App\Libraries\Logging;
use App\Models\MailBuffer;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use App\Libraries\Finances;
use \App\Models\Server;

class UserController extends BaseController
{
    protected $users;
    protected $companys;
    protected $allroles;
    protected $mail_buffers;
    protected $data;
    protected $servers;

    public function __construct()
    {
        $this->users = new User();
        $this->companys = new Company();
        $this->allroles = new Role();
        $this->mail_buffers = new MailBuffer();
        $this->servers = new server();
        $this->data["page_name"] = "Пользователи";
        $this->data["companys"] = $this->companys->findAll();
        if ($this->isDirector()) {
            $this->data["roles"] = $this->allroles->where('role_id < 3')->findAll();
        } else {
            $this->data["roles"] = $this->allroles->where('role_id < 4')->findAll();
        }
        $this->data ["servers"] = $this->servers->findAll();

    }

    public function index()
    {
        if ($this->isClient()) { //условия для ограничения просмотра роута, запретить
            header("Location: /");
            exit();
        }

        $this->isAuth();

        if ($this->isAdmin()) {
            $this->data["users"] = $this->users
                ->join('roles', 'users.role_id = roles.id')
                ->join('companys', 'users.company_id = companys.id')
                ->join('servers', 'companys.server_id = servers.id')
                ->select('users.id, users.role_id, users.username, users.created_at, users.updated_at, roles.role_name, companys.name as company_name, invite_hash')
                ->where('users.deleted_at IS NULL')
                ->where('users.role_id < 4')
                ->get()
                ->getResultArray();
        } elseif ($this->isDirector()) {
            $this->data["users"] = $this->users
                ->join('roles', 'users.role_id = roles.id')
                ->join('companys', 'users.company_id = companys.id')
                ->select('users.id, users.role_id, users.username, users.created_at, users.updated_at, roles.role_name, companys.name as company_name, invite_hash')
                ->where('users.deleted_at IS NULL')
                ->where('users.role_id < 2')
                ->where('users.company_id = ', session()->get("userCompany"))
                ->get()
                ->getResultArray();
        }


        $this->data["mail_buffers"] = $this->mail_buffers->findAll();

        return view('dashboard/users', $this->data);
    }


    public function zoom($user_id = 0) //айди приходит с роута от зумирования
    {
        if ($this->isClient) { //условия для ограничения просмотра роута, запретить
            header("Location: /");
            exit();
        }

        //условия для разрешения зумирование и проверка двойного зумирования для запрета
        if (session()->get("userRole") < 3 || session()->get("zoom_id")) {
            header("Location: /profile");
            exit();
        }

        if ($user_id == session()->get("userId")) {
            header("Location: /profile");
            exit();
        }
        $infoUserZoom = $this->users->find($user_id); // зумирование

        $oldName = session()->get("userName"); //получили оригинальное имя пользователя до перезаписи сессии для зума

        session()->set([
            'userId' => $user_id,
            'userRole' => $infoUserZoom["role_id"],
            'userName' => $infoUserZoom["username"],
            'zoom_id' => session()->get("userId"),// айди предыдущего пользователя
        ]);


        Logging::logMessage("Пользователь " . $oldName . " зашел под пользователем " . session()->get("userName"));// в лог зумирования
        session()->set("balance", Finances::debetCredit($user_id));


        header("Location: /profile");

        exit();

    }

    public function zoomOut()
    {

        $oldName = session()->get("userName"); //получили оригинальное имя пользователя до перезаписи сессии для зума
        $infoUserZoom = $this->users->find(session()->get("zoom_id"));
        session()->set([
            'userId' => session()->get("zoom_id"),
            'userRole' => $infoUserZoom["role_id"],
            'userName' => $infoUserZoom["username"],
        ]);
        session()->remove("zoom_id");

        Logging::logMessage("Пользователь " . session()->get("userName") . " вышел из под пользователя " . $oldName); // в лог  выход зумирования

        header("Location: /profile");
        exit();
    }


    public function operation()
    {
        //Из контроллера можно напрямую обращаться в $this->request, не инициализируя его
        if ($this->request->getPost("delete")) {
            if (!$this->request->getPost("checkboxDel")) {
                header("Location: /users");
                exit();
            }
            foreach ($this->request->getPost("checkboxDel") as $item) {

                $userInfo = $this->users->where('id', $item)->first();
                $companInfo = $this->companys->where('id', $userInfo["company_id"])->first();
                $servInfo = $this->servers->where('id', $companInfo["server_id"])->first();
//                //здесь отправить запрос в лдап на удаление пользователя
                //                deleteObject($domain, $name)
                $logg = array($servInfo["domain"], "CN=" . $userInfo ["username"] . "," . "OU=" . $companInfo["name"] . " - Пользователи" . "," . "OU=" . $companInfo["name"] . "," . $servInfo["baseDn"]);
                Logging::logMessage(json_encode($logg, JSON_UNESCAPED_UNICODE));
                $resp = LdapChannelLibrary::deleteObject($servInfo["domain"], "CN=" . $userInfo ["username"] . "," . "OU=" . $companInfo["name"] . " - Пользователи" . "," . "OU=" . $companInfo["name"] . "," . $servInfo["baseDn"]);
                $respJson = json_decode($resp->getBody());
                if ($respJson->result == false) {
                    header("Location: /users?error=delUserExists");
                    exit();
                }
                $this->users->delete($item);
            }
            header("Location: /users");
        }

        if ($this->request->getPost("addEdit")) {
            if ($this->request->getPost("id")) {
                $this->users
                    ->update($this->request->getPost("id"), [
                        'username' => $this->request->getPost("username"),
                        'email' => $this->request->getPost("email"),
                        'phone' => $this->request->getPost("phone"),
                        'company_id' => $this->request->getPost("company"),
                        'role_id' => $this->request->getPost("role"),
                    ]);
                header("Location: /users");
            } else {

                $userInfo = $this->request->getPost();
                $companInfo = $this->companys->where('id', $this->request->getPost("company"))->first();
                $servInfo = $this->servers->where('id', $companInfo["server_id"])->first();

                $loggg = array($userInfo ["username"], $userInfo ["phone"], $userInfo ["email"], "OU=" . $companInfo["name"] . " - Пользователи" . "," . "OU=" . $companInfo["name"] . "," . $servInfo["baseDn"], $servInfo["domain"]);
                Logging::logMessage(json_encode($loggg, JSON_UNESCAPED_UNICODE));
                //здесь отправить запрос в лдап на создание пользователя
                $resp = LdapChannelLibrary::createUser($userInfo ["username"], $userInfo ["phone"], $userInfo ["email"], "OU=" . $companInfo["name"] . " - Пользователи" . "," . "OU=" . $companInfo["name"] . "," . $servInfo["baseDn"], $servInfo["domain"]);
                $respJson = json_decode($resp->getBody());


                if ($respJson->result == false) {
                    header("Location: /users?error=userExists");
                    exit();
                }

                $this->users
                    ->insert([
                        'username' => $this->request->getPost("username"),
                        'password' => password_hash("123", PASSWORD_BCRYPT),
                        'email' => $this->request->getPost("email"),
                        'phone' => $this->request->getPost("phone"),
                        'company_id' => $this->request->getPost("company"),
                        'role_id' => $this->request->getPost("role"),
                    ]);
                header("Location: /users");

                //{"status":true, "response":"ok"}


            }
        }

        if ($this->request->getPost("updating")) {
            $row = $this->users
                ->where(["id" => $this->request->getPost("updating")])
                ->first();
            $userid = session()->get("userId");
            $compan = $this->users->find($userid);
            if ($this->isAdmin()) {
                $this->data["users"] = $this->users
                    ->join('roles', 'users.role_id = roles.id')
                    ->join('companys', 'users.company_id = companys.id')
                    ->select('users.id, users.username, users.created_at, users.updated_at, roles.role_name, companys.name as company_name')
                    ->where('users.deleted_at IS NULL')
                    ->where('users.role_id < 4')
                    ->get()
                    ->getResultArray();
                $this->data["curUser"] = $row; //Роли и компании уже находятся в $this->data (через констракт)

            } elseif ($this->isDirector()) {
                $this->data["users"] = $this->users
                    ->join('roles', 'users.role_id = roles.id')
                    ->join('companys', 'users.company_id = companys.id')
                    ->select('users.id, users.username, users.created_at, users.updated_at, roles.role_name, companys.name as company_name')
                    ->where('users.company_id', $compan['company_id'])
                    ->where('users.role_id < 3')
                    ->findAll();
                $this->data["curUser"] = $row;

            }
            session()->set(['userUpDown' => "",]);
            return view('dashboard/users', $this->data);
        }


        if ($this->request->getPost("inv")) {
            if (!$this->request->getPost("checkboxInvite")) {
                header("Location: /users");
                exit();
            }

            foreach ($this->request->getPost("checkboxInvite") as $item) { //переменная в которую передается id user

                while (true) {
                    $StrDate = date("Y-m-d h:m:s");
                    $StrDate .= $item;
                    $hash = md5($StrDate);
                    $exists = $this->users->where('invite_hash', $hash)->countAllResults(); //число совпадений

                    if ($exists == "0") break;
                }

                $this->users->update($item, ['invite_hash' => $hash]);
                $dfg = $this->users->find($item);
                $existsMail = $this->mail_buffers->where('email_buff', $dfg["email"])->countAllResults();

                $send = [
                    'email_buff' => $dfg["email"],
                    'letter' => config("App")->baseURL . '/invite/' . $hash,
                ];
                if ($existsMail == "0") {
                    echo "INSERT";
                    $this->mail_buffers->insert($send);
                } else {
                    echo "UPDATE";
                    $this->mail_buffers->update($this->mail_buffers->where('email_buff', $dfg["email"]), $send);
                }

            }
        }


        header("Location: /users");
    }

    public function invite($hash = "none")
    {
        //Написать функцию разового входа пользователя, если вошел - авторизуем его и отправляем на страницу сброса пароля. Сразу после этого удаляем хэш из базы, т.к. он одноразовый

        $elems = explode("/",$hash);
        $hash = $elems[count($elems)-1];

        $entranceUs = $this->users->where('invite_hash', $hash)->first(); //Возвращает строку из бд

        if ($entranceUs ["id"] !== NULL) {
            $this->users->update($entranceUs["id"], ['invite_hash' => ""]);

            session()->set([
                'userId' => $entranceUs["id"],
                'userRole' => $entranceUs["role"],
                'userName' => self::shortName($entranceUs["username"]),
            ]);
            header("Location: /profile");
            exit();
        }
        header("Location: /login");
        exit();
    }

}