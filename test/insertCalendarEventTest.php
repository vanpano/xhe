<?php

$container = require(__DIR__ . '/../app/bootstrap.php');

$app = new Silly\Application();
$app->useContainer($container, $injectWithTypeHint = true);

$invoker = new Invoker\Invoker(null, $container);

$app->command('events:insert [ip] [port]', function($ip, $port) use (&$container, &$invoker) {
	$container->set('client', \DI\create('Xhe\Client')->constructor($ip, $port));
	$controller = (new App\Controller\GoogleAccountController());
	
	do {
		if (!$account = App\Model\GoogleAccountBuilder::findUnused()) {
			die('No accounts...');
		} else {$controller->set($account);}


		if (!$event = App\Classes\RandomFile::get(EVENTS_UNPUBLISHED_DIR)) {
			die('No events found...');
		} else {
			rename($event, EVENTS_WORKING_DIR . DIRECTORY_SEPARATOR . basename($event));
			$event = str_replace('unpublished', 'working', $event);
		}

		if (!$step1 = $invoker->call('App\Method\GooglePlaygroundLogin', [$controller]))
			die('Login error :(');
		else {
			
			$container->get('App\Command\GooglePlaygroundStep3')->credentials();
		}

		switch ($invoker->call('App\Command\GooglePlaygroundStep3', [
			'uri' => 'https://www.googleapis.com/calendar/v3/users/me/calendarList/' . $controller->getEmail(),
			'method' => 'PUT',
			'body' => '{"accessRole": "freeBusyReader","defaultReminders": [{"method": "email","minutes": 60},{"method": "popup","minutes": 15},{"method": "popup","minutes": 60},{"method": "popup","minutes": 180},{"method": "popup","minutes": 1440}],"notificationSettings": {"notifications": [{"method": "email","type": "agenda"},{"method": "email","type": "eventResponse"},	{"method": "email","type": "eventCreation"}]},"primary": true}'
		])):
			case 200: 
				printf("Calendar list rule was inserted successfully!\n"); 
				break;
			case 400: 
				printf("Bad calendar list rule request!\n"); 
				break;
			case 401: 
				printf("Invalid client!\n"); 
				break;
			default: printf("Code undefined...\n"); break;
		endswitch;

		switch ($invoker->call('App\Command\GooglePlaygroundStep3', [
			'uri' => 'https://www.googleapis.com/calendar/v3/calendars/primary/acl',
			'method' => 'POST',
			'body' => '{"role": "freeBusyReader","scope": {"type": "default"}}'
		])):
			case 200: 
				printf("ACL rule was inserted successfully!\n"); 
				break;
			case 400: 
				printf("Bad ACL rule request!\n"); 
				break;
			case 401: 
				printf("Invalid client!\n"); 
				break;
			default: printf("Code undefined...\n"); break;
		endswitch;

		switch ($invoker->call('App\Command\GooglePlaygroundStep3', [
			'uri' => 'https://www.googleapis.com/calendar/v3/calendars/primary/events?maxAttendees=1000&sendUpdates=all',
			'method' => 'POST',
			'file' => ($event)
		])):
			case 200: 
				printf("Event was inserted successfully! Salut!\n");
				rename($event, EVENTS_PUBLISHED_DIR . DIRECTORY_SEPARATOR . basename($event));
				break;
			case 400: 
				printf("Bad event request!\n"); 
				rename($event, EVENTS_ERRORS_DIR . DIRECTORY_SEPARATOR . basename($event));
				break;
			case 403: 
				printf("Maximum calendar limits exceeded!\n"); 
				rename($event, EVENTS_UNPUBLISHED_DIR . DIRECTORY_SEPARATOR . basename($event));
				break;
			case 401: 
				printf("Invalid client!\n"); 
				rename($event, EVENTS_UNPUBLISHED_DIR . DIRECTORY_SEPARATOR . basename($event));
				break;
			default: printf("Code undefined...\n"); break;
		endswitch;
	} while(!FALSE);
});

$app->run();