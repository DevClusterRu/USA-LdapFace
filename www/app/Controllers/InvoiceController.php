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
    protected $data;

    public function __construct()
    {
        if ($this->isClient()) { //условия для ограничения просмотра роута
            header("Location: /");
            exit();
        }
        $this->invoices = new Invoice();
        $this->users = new User();
        $this->companys = new Company();
        $this->allroles = new Role();
        $this->debets = new Debet();
        $this->data["page_name"] = "Список счетов";
        $this->data["users"] = $this->users->findAll();
        $this->data["companys"] = $this->companys->findAll();
    }

    public function index()
    {
        $this->isAuth();
        $userid = session()->get("userId");
        $compan = $this->users->find($userid);

        if($userid!== '1' && $userid!=='2') {

            $this->data["invoices"]=
                $this->invoices
                    ->join('users', 'invoices.user_id = users.id')
                    ->join('companys', 'users.company_id = companys.id')
                    ->select('invoices.id, invoices.amount, invoices.status, invoices.created_at, invoices.updated_at, users.username, companys.name as company_name')
                    ->where('invoices.deleted_at IS NULL')
                    ->where('users.company_id', $compan['company_id']) // user
                    ->get()
                    ->getResultArray();

               } else {
            $this->data["invoices"]=
                $this->invoices
                    ->join('users', 'invoices.user_id = users.id')
                    ->join('companys', 'users.company_id = companys.id')
                    ->select('invoices.id, invoices.amount, invoices.status, invoices.created_at, invoices.updated_at, users.username, companys.name as company_name')
                    ->where('invoices.deleted_at IS NULL')
                    ->get()
                    ->getResultArray();
        }
        return view('dashboard/invoice', $this->data);
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


        $deb = $this->debets
            ->select("SUM(amount) AS total")
            ->where("invoice_id", $idIn)
            ->first();

        $paymentVerif = $sumIn + current($deb);
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
            ]);
            header("Location: /profile");
            exit();
        }
        header("Location: /login");
        exit();
    }

}