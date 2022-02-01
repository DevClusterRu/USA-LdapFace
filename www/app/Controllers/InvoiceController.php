<?php namespace App\Controllers;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use CodeIgniter\HTTP\RequestInterface;

class InvoiceController extends BaseController {

    protected $invoices;
    protected $users;
    protected $companys;
    protected $allroles;




    public function __construct()
    {
        if (session()->get("userRole") < 2) { //условия для ограничения просмотра роута
            header("Location: /");
            exit();
        }
        $this->invoices = new Invoice();
        $this->users= new User();
        $this->companys = new Company();
        $this->allroles = new Role();
    }

    public function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }



        $userid = session()->get("userId");
      $compan = $this->users->find($userid);
//        var_dump ($compan['company_id']);
//             die();

//        if (session()->get("userId") < 2) {

            $data = [
            "invoices" => $this->invoices
                ->join('users', 'invoices.user_id = users.id')
                ->join('companys', 'users.company_id = companys.id')
                ->select('invoices.id, invoices.invoice_num, invoices.amount, invoices.status, invoices.created_at, invoices.updated_at, users.username, companys.name as company_name')
                ->where('invoices.deleted_at IS NULL')
                ->where('users.company_id', $compan['company_id']) // user
                ->get()
                ->getResultArray(),
            "users" => $this->users->findAll(),
            "companys" => $this->companys->findAll(),
//                ->findAll(), // будующая переменная -> берет из свойства класса (равно объекту модели) , метод выбирает все записи из таблицы ивозвращает их в виде массива
//            $data = [
//            "invoiceAll"=>$this->getAllinvoice()
        ];

        return view('dashboard/invoice',$data);
//        }
    }

    private function invoicesOperation() //
   {

  }



//        var_dump($data);
////             die();

//
//    private function getAllinvoice() //получение из бд всех оплат
//    {
//        $db = \Config\Database::connect();
//        $builder = $db->table('invoices');
//        $builder->select('invoices.invoice_num, users.username, invoices.status');
//        $builder->join('users', 'users.id = invoices.user_id');
//        return $builder->get()->getResultArray();
//    }





}