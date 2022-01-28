<?php namespace App\Controllers;

use App\Models\MailBuffer;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;

class UserController extends BaseController
{
    protected $users;
    protected $companys;
    protected $allroles;
    protected $mail_buffers;

    public function __construct()
    {
        if (session()->get("userRole") < 2) { //условия для ограничения просмотра роута, запретить
            header("Location: /");
            exit();
        }
        $this->users = new User();
        $this->companys = new Company();
        $this->allroles = new Role();
        $this->mail_buffers = new MailBuffer();
    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        $data = [
            "users" => $this->users
                ->join('roles', 'users.role_id = roles.id')
                ->join('companys', 'users.company_id = companys.id')
                ->select('users.id, users.username, users.created_at, users.updated_at, roles.role_name, companys.name as company_name, invite_hash')
                ->where('users.deleted_at IS NULL')
                ->get()
                ->getResultArray(),
            "companys" => $this->companys->findAll(),
            "roles" => $this->allroles->findAll(),
            "mail_buffers" => $this->mail_buffers->findAll(),
        ];

        return view('dashboard/users', $data);
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
            }
        }

        if ($this->request->getPost("updating")) {
            $row = $this->users
                ->where(["id" => $this->request->getPost("updating")])
                ->first();

            $data = [
                "users" => $this->users
                    ->join('roles', 'users.role_id = roles.id')
                    ->join('companys', 'users.company_id = companys.id')
                    ->select('users.id, users.username, users.created_at, users.updated_at, roles.role_name, companys.name as company_name')
                    ->where('users.deleted_at IS NULL')
                    ->get()
                    ->getResultArray(),
                "companys" => $this->companys->findAll(),
                "roles" => $this->allroles->findAll(),
                "curUser" => $row,
            ];
            return view('dashboard/users', $data);
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


//              var_dump($hash);
//              die();

                    $exists = $this->users->where('invite_hash', $hash)->countAllResults(); //число совпадений


                    if ($exists == "0") break;
                }

                $this->users
                    ->update($item, [
                        'invite_hash' => $hash,
                    ]);

                $dfg = $this->users->find($item);

                $existsMail = $this->mail_buffers->where('email_buff', $dfg["email"])->countAllResults();
//                        var_dump($existsMail);
//             die();

                if ($existsMail == "0") {
                    $this->mail_buffers
                        ->insert([
                            'email_buff' => $dfg["email"],
                            'letter' => 'localhost:85/invite/' . $hash,

                        ]);
                } else {
                    $this->mail_buffers
                        ->update($this->mail_buffers->where('email_buff', $dfg["email"]), [
                            'email_buff' => $dfg["email"],
                            'letter' => 'localhost:85/invite/' . $hash,
                        ]);
                }
                header("Location: /users");
                //  break;
            }

        }


        header("Location: /users");
    }


    public function passwordReset()
    {
    }


    public function invite($hash = "none")
    {

        //Написать функцию разового входа пользователя, если вошел - авторизуем его и отправляем на страницу сброса пароля. Сразу после этого удаляем хэш из базы, т.к. он одноразовый

        //   http://localhost:85/invite/8f3a61740ad5b1b95713c09399947bc1
        //$hash = "8f3a61740ad5b1b95713c09399947bc1";
        $entranceUs = $this->users->where('invite_hash', $hash)->first(); //Возвращает строку из бд

//        var_dump($entrance ["id"]);

        if ($entranceUs ["id"] !== NULL) {
            $this->users
                ->update($entranceUs ["id"], [
                    'invite_hash' => "",
                ]);

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