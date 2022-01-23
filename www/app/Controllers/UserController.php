<?php namespace App\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Role;

class UserController extends BaseController
{
    protected $users;
    protected $companys;
    protected $allroles;

    public function __construct()
    {
        $this->users = new User();
        $this->companys = new Company();
        $this->allroles = new Role();
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
                ->select('users.id, users.username, users.created_at, users.updated_at, roles.role_name, companys.name as company_name')
                ->where('users.deleted_at IS NULL')
                ->get()
                ->getResultArray(),
            "companys" => $this->companys->findAll(),
            "roles" => $this->allroles->findAll(),
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
    }

    public function passwordReset()
    {
    }

}