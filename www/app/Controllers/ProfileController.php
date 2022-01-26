<?php namespace App\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\UserSelectedService;
use CodeIgniter\HTTP\RequestInterface;

class ProfileController extends BaseController
{
    protected $userModel;
    protected $serviceModel;
    protected $userSelectedService;


    public function __construct()
    {
        $this->userModel = new User();
        $this->serviceModel=new Service();
        $this->userSelectedService = new UserSelectedService();
    }

    function index()
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        $data = [
            "userInfo" => $this->userModel->find(session()->get("userId")),
            "userServicesList"=>$this->serviceModel
                ->join('user_selected_services', 'user_selected_services.service_id = services.id','left')
                ->select('services.id, services.name, services.type_service, services.cost, user_selected_services.service_id')
                ->get()
            ->getResultArray()
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

    function getPaymentPersInfo (){
        $db = \Config\Database::connect();
        $builder = $db->table('PaymentPers');
        $builder->select('type_of_service, current_service, price, get_bills, payment_before');
        return $builder->get()->getResultArray();





    }

}
