<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use App\Models\Role;

class RoleController extends BaseController
{

    protected $data;
    protected $allroles;


    public function __construct()
    {
//        if (!$this->isSuper()) { //условия для ограничения просмотра роута, запретить
//            header("Location: /");
//            exit();
//        }
        $this->allroles = new Role();
        $this->data["page_name"] = "Список ролей";
        $this->data["allroles"] = $this->allroles->findAll();
    }

    public function index()
    {
        if (!$this->isAdmin()) { //условия для ограничения просмотра роута, запретить
            header("Location: /");
            exit();
        }

        $this->isAuth();

        $this->data["allroles"] = $this->allroles
            ->select('roles.id, roles.role_name, roles.created_at, roles.updated_at')
            ->where('roles.deleted_at IS NULL')
            ->get()
            ->getResultArray();

        return view('dashboard/roles', $this->data);
    }
    public function operation()
    {
           if ($this->request->getPost("delete")) {
            if (!$this->request->getPost("checkboxDel")) {
                header("Location: /roles");
                exit();
            }
            foreach ($this->request->getPost("checkboxDel") as $item) {
                $this->allroles->delete($item);
            }
            header("Location: /roles");
        }
        header("Location: /roles");
    }

}