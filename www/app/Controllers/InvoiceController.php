<?php namespace App\Controllers;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use App\Models\Debet;
use CodeIgniter\HTTP\RequestInterface;

class InvoiceController extends BaseController
{

    protected $invoices;
    protected $users;
    protected $companys;
    protected $allroles;
    protected $debets;


    public function __construct()
    {
        if (session()->get("userRole") < 2) { //условия для ограничения просмотра роута
            header("Location: /");
            exit();
        }
        $this->invoices = new Invoice();
        $this->users = new User();
        $this->companys = new Company();
        $this->allroles = new Role();
        $this->debets = new Debet();
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

        return view('dashboard/invoice', $data);
//        }
    }

    private function invoicesOperation() //
    {

    }

    public function statusInv($pay = "none")
    {

        //Написать функцию одтверждения оплаты и перерасчета баланса

        //   http://localhost:85/statusInv/idInvoice_userID_actualPaymentAmount
        //   http://localhost:85/statusInv/3_3_6000

        $separator = "_";
        list($idIn, $usID, $sumIn) = explode($separator, $pay);

        $entrancePay = $this->invoices
            ->where('id', $idIn)
            ->where('user_id', $usID)
            ->first(); //Возвращает строку из бд

//        var_dump($entrancePay ["id"]);
//        die();

        $deb = $this->debets
            ->select("SUM(amount) AS total")
            ->where("invoice_id", $idIn)
            ->first();

        $paymentVerif = $sumIn + current($deb);

//        var_dump($sumIn, current($deb), $x);
//        var_dump($sumIn,current($deb));
//        die();

        if ($entrancePay ["id"] !== NULL) {
            if ($entrancePay ["amount"] <= $paymentVerif) {
                $this->invoices
                    ->update($entrancePay ["id"], [
                        'status' => "paid",
                    ]);
            } else {
                $this->invoices
                    ->update($entrancePay ["id"], [
                        'status' => "partially paid",
                    ]);
            }
            $this->debets
                ->insert([
                    'user_id' => $entrancePay ["user_id"],
                    'invoice_id' => $idIn,
                    'amount' => $sumIn,
                ]);
            $this->debitcredit();

            session()->set([
                'userId' => $entrancePay["user_id"],
//                'userRole' => $entranceUs["role"],
//                'userName' => self::shortName($entranceUs["username"]),
            ]);
            header("Location: /profile");
            exit();
        }

        header("Location: /login");
        exit();
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