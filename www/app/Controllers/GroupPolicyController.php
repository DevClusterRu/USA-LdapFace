<?php namespace App\Controllers;

use App\Libraries\LdapChannelLibrary;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use App\Models\Group;
use App\Models\Server;

class GroupPolicyController extends BaseController
{
    protected $users;
    protected $companys;
    protected $allroles;
    protected $groupPolicy;
    protected $servers;
    protected $data;


    public function __construct()
    {
        $this->users = new User();
        $this->companys = new Company();
        $this->servers = new Server();
        $this->allroles = new Role();
        $this->groupPolicy = new Group();
        $this->data["page_name"] = "Групповые политики";
        $this->data["users"] = $this->users->findAll();
        $this->data["companys"] = $this->companys->findAll();

    }

    public function index()
    {
        if (!$this->isAdmin()) { //условия для ограничения просмотра роута, запретить
            header("Location: /");
            exit();
        }

        $this->isAuth();
        $this->data["groupPolicy"] = $this->groupPolicy
            ->join('companys', 'group_policy.company_id = companys.id')
            ->select('group_policy.id, group_policy.group_name, group_policy.group_description, companys.name as company_name')
            ->where('group_policy.deleted_at IS NULL')
            ->get()
            ->getResultArray();

        return view('dashboard/groupPolicy', $this->data);

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

                $groupInfo = $this->groupPolicy->where('id', $item)->first();
                $companInfo = $this->companys->where('id', $groupInfo["company_id"])->first();
               $servInfo = $this->servers->where('id',$companInfo["server_id"])->first();
//
//                //здесь отправить запрос в лдап на удаление GP
                //                deleteObject($domain, $name)
                $resp = LdapChannelLibrary::deleteObject($servInfo["domain"],"CN=".$groupInfo["group_name"].","."OU=".$companInfo["name"]." - Группы доступа".","."OU=".$companInfo["name"].",".$servInfo["baseDn"]);

                $respJson = json_decode($resp->getBody());

                if ($respJson->result == false){
                    header("Location: /groupPolicy?error=delGPExists");
                    exit();
                }
                $this->groupPolicy->delete($item);
            }
            header("Location: /groupPolicy");
        }

        if ($this->request->getPost("addEdit")) {
            if ($this->request->getPost("id")) {

                $this->groupPolicy
                    ->update($this->request->getPost("id"), [
                        'group_name' => $this->request->getPost("group_name"),
                        'company_id' => $this->request->getPost("company"),
                        'group_description' => $this->request->getPost("group_description"),
                    ]);
                header("Location: /groupPolicy");
            } else {


              $groupInfo = $this->request->getPost();
                $companInfo = $this->companys->where('id',$this->request->getPost("company"))->first();
              $servInfo = $this->servers->where('id',$companInfo["server_id"])->first();
              $resp = LdapChannelLibrary::createGroup($servInfo["domain"], "OU=".$companInfo["name"]." - Группы доступа".","."OU=".$companInfo["name"].",".$servInfo["baseDn"],$groupInfo["group_name"]);
                $respJson = json_decode($resp->getBody());

                if ($respJson->result == false){
                    header("Location: /groupPolicy?error=gpExists");
                    exit();
                }

                $this->groupPolicy
                    ->insert([
                        'group_name' => $this->request->getPost("group_name"),
                        'company_id' => $this->request->getPost("company"),
                        'group_description' => $this->request->getPost("group_description"),
                    ]);
                header("Location: /groupPolicy");
            }
        }

        if ($this->request->getPost("updating")) {
            $row = $this->groupPolicy
                ->where(["id" => $this->request->getPost("updating")])
                ->first();


            $this->data ["groupPolicy"] =
                $this->groupPolicy
                    ->join('companys', 'group_policy.company_id = companys.id')
                    ->select('group_policy.id, group_policy.group_name, group_policy.group_description, companys.name as company_name')
                    ->where('group_policy.deleted_at IS NULL')
                    ->get()
                    ->getResultArray();
            $this->data ["curGroup"] = $row;
            session()->set( ['gpoUpDown'=> "",]);
            return view('dashboard/groupPolicy',  $this->data);
        }

        if ($this->request->getPost("choice")) {

            session()->set("filterCompany",$this->request->getPost("choiceCompanyTru") );


//            var_dump(session()->get());
//            die();

            $choicerow = $this->companys
                ->where(["id" => $this->request->getPost("choiceCompanyTru")])
                ->first();


            $this->data["groupPolicy"] = $this->groupPolicy
                ->join('companys', 'group_policy.company_id = companys.id')
                ->select('group_policy.id, group_policy.group_name, group_policy.group_description, companys.name as company_name')
                ->where('group_policy.company_id', $choicerow["id"])
                ->where('group_policy.deleted_at IS NULL')
                ->get()
                ->getResultArray();
            $this->data ["choiCompany"]=$choicerow["name"];
            return view('dashboard/groupPolicy', $this->data);
          }

        header("Location: /groupPolicy");
    }


}