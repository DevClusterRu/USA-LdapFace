<?php namespace App\Controllers;

use App\Models\Service;

class ServiceController extends BaseController
{

    protected $services;

    public function __construct()
    {
        $this->services = new Service();
    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        $data = [
            "servicesAll" => $this->services->findAll(),
        ];
        return view('dashboard/services', $data);
    }







}
