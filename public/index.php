<?php

$container = require(__DIR__ . '/../app/bootstrap.php');

$app = new Silly\Application();
$app->useContainer($container, $injectWithTypeHint = true);
$invoker = new Invoker\Invoker(null, $container);

$container->set('client', \DI\create('Xhe\Client')->constructor('127.0.0.1', 7011));

if (!$account = App\Model\GoogleAccountBuilder::findUnused())
	die('No accounts...');
($controller = (new App\Controller\GoogleAccountController()))->set($account);

$invoker->call('App\Method\GoogleLogin', [$controller]);
$authCode = $invoker->call(function() use (&$container){
	preg_match("#code=(.*?)\&#", $container->get('webpage')->get_url(), $match);

	if (is_array($match) && isset($match[1]))
		return $match[1];
	return false;
});

var_dump($authCode);

printf('Hello and bye...');
$app->run();