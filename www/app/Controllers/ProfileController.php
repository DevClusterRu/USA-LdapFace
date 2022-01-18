<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class ProfileController extends BaseController
{

    function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        return view('dashboard/profile');
    }
}
