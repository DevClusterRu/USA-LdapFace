<?php namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;

class Workspace extends BaseController
{
    public function index()
    {

        if (!session()->get("userId")) {
            header("Location: /");
            exit();
        }

        if (!session()->get("userId")) {
            header("Location: /");
            exit();
        }

        $client = \Config\Services::curlrequest();
//        $response = $client->request('POST', 'http://10.200.88.200:8085/ldap', [
//            'json' => [
//                'command' => 'SearchUser',
//                'filter' => '(objectClass=user)',
//                'baseDN' => 'OU=Тестовые пользователи,DC=test,DC=lab',
//            ],
//        ]);


//        $data = [
//            "ldapUsers"=>json_decode($response->getBody())
//        ];

        $data = [
           "ldapUsers"=>["test"=>5,
               "test2"=>2,
               "test3"=>3,
               "test4"=>4,
               "test7"=>7,
               ]
        ];

        return view('dashboard/content', $data);

    }

}