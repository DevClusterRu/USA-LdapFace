<?php namespace App\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use App\Models\Group;

class GroupPolicyController extends BaseController
{
    protected $users;
    protected $companys;
    protected $allroles;
    protected $groupPolicy;
    protected $data;

    public function __construct()
    {
        $this->users = new User();
        $this->companys = new Company();
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

            return view('dashboard/groupPolicy',  $this->data);
        }
        header("Location: /groupPolicy");
    }


}