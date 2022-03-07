<?php
/**
 * The bootstrap file creates and returns the container.
 */

use DI\ContainerBuilder; 

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/definitions.php';

$containerBuilder = new \DI\ContainerBuilder;
$containerBuilder->addDefinitions(__DIR__ . '/config.php');

$container = $containerBuilder->build();

$container->set('db', DI\create(Mysqlidb::class)->constructor('localhost', 'root', '', 'workflow'));
//$container->set('db', MysqliDb::getInstance());

$db = $container->get('db');
dbObject::autoload("models");

return $container;