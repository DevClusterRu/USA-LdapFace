<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class InvoiceController extends BaseController {

    public function __construct()
    {
        if (session()->get("userRole") < 4) { //условия для ограничения просмотра роута
            header("Location: /");
            exit();
        }
    }


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
        $data = [
            "invoiceAll"=>$this->getAllinvoice()
        ];
        return view('dashboard/invoice',$data);
    }







}