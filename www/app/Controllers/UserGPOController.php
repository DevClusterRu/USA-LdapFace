<?php namespace App\Controllers;

use App\Libraries\LdapChannelLibrary;
use \App\Models\User;
use \App\Models\Group;
use \App\Models\UserSelectedGroup;
use App\Models\Role;
use \App\Models\Company;
use App\Models\Server;


class UserGPOController extends BaseController
{
    //Здесь мы создаем свойство класса companys  оно будет содержать модель таблицы companys

    protected $users;
    protected $groupPolicy;
    protected $usersSelectedGroup;
    protected $allroles;
    protected $data;
    protected $companys;
    protected $servers;

    //Метод __construct() - это конструктор класса, этот метод вызывается 1 раз при обращении к классу (при создании объекта класса)
    public function __construct()
    {
        if ($this->isClient()) { //условия для ограничения просмотра роута, запрет
            header("Location: /");
            exit();
        }
        //Заполняем свойство класса объектом таблицы
        $this->users = new User();
        $this->allroles = new Role();
        $this->groupPolicy = new Group();
        $this->servers = new Server();
        $this->usersSelectedGroup = new UserSelectedGroup();
        $this->data["page_name"] = "Политики";

        $this->companys = new Company();
    }

    public function index()
    {
        $this->isAuth();
        $userid = session()->get("userId");
        $compan = $this->users->find($userid);
        if ($this->isDirector()) {
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
                ->select('users.id, users.username, users.created_at, users.updated_at, roles.role_id, roles.role_name, companys.name as company_name')
                ->where('users.deleted_at IS NULL')
                ->where('users.company_id', $compan['company_id'])
                ->get()
                ->getResultArray();
            $this->data ["usersSelectedGroupTotal"] =  $this->usersSelectedGroup->findAll();
            $this->data ["companys"] = $this->companys->findAll();
            return view('dashboard/gPOUsers', $this->data);
        } else {
            $this->data ["usersSelectedGroup"] =
                $this->usersSelectedGroup
                    ->join('users', 'user_selected_group.user_id = users.id')
                    ->join('group_policy', 'user_selected_group.group_id = group_policy.id')
                    ->select('user_selected_group.id, user_selected_group.user_id, user_selected_group.group_id,users.username as username,group_policy.group_name as groupname')   //
                    ->where('user_selected_group.deleted_at IS NULL')
                    ->get()
                    ->getResultArray();
            $this->data ["usersSelectedGroupTotal"] =  $this->usersSelectedGroup->findAll();

            $this->data ["groupPolicy"] = $this->groupPolicy->findAll();
            $this->data ["users"] = $this->users->findAll();
            $this->data ["companys"] = $this->companys->findAll();
            return view('dashboard/gPOUsers', $this->data);
        }
    }

    function bindGPtoUser()
    {

        $checkboxSelected = $this->request->getPost("checkboxGP");//получаем айди сервиса ( номер строчки)
        $checkboxSelectedDo = $this->request->getPost("doCheckbox");//получаем вид действия, строку сет или ансет
        $arr = explode("_", $checkboxSelected);
        if ($checkboxSelectedDo == "set") {

            $userInfo = $this->users->where('id', $arr[0])->first();
            $groupInfo = $this->groupPolicy->where('id', $arr[1])->first();
            $companInfo = $this->companys->where('id',$userInfo["company_id"])->first();
            $servInfo = $this->servers->where('id',$companInfo["server_id"])->first();
            //здесь отправить запрос в лдап
            $resp = LdapChannelLibrary::assignUser($servInfo["domain"], "CN=".$groupInfo["group_name"].","."OU=".$companInfo["name"]." - Группы доступа".","."OU=".$companInfo["name"].",".$servInfo["baseDn"],
                "CN=".$userInfo ["username"].","."OU=".$companInfo["name"]." - Пользователи".","."OU=".$companInfo["name"].",".$servInfo["baseDn"]);

            $respJson = json_decode($resp->getBody());
            if ($respJson->result == false){
                header("Location: /gPOUsers?error=gpUsExists");
                exit();
            }
            $this->usersSelectedGroup->insert(["user_id" => $arr[0], "group_id" => $arr[1]]);
        } else {

            $userInfo = $this->users->where('id', $arr[0])->first();
            $groupInfo = $this->groupPolicy->where('id', $arr[1])->first();
            $companInfo = $this->companys->where('id',$userInfo["company_id"])->first();
            $servInfo = $this->servers->where('id',$companInfo["server_id"])->first();
            //здесь отправить запрос в лдап
            $resp = LdapChannelLibrary::unassignUser($servInfo["domain"], "CN=".$groupInfo["group_name"].","."OU=".$companInfo["name"]." - Группы доступа".","."OU=".$companInfo["name"].",".$servInfo["baseDn"],
                "CN=".$userInfo ["username"].","."OU=".$companInfo["name"]." - Пользователи".","."OU=".$companInfo["name"].",".$servInfo["baseDn"]);

            $respJson = json_decode($resp->getBody());
            if ($respJson->result == false){
                header("Location: /gPOUsers?error=gpUNotExists");
                exit();
            }
                        $this->usersSelectedGroup
                ->where(["user_id" => $arr[0], "group_id" => $arr[1]])
                ->delete();
        }
    }
}
