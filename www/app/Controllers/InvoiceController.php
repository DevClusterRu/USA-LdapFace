<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class InvoiceController extends BaseController {



    private function getAllinvoice() //получение из бд всех оплат
    {
        $db = \Config\Database::connect();
        $builder = $db->table('invoices');
        $builder->select('invoices.invoice_num, users.username, invoices.status');
        $builder->join('users', 'users.id = invoices.user_id');
        return $builder->get()->getResultArray();
    }


    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }

//        $users = new \App\Models\User(); //объект модели юзер. общение с бд через модель
//        $usersList = $users->select([])->findAll();//выборка из бд

//        echo '<pre>';
//        var_dump($query);
//        die();

        $data = [
            "invoiceAll"=>$this->getAllinvoice()
        ];  //

        return view('dashboard/invoice',$data);
    }







}