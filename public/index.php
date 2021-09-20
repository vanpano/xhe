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

$container->get('App\Command\GooglePlaygroundStep3')->setAuthCode($invoker->call(function() use (&$container){
	preg_match("#code=(.*?)\&#", $container->get('webpage')->get_url(), $match);

	if (is_array($match) && isset($match[1]))
		return $match[1];
	return false;
}));

$invoker->call('App\Command\ExchangeTokens');
$container->get('App\Command\GooglePlaygroundStep3')->setRefreshToken($invoker->call('App\Command\GetRefreshToken'));
$container->get('App\Command\GooglePlaygroundStep3')->setAccessToken($invoker->call('App\Command\GetAccessToken'));
$invoker->call('App\Command\GooglePlaygroundStep3', [
	'requestUri' => 'https://www.googleapis.com/calendar/v3/calendars/primary/events?maxAttendees=1000&sendUpdates=all',
	'requestMethod' => 'POST',
	'requestBody' => json_encode([
		'summary' => 'Hello World!',
		'description' => 'Hello!!!!'
	])
]);

/*
printf("Auth code\n%s\n\n", $container->get('App\Command\GooglePlaygroundStep3')->getAuthCode());
printf("Access token\n%s\n\n", $container->get('App\Command\GooglePlaygroundStep3')->getAccessToken());
printf("Refresh token\n%s\n\n", $container->get('App\Command\GooglePlaygroundStep3')->getRefreshToken());

$invoker->call('GooglePlaygroundStep3', [
	'requestUri' => 'https://www.googleapis.com/calendar/v3/calendars/primary/events?maxAttendees=1000&sendUpdates=all',
	'requestUriParams' => '',
	'requestMethod' => 'POST',
])

$step3 = $invoker->call('App\Command\InsertGoogleCalendarEventBody', [
	'body' => ''
]);

*/

printf('Hello and bye...');
$app->run();