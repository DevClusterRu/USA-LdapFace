<?php

namespace App\Libraries;

use App\Models\Credit;
use App\Models\Debet;

class Finances
{

    function __construct()
    {
        parent::__construct();
    }

    public static function debetCredit($user=0)
    {
        $debets = new Debet();  //в Свойство debets вкладывается объект
        $credits = new Credit();
        if (!$user) return null;
        $debTotal = 0;
        $deb = $debets
            ->select("SUM(amount) AS total")
            ->where("user_id", $user)
            ->first();
        if ($deb) {
            $debTotal = $deb["total"];
        }
        $credTotal = 0;
        $cred = $credits
            ->select("SUM(amount) AS total")
            ->where("user_id", $user)
            ->first();
        if ($cred) {
            $credTotal = $cred["total"];
        }
        $balance = (int)$debTotal - (int)$credTotal;

        return $balance;
    }


}