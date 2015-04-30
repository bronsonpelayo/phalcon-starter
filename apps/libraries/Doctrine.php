<?php
namespace Libraries;

use Doctrine\Common\ClassLoader,
	Doctrine\ORM\Tools\Setup,
	Doctrine\ORM\EntityManager;

/**
 * Class Doctrine
 * @package Libraries
 */

class Doctrine
{
	public $entityManager;

	public function __construct($database = "default")
	{
		require_once __DIR__ . '/Doctrine/ORM/Tools/Setup.php';
		Setup::registerAutoloadDirectory(__DIR__);
		// Load the database configuration from Phalcon
        $config = include __DIR__ . "/../config/config.php";
        $db = $config->database->{$database} ;
		$connectionOption = array(
			'driver'		=> $db->driver,
			'user'			=> $db->username,
			'password'		=> $db->password,
			'host'			=> $db->host,
			'dbname'		=> $db->dbname,
			'charset'		=> 'utf8'
		);

		$modelsNamespace = $db->modelNamespace;
		$modelsPath = $db->modelPath;
		$proxiesDir = '../core/entities/proxies';
		$metadataPaths = array($db->modelPath);

		// Set to TRUE to disable caching
		$developmentMode = false;

		$configAnnotation = Setup::createAnnotationMetadataConfiguration($metadataPaths, $developmentMode, $proxiesDir);
		$this->entityManager = EntityManager::create($connectionOption, $configAnnotation);

		$loader = new ClassLoader($modelsNamespace, $modelsPath);
		$loader->register();
    }
}
