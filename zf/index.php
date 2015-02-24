<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/applications'));

define('BASE_DIR', realpath(dirname(__FILE__)));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/library'),
    get_include_path(),
)));


require_once 'Zend/Controller/Front.php';
$frontController = Zend_Controller_Front::getInstance();

$arrayController = array(
	'acc' => BASE_DIR . '/applications/acc/controllers',
	'dashboard' =>  BASE_DIR . '/applications/dashboard/controllers'
);

$frontController->setControllerDirectory($arrayController);

$frontController->setDefaultModule('acc');
$frontController->setDefaultControllerName('index');
$frontController->setDefaultAction('index');


/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    BASE_DIR . '/configs/application.ini'
);
$application->bootstrap()
            ->run();

