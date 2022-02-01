<?php

namespace App\Libraries;

class LdapChannelLibrary
{
//профайл контроллер лежит вызов функции.
    public static function curlRequest()
    {  //статик без объекта существует
        $client = \Config\Services::curlrequest();//метод кодегнитеера
        $response = $client->request("GET", "https://lesovskie.com"); //клиент становится  объектом и записываем в респон ответ
        return $response;// возвращает объект ответа

    }


}