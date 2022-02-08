<?php namespace App\Controllers;

use \App\Models\User;
use \App\Models\Group;
use \App\Models\UserSelectedGroup;
use App\Models\Role;
use \App\Models\Company;


class UserGPOController extends BaseController
{
    //Здесь мы создаем свойство класса companys  оно будет содержать модель таблицы companys

    protected $users;
    protected $groupPolicy;
    protected $usersSelectedGroup;
    protected $allroles;
    protected $data;

    protected static $companys;

    //Метод __construct() - это конструктор класса, этот метод вызывается 1 раз при обращении к классу (при создании объекта класса)
    public function __construct()
    {

        if (session()->get("userRole") < 2) { //условия для ограничения просмотра роута, запрет
            header("Location: /");
            exit();
        }
        //Заполняем свойство класса объектом таблицы
        $this->users = new User();
        $this->allroles = new Role();
        $this->groupPolicy = new Group();
        $this->usersSelectedGroup = new UserSelectedGroup();
        $this->data["page_name"] = "Политики";

        $this->companys = new Company();
    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }

        $userid = session()->get("userId");
        $compan = $this->users->find($userid);

        if ($userid !== '1' && $userid !== '2') {
            //Не используем билдер, подключаемся к модели Companys и применяем метод findAll() (все записи)
            $this->data ["usersSelectedGroup"] =
                $this->usersSelectedGroup
                    ->join('users', 'user_selected_group.user_id = users.id')
                    ->join('group_policy', 'user_selected_group.group_id = group_policy.id')
                    ->select('user_selected_group.id, user_selected_group.user_id, user_selected_group.group_id,users.username as username,group_policy.group_name as groupname')
                    ->where('users.company_id', $compan['company_id'])//
                    ->where('user_selected_group.deleted_at IS NULL')
                    ->get()
                    ->getResultArray();
            $this->data ["groupPolicy"] = $this->groupPolicy
                ->join('companys', 'group_policy.company_id = companys.id')
                ->select('group_policy.id, group_policy.group_name, group_policy.group_description, companys.name as company_name')
                ->where('group_policy.deleted_at IS NULL')
                ->where('group_policy.company_id', $compan['company_id'])
                ->get()
                ->getResultArray();
            $this->data ["users"] = $this->users
                ->join('roles', 'users.role_id = roles.id')
                ->join('companys', 'users.company_id = companys.id')
                ->select('users.id, users.username, users.created_at, users.updated_at, roles.role_name, companys.name as company_name')
                ->where('users.deleted_at IS NULL')
                ->where('users.company_id', $compan['company_id'])
                ->get()
                ->getResultArray();
            $this->data ["companys"] = $this->companys->findAll();
            return view('dashboard/usersGPO', $this->data);
        } else {
            $this->data ["usersSelectedGroup"] =
                $this->usersSelectedGroup
                    ->join('users', 'user_selected_group.user_id = users.id')
                    ->join('group_policy', 'user_selected_group.group_id = group_policy.id')
                    ->select('user_selected_group.id, user_selected_group.user_id, user_selected_group.group_id,users.username as username,group_policy.group_name as groupname')   //
                    ->where('user_selected_group.deleted_at IS NULL')
                    ->get()
                    ->getResultArray();
            $this->data ["groupPolicy"] = $this->groupPolicy->findAll();
            $this->data ["users"] = $this->users->findAll();
            $this->data ["companys"] = $this->companys->findAll();
            return view('dashboard/usersGPO', $this->data);
        }
//        return view('dashboard/usersGPO', $this->data);
    }

    //Теперь у нас всего 1 метод управления страницей, он умеет обрабатывать все нужные нам ПОСТ запросы
    public function operation()
    {
        //Из контроллера можно напрямую обращаться в $this->request, не инициализируя его
        if ($this->request->getPost("delete")) {
            if (!$this->request->getPost("checkboxDel")) {
                header("Location: /usersGPO");
            }
            foreach ($this->request->getPost("checkboxDel") as $item) {
                $this->companys->delete($item);
            }
            header("Location: /usersGPO");
        }

        if ($this->request->getPost("addEdit")) {
            if ($this->request->getPost("id")) {
                $this->companys
                    ->update($this->request->getPost("id"), [
                        'name' => $this->request->getPost("name"),
                        'inn' => $this->request->getPost("inn"),
                        'kpp' => $this->request->getPost("kpp"),
                    ]);
                header("Location: /usersGPO");
            } else {
                $this->companys
                    ->insert([
                        'name' => $this->request->getPost("name"),
                        'inn' => $this->request->getPost("inn"),
                        'kpp' => $this->request->getPost("kpp"),
                    ]);
                header("Location: /usersGPO");
            }
        }

        if ($this->request->getPost("updating")) {
            $row = $this->companys
                ->where(["id" => $this->request->getPost("updating")])
                ->first();
            $data = [
                "companys" => $this->companys->findAll(),
                "curCompany" => $row,
            ];
            return view('dashboard/usersGPO', $data);
        }

        if ($this->request->getPost("cancel")) {

            header("Location: /usersGPO");
        }
    }
}
