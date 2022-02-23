<?php

namespace App\Libraries;


class LdapChannelLibrary
{
//профайл контроллер лежит вызов функции.
    public static function curlRequest($body)
    {
        $client = \Config\Services::curlrequest();//метод кодегнитеера инструмент, (сервис- набор классов, чтобы воспользоваться нужнос создать объект)
//        $response = $client->request("GET", "https://lesovskie.com"); //клиент становится  объектом и записываем в респон ответ
        $response = $client->request('POST', 'http://10.175.255.30:8085/ldap', $body);//этот реквест отправляет,
        //то что ответил сервер ( реквест клиент) возвращается в респонс

        $resp1Json = json_decode($response->getBody());
        if ($resp1Json->result == false) {  //логирование
            Logging::logMessage($resp1Json->response);

        }
        return $response;// возвращает объект ответа

    }


    public static function createOrganization($domain, $baseDn, $groupName)    //Done
    {
        return self::curlRequest(
            ['json' => [
                "command" => "CreateOrganization",
                "domain" => $domain,
                "baseDN" => $baseDn,
                "group" => $groupName
            ]]);
    }

    public static function dropPassword($domain, $user)          //Done
    {
        return self::curlRequest(
            ['json' => [
                "command" => "DropPassword",
                "domain" => $domain,
                "user" => $user,
            ]]);
    }

    public static function createUser($name, $phone, $email, $baseDn, $domain)    //Done
    {
        return self::curlRequest(
            ['json' => [
                "command" => "CreateUser",
                "domain" => $domain,
                "baseDN" => $baseDn,
                "name" => $name,
                "phone" => $phone,
                "email" => $email
            ]]);
    }

    public static function createGroup($domain, $baseDn, $group)      //Done
    {
        return self::curlRequest(
            ['json' => [
                "command" => "CreateGroup",
                "domain" => $domain,
                "baseDN" => $baseDn,
                "group" => $group

            ]]);
    }

    public static function assignUser($domain, $targetGroup, $user)     //Done
    {
        return self::curlRequest(
            ['json' => [
                "command" => "AssignUser",
                "domain" => $domain,
                "targetGroup" => $targetGroup,
                "user" => $user
            ]]);
    }

    public static function deleteObject($domain, $name)           // groupPolicy-Done, users - Done, companys Done
    {
        return self::curlRequest(
            ['json' => [
                "command" => "DeleteObject",
                "domain" => $domain,
                "name" => $name
            ]]);
    }
//    EditUser ("name", "baseDN", "domain", "phone", "email")

    public static function editUser ($name,$baseDn,$domain, $phone, $email)
    {
        return self::curlRequest(
            ['json' => [
                "command" => "EditUser",
                "name" => $name,
                "baseDN" => $baseDn,
                "domain" => $domain,
                "phone" => $phone,
                "email" => $email
            ]]);
    }

    public static function unassignUser($domain, $targetGroup, $user)   //Done
    {
        return self::curlRequest(
            ['json' => [
                "command" => "UnassignUser",
                "domain" => $domain,
                "targetGroup" => $targetGroup,
                "user" => $user
            ]]);
    }

    public static function userActivation($domain, $name)
    {
        return self::curlRequest(
            ['json' => [
                "command" => "UserActivation",
                "domain" => $domain,
                "name" => $name
            ]]);
    }

    public static function userDisabling($domain, $name)
    {
        return self::curlRequest(
            ['json' => [
                "command" => "UserDisabling",
                "domain" => $domain,
                "name" => $name
            ]]);
    }
}