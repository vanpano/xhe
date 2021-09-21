<?php

$container = require(__DIR__ . '/../app/bootstrap.php');

$app = new Silly\Application();
$app->useContainer($container, $injectWithTypeHint = true);
$invoker = new Invoker\Invoker(null, $container);

$container->set('client', \DI\create('Xhe\Client')->constructor('127.0.0.1', 7010));

if (!$account = App\Model\GoogleAccountBuilder::findUnused())
	die('No accounts...');

$controller = (new App\Controller\GoogleAccountController());
$controller->set($account);

if (!$step1 = $invoker->call('App\Method\GooglePlaygroundLogin', [$controller]))
	die('Login error :(');

$step2 = $container->get('App\Command\GooglePlaygroundStep3')->credentials();
$step3 = $invoker->call('App\Command\GooglePlaygroundStep3', [
	'requestUri' => 'https://www.googleapis.com/calendar/v3/calendars/primary/events?maxAttendees=1000&sendUpdates=all',
	'requestMethod' => 'POST',
	'requestBody' => json_encode([
		'summary' => 'Reminders test LAST',
		'description' => 'Just a test',
		'location' => 'Ukraine, Kiev', 
		'start' => [
			'dateTime' => '2021-09-20T18:10:00',
			'timeZone' => 'Europe/Kiev'
		],
		'end' => [
			'dateTime' => '2021-09-20T19:10:00',
			'timeZone' => 'Europe/Kiev'
		],
		'attendees' => [
			[
				'email' => 'cockpit.eden@gmail.com',
				'responseStatus' => 'accepted'
			],
			[
				'email' => 'wizard.folkway@gmail.com',
				'responseStatus' => 'accepted'
			],
			[
				'email' => 'gandalf@alterpost.org',
				'responseStatus' => 'accepted'
			],
		],
		'visibility' => 'public'
	])
]);

printf('Hello and bye...');

$app->run();