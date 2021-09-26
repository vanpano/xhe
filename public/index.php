<?php

$container = require(__DIR__ . '/../app/bootstrap.php');

$app = new Silly\Application();
$app->useContainer($container, $injectWithTypeHint = true);
$invoker = new Invoker\Invoker(null, $container);

$container->set('client', \DI\create('Xhe\Client')->constructor('127.0.0.1', 7012));

if (!$account = App\Model\GoogleAccountBuilder::findUnused())
	die('No accounts...');

if (!$event = App\Classes\RandomFile::get(EVENTS_DIR))
	die('No events found...');

$controller = (new App\Controller\GoogleAccountController());
$controller->set($account);

if (!$step1 = $invoker->call('App\Method\GooglePlaygroundLogin', [$controller]))
	die('Login error :(');

$step2 = $container->get('App\Command\GooglePlaygroundStep3')->credentials();
$step3 = $invoker->call('App\Command\GooglePlaygroundStep3', [
	'requestUri' => 'https://www.googleapis.com/calendar/v3/calendars/primary/events?maxAttendees=1000&sendUpdates=all',
	'requestMethod' => 'POST',
	'requestBody' => json_encode(json_decode(file_get_contents($event), true))
]);

printf('Hello and bye...');

$app->run();