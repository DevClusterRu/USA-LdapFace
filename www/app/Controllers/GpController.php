<?php namespace App\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use App\Models\Group;

class GpController extends BaseController
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
        $this->data["page_name"] = "Политики";
    }

    public function index()
    {
        return view('dashboard/gp', $this->data);
    }


}