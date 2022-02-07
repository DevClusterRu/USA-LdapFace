<?php namespace App\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\UserSelectedService;
use App\Models\Invoice;
use App\Libraries\LdapChannelLibrary;

use CodeIgniter\HTTP\RequestInterface;

class ProfileController extends BaseController
{
    protected $userModel;
    protected $serviceModel;
    protected $userSelectedService;
    protected $invoices;



    public function __construct()
    {

        $this->userModel = new User();
        $this->serviceModel=new Service();
        $this->userSelectedService = new UserSelectedService();
        $this->invoices = new Invoice();

    }

    function index()
    {
        //TODO curl
//         var_dump(LdapChannelLibrary::curlRequest()); //курл ,вставить после приглашения
//        die();

        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        $data = [
            "userInfo" => $this->userModel->find(session()->get("userId")),
            "servicesAll" => $this->serviceModel->get()->getResultArray(),
            "userServicesList"=>$this->userSelectedService->where("user_id", session()->get("userId"))->get()->getResultArray(),
            "invoices" => $this->invoices->findAll(),

//            "debets" => $this->debets->findAll(),
//            "credits" => $this->credits->findAll(),

        ];

//        "selectedServices"=>$this->userSelectedService->where([
//        "user_id"=>session()->get("userId")
//    ])->get()->getResultArray()
        return view('dashboard/profile', $data);

    }


    function changeUserInfo()
    {
        $request = service('request');//c вью на контроллер
        $phone = $request->getPost("phone");
        $email = $request->getPost("email");

        $user = new \App\Models\User();

        $dataInfo = [
            'phone' => $phone,//в левой части мы указываем имя поля таблицы, в правой переменную нового значения поля
            'email' => $email,
        ];


        $user->update(session()->get("userId"), $dataInfo); //обвновляет бд
        header("Location: /profile");
    }

    function changeUserPassword()
    {
        $request = service('request');//c вью на контроллер
        $password1= $request->getPost("password1");//переменная из вью (из объекта реквест)
        $password2= $request->getPost("password2");

        $user = new \App\Models\User(); //объект таблицы бд юзер


        if ($password1==$password2) {
            $dataPassword = [
                'password' => password_hash($password1,PASSWORD_BCRYPT) //запись в бд значения переменной
            ];
            }
        $user->update(session()->get("userId"), $dataPassword);
        header("Location: /profile");

    }

   function аddInvoice()
    { if ($this->request->getPost("addButton")) {

        $user = session()->get("userId");
        if ( $this->request->getPost("amount")!=="0" && $this->request->getPost("amount")!== 0 && $this->request->getPost("amount")!== "" ) {

//        $namIn = $this->request->getPost("amount");
//        var_dump($namIn);
//        die();

            $this->invoices
            ->insert([
//                'invoice_num' => $this->invoices->   ( 'id'),
                'user_id' => $user,
                'amount' => $this->request->getPost("amount"),
                'status' => "new",
                ]);
//        header("Location: /invoices");
        }
        header("Location: /invoices");
    } elseif ($this->request->getPost("cancel")) {
            header("Location: /profile");
//           //  return view('dashboard/serverlist', $data);
        }
    }

    function getPaymentPersInfo (){
        $db = \Config\Database::connect();
        $builder = $db->table('PaymentPers');
        $builder->select('type_of_service, current_service, price, get_bills, payment_before');
        return $builder->get()->getResultArray();

    }


}
