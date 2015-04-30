<?php
namespace Area\Frontend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\DiInterface;
use Phalcon\Di\InjectionAwareInterface;

/**
 * Class Module
 * @package Area\Frontend
 */
class Module implements ModuleDefinitionInterface
{

    /**
     * Registers the module auto-loader
     * @param DiInterface $dependencyInjector
     */
    public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = null)
    {

        $loader = new Loader();

        $loader->registerNamespaces(
            array('Area\Frontend\Controllers' =>  '../apps/area/frontend/controllers/'
                , 'Area\Frontend\Models' =>  '../apps/area/frontend/models/'
            ,'Core\Entities' => '../apps/core/entities/'
            ,'Core\Repositories' => '../apps/core/repositories/'
            ,'Core\ViewModels' => '../apps/core/viewmodels/'
            //,'Libraries' => '../apps/libraries/Doctrine'
            ,'Doctrine\ORM\Mapping' => '../apps/libraries/Doctrine/ORM/Mapping'
            ,'Doctrine\Common\ClassLoader' => '../apps/libraries/Doctrine/Common/'
            ,'Doctrine\ORM\Tools\Setup' => '../apps/libraries/Doctrine/ORM/Tools/'
            ,'Doctrine\ORM\EntityManager' => '../apps/libraries/Doctrine/ORM/'
            ,'Libraries' => '../apps/libraries/'
            ,'Frontend\Forms' => '../apps/area/frontend/forms'
            //'Modules\Models\Services' => __DIR__ . '/../../models/services/',
            //'Modules\Models\Repositories' => __DIR__ . '/../../models/repositories/'
        ));


        $loader->register();
    }

    /**
     * Registers the module-only services
     * @param DiInterface $di
     */
    public function registerServices(\Phalcon\DiInterface  $di)
    {
        /**
         * Read configuration
         */
        $config = include __DIR__ . "/../../config/config.php";

        /**
         * Setting up the view component
         */
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir('../apps/area/frontend/views/');

            return $view;
        };

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di['db'] = function () use ($config) {
            return new DbAdapter(array(
                "host" => $config->database->host,
                "username" => $config->database->username,
                "password" => $config->database->password,
                "dbname" => $config->database->dbname
            ));
        };
    }
}
