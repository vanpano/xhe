<?php

$container = require(__DIR__ . '/../app/bootstrap.php');

$app = new Silly\Application();
$app->useContainer($container, $injectWithTypeHint = true);

$builder = new App\Builder\CalendarEventBuilder;
$data = App\Generator\CalendarEventDataGenerator::generate([
	'startAt' => '2021-09-25T19:09:29'
	'timeZone' => 'Europe/Kiev',
	'project' => App\Model\Project::where('label', 'vip')::getOne()
]);
$event = $builder->buildWithData($data);

printf("Event generator test.\n");

$app->run();