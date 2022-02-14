<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Models\Log;
use CodeIgniter\Controller;
use App\Models\Debet;
use App\Models\Credit;
use http\Url;
use \CodeIgniter\HTTP;

class BaseController extends Controller
{

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];
    protected $log;
    protected $debets;
    protected $credits;

    /**
     * Constructor.
     */

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

    }

    public static function shortName($name)
    {
        if (strpos($name, '@')) $name = mb_substr($name, 0, strpos($name, "@"));
        if (strlen($name) > 15) $name = mb_substr($name, 0, 15) . "...";
        return $name;
    }

    public static function ddd($var)
    {

        echo "<pre>";
        var_dump($var);
        die();
    }


    public function logMessage($logStroke = "")
    {
        $this->log = new Log(); //свойство лог стало равно объекту
        $this->log->insert(["log" => $logStroke]);
    }


    //////////////////////////////////////// Методы - хэлперы для определения уровня доступа ///////////////////////
    ///

    public function isAdmin():bool
    {
        if (session()->get("userRole") < 3)
        return false;
        else return true;
    }

    public function isSuper():bool
    {
        if (session()->get("userRole") != 4)
            return false;
        else return true;
    }

    public function isDirector():bool
    {
        if (session()->get("userRole") != 2)
            return false;
        else return true;
    }

    public function isClient():bool
    {
        if (session()->get("userRole") != 1)
            return false;
        else return true;
    }

    public function isAuth():bool
    {
        if (!session()->get("userId")) {
            header("Location: /login");
            exit();
        }
        return true;
    }

    public function isZoom():bool{
       if (session()->get("zoom_id")) return true;
       else return false;
    }

    ///
    /// ////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
