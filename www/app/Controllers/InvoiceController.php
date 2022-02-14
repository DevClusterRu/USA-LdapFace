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
        //TODO Что это?
        $userid = session()->get("userId");
        $compan = $this->users->find($userid);

        if ($userid !== '1' && $userid !== '2') {

            $this->data["invoices"] =
                $this->invoices
                    ->join('users', 'invoices.user_id = users.id')
                    ->join('companys', 'users.company_id = companys.id')
                    ->select('invoices.id, invoices.amount, invoices.status, invoices.created_at, invoices.updated_at, users.username, companys.name as company_name')
                    ->where('invoices.deleted_at IS NULL')
                    ->where('users.company_id', $compan['company_id']) // user
                    ->get()
                    ->getResultArray();

        } else {
            $this->data["invoices"] =
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


    public function statusInv()
    {
        //TODO Эта функция - что делает и почему нигде не вызывается?

        //Написать функцию одтверждения оплаты и перерасчета баланса
        //   http://localhost:85/statusInv/idInvoice_userID_actualPaymentAmount
        //   http://localhost:85/statusInv/1_100_5000


        $pay = $this->request->getJSON();
        $secrKey= $pay->secretKey;
        $Key ="iukjgb5kik4h5i4h5i3k4";


        if ($secrKey == $Key){
//            echo "Hello!";
//            var_dump($s->amount);
//            die();
            $user_id = -1;
            $entrancePay = $this->invoices->where('id', $pay->invoice_id)->first();
            if (!$entrancePay) {
//                echo "WRONG";
                $this->debets->insert(['user_id' => $user_id, 'invoice_id' => $pay->invoice_id, 'amount' => $pay->amount]);
                return;
            }
            //Возвращает строку из бд

            $this->debets
                ->insert([
                    'user_id' => $entrancePay ["user_id"],
                    'invoice_id' => $pay->invoice_id,
                    'amount' => $pay->amount,
                ]);


            //Здель вставка в дебет поступившей оплаты


            $deb = $this->debets
                ->select("SUM(amount) AS total")
                ->where("invoice_id",  $pay->invoice_id)
                ->first();



            if ((int)$entrancePay ["amount"] <= (int) $deb["total"]) {
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
        }
    }

}