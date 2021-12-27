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

use CodeIgniter\Controller;
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
    public $titles;
    public static $roles;

	/**
	 * Constructor.
	 */

	public static function shortName($name)
    {
        if (strpos($name,'@')) $name = mb_substr($name,0,strpos($name,"@"));
        if (strlen($name)>15) $name = mb_substr($name, 0, 15)."...";
        return $name;
    }

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);


        //if (!session()->get("userId") && uri_string() != "/" && uri_string() != "register") {
        //    header("Location: /");
        //    exit();
        //}

//        $this->titles = [
//            "kanban" => "Главная",
//            "register" => "Регистрация",
//            "login" => "Авторизация",
//            "users" => "Пользователи",
//            "addproject"=>"Добавление нового проекта",
//        ];
//
//        self::$roles = [
//            "user" => lang('Main.user'),
//            "admin" => lang('Main.admin'),
//        ];

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
	}

	public static function ddd($var)
    {
        echo "<pre>";
        var_dump($var);
        die();
    }

}
