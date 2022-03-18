<?php

namespace App\Libraries;

use App\Models\Log;
use CodeIgniter\Model;

class Logging
{

    public static function logMessage($logStroke = "")
    {
        $log = new Log(); //свойство лог стало равно объекту
        $log->insert(["log" => $logStroke]);
    }


}

