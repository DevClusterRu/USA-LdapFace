<?php namespace App\Controllers;

use App\Models\Server;

class ServerController extends BaseController
{

    protected $servers;
    protected $data;

    public function __construct()
    {
        if(session()->get("userRole")<3) { //условия для ограничения просмотра роута
            header("Location: /");
            exit();
        }
        $this->servers = new Server();
        $this->data["page_name"] = "Список серверов";
    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }

        $this->data["servers"]=$this->servers->findAll();
        return view('dashboard/serversV', $this->data);
    }
    public function operation()
    {
        //Из контроллера можно напрямую обращаться в $this->request, не инициализируя его
        if ($this->request->getPost("delete")) {
            if (!$this->request->getPost("checkboxDel")){
                header("Location: /serversV");
                exit();
            }
            foreach ($this->request->getPost("checkboxDel") as $item) {
                $this->servers->delete($item);
            }
            header("Location: /serversV");
        }

        if ($this->request->getPost("addEdit")) {
            if ($this->request->getPost("id")) {
                $this->servers
                    ->update($this->request->getPost("id"), [
                        'domain' => $this->request->getPost("domain"),
                        'url' => $this->request->getPost("url"),
                        'login' => $this->request->getPost("login"),
                        'password' => $this->request->getPost("password"),
                    ]);
                header("Location: /serversV");
            } else {
                $this->servers
                    ->insert([
                        'domain' => $this->request->getPost("domain"),
                        'url' => $this->request->getPost("url"),
                        'login' => $this->request->getPost("login"),
                        'password' => $this->request->getPost("password"),
                    ]);
                header("Location: /serversV");
            }
        }

        if ($this->request->getPost("updating")) {
            $row = $this->servers
                ->where(["id" => $this->request->getPost("updating")])
                ->first();
            $this->data["servers"]=$this->servers->findAll();
            $this->data["curServer"]=$row;
            return view('dashboard/serversV', $this->data);
        }
    }
}
