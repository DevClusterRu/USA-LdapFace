<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class ServicesController extends BaseController
{


    private function getAllServices() //получение из бд всех серверов
    {
        $db = \Config\Database::connect();
        $builder = $db->table('services');
        $builder->select('services.id, services.name, services.date_to, services.coast');
        return $builder->get()->getResultArray();
    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        $data = [
            "servicesAll" => $this->getAllServices()
        ];  //передача переменной юзерсОл во вью
        return view('dashboard/services', $data);
    }







}
