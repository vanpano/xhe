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

$db = $container->get('db');
dbObject::autoload("models");

return $container;

/*
$container->set('connect', DI\create(App\Command\ConnectCommand::class)->constructor($container));
$container->set('cookie.set', DI\create(\App\Command\SetCookieCommand::class)->constructor($container));
$container->set('cookie.get', DI\create(\App\Command\GetCookieCommand::class)->constructor($container));
$container->set('cookie-url.set', DI\create(\App\Command\SetCookieForUrlCommand::class)->constructor($container));
$container->set('cookie-url.get', DI\create(\App\Command\GetCookieForUrlCommand::class)->constructor($container));
$container->set('navigate', DI\create(\App\Command\NavigateCommand::class)->constructor($container));
//$container->set('profile.load', DI\create(\App\Command\ProfileLoadCommand::class)->constructor($container));

$container->set('google.form.email', DI\create(\App\Command\GoogleFormEmailCommand::class)->constructor($container));
$container->set('google.login.command', DI\create(\App\Command\GoogleLoginCommand::class)->constructor($container));
$container->set('pinterest.login.command', DI\create(\App\Command\PinterestLoginCommand::class)->constructor($container));

$container->set('google.login.service', DI\create(\App\Service\LoginService::class)->constructor($container->get('google.login.command')));
$container->set('pinterest.login.service', DI\create(\App\Service\LoginService::class)->constructor($container->get('pinterest.login.command')));

$container->set('browser.settings', DI\create(\App\Service\BrowserSettingsService::class)->constructor($container));

$container->set('service.cookies', DI\create(\App\Service\Cookies::class)->constructor($container));
$container->set('service.cookies.import', $container->get('service.cookies')->import($coo));
$container->set('service.cookies.export', DI\create(\App\Service\CookiesExportService::class)->constructor($container));
$container->set('proxy.service', DI\create(\App\Service\Proxy::class)->constructor($container));
*/
//$container->set('service.proxy.init', DI\create(\App\Service\ProxyInit::class)->constructor($container->get('proxy.enable')));

/* Get cookies from ORM */
//$container->set('orm.cookies.get', DI\create(\App\Controller\Cookie::get)->constructor($container));

/* Get cookies from browser and update ORM model */
//$container->set('service.cookies.export', DI\create(\App\Service\Cookie::export)->constructor($container, $cookie));

/* Get proxy from ORM and update browser */
//$container->set('service.proxy.import', DI\create(\App\Service\Proxy::import)->constructor($container, $proxy));

/* Update browser profile*/
//$container->set('service.profile.set', DI\create(\App\Service\Profile::set)->constructor($container, $profile));

//$container->set('service.profile.generator', DI\create(\App\Service\Profile::import)->constructor($container, $profile));


