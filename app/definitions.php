<?php

define('ROOT_DIR', dirname(__DIR__));

define('XHE_DIR', 'C:\XWeb\Human Emulator Studio 7.0.62');
define('XHE_EXE', XHE_DIR . DIRECTORY_SEPARATOR . 'XWeb Human Emulator Studio RT.exe');

define('VAR_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'var');
define('PROFILE_DIR', VAR_DIR . DIRECTORY_SEPARATOR . 'profiles');

define('EVENTS_DIR', VAR_DIR . DIRECTORY_SEPARATOR . 'events');
define('EVENTS_UNPUBLISHED_DIR', EVENTS_DIR . DIRECTORY_SEPARATOR . 'unpublished');
define('EVENTS_WORKING_DIR', EVENTS_DIR . DIRECTORY_SEPARATOR . 'working');
define('EVENTS_PUBLISHED_DIR', EVENTS_DIR . DIRECTORY_SEPARATOR . 'published');
define('EVENTS_ERRORS_DIR', EVENTS_DIR . DIRECTORY_SEPARATOR . 'errors');