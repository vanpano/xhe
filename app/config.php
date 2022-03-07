<?php

use \Psr\Container\ContainerInterface;
use \Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use \Symfony\Component\Filesystem\Filesystem;

return [
	App\Command\GoogleCreateProjectAndAPI::class => (function(ContainerInterface $c) {
		return new \App\Command\GoogleCreateProjectAndAPI($c);
	}),

	App\Command\MXToolboxCheckIp::class => (function(ContainerInterface $c) {
		return new \App\Command\MXToolboxCheckIp($c);
	}),

	App\Command\GetCalendarId::class => (function(ContainerInterface $c) {
		return new \App\Command\GetCalendarId($c);
	}),
	
	App\Command\IsWebpageAvailable::class => (function(ContainerInterface $c) {
		return new \App\Command\IsWebpageAvailable($c);
	}),

	App\Command\GoogleChangePassword::class => (function(ContainerInterface $c) {
		return new \App\Command\GoogleChangePassword($c);
	}),

	App\Command\RunAsPhp::class => (function(ContainerInterface $c) {
		return new \App\Command\RunAsPhp($c);
	}),

	'filesystem' => (function(ContainerInterface $c) {
		return new Filesystem();
	}),

	App\Command\GetAccessToken::class => (function(ContainerInterface $c) {
		return new \App\Command\GetAccessToken($c);
	}),

	App\Command\GetRefreshToken::class => (function(ContainerInterface $c) {
		return new \App\Command\GetRefreshToken($c);
	}),

	'App\Command\GooglePlaygroundStep1' => (function(ContainerInterface $c) {
		return new \App\Command\GooglePlaygroundStep1($c);
	}),

	'App\Command\GooglePlaygroundStep3' => (function(ContainerInterface $c) {
		return new \App\Command\GooglePlaygroundStep3($c);
	}),

	App\Command\SetWebGlFingerprint::class => (function(ContainerInterface $c) {
		return new \App\Command\SetWebGlFingerprint($c);
	}),

	App\Command\SetBoundsFingerprint::class => (function(ContainerInterface $c) {
		return new \App\Command\SetBoundsFingerprint($c);
	}),
	
	App\Command\SetAudioFingerprint::class => (function(ContainerInterface $c) {
		return new \App\Command\SetAudioFingerprint($c);
	}),
	
	App\Command\SetUseragent::class => (function(ContainerInterface $c) {
		return new \App\Command\SetUseragent($c);
	}),

	App\Command\SetLanguage::class => (function(ContainerInterface $c) {
		return new \App\Command\SetLanguage($c);
	}),

	App\Command\SetTimezone::class => (function(ContainerInterface $c) {
		return new \App\Command\SetTimezone($c);
	}),

	App\Command\SetPlugins::class => (function(ContainerInterface $c) {
		return new \App\Command\SetPlugins($c);
	}),

	App\Command\SetCanvas::class => (function(ContainerInterface $c) {
		return new \App\Command\SetCanvas($c);
	}),

	App\Command\SetPlatform::class => (function(ContainerInterface $c) {
		return new \App\Command\SetPlatform($c);
	}),

	App\Method\GooglePlaygroundLogin::class => (function(ContainerInterface $c) {
		return new \App\Method\GooglePlaygroundLogin($c);
	}),
	
	App\Method\GoogleLogin::class => (function(ContainerInterface $c) {
		return new \App\Method\GoogleLogin($c);
	}),
	
	'App\Command\BrowserSettings' => (function(ContainerInterface $c) {
		return new \App\Command\BrowserSettings($c);
	}),

	App\Command\SetCookieForUrl::class => (function(ContainerInterface $c) {
		return new \App\Command\SetCookieForUrl($c);
	}),
	
	App\Command\Vanish::class => (function(ContainerInterface $c) {
		return new \App\Command\Vanish($c);
	}),
	
	App\Command\SetCookie::class => (function(ContainerInterface $c) {
		return new \App\Command\SetCookie($c);
	}),
	
	App\Command\GetCookie::class => (function(ContainerInterface $c) {
		return new \App\Command\GetCookie($c);
	}),	
		
	App\Command\GetCookieForUrl::class => (function(ContainerInterface $c) {
		return new \App\Command\GetCookieForUrl($c);
	}),	
	
	App\Command\ExchangeTokens::class => (function(ContainerInterface $c) {
		return new \App\Command\ExchangeTokens($c);
	}),	
	
	App\Command\InsertGoogleCalendarEventBody::class => (function(ContainerInterface $c) {
		return new \App\Command\InsertGoogleCalendarEventBody($c);
	}),	
	
	App\Command\ClearCookies::class => (function(ContainerInterface $c) {
		return new \App\Command\ClearCookies($c);
	}),
	
	App\Command\DisableProxy::class => (function(ContainerInterface $c) {
		return new \App\Command\DisableProxy($c);
	}),
	
	App\Command\EnableProxy::class => (function(ContainerInterface $c) {
		return new \App\Command\EnableProxy($c);
	}),
	
	App\Command\LoadProfile::class => (function(ContainerInterface $c) {
		return new \App\Command\LoadProfile($c);
	}),
	
	'submitter' => (function(ContainerInterface $c) {
		return $c->make('Xhe\XheSubmitter', ['server' => $c->get('client')]);
	}),
	
	'debug' => (function(ContainerInterface $c) {
		return $c->make('Xhe\XheDebug', ['server' => $c->get('client')]);
	}),
	
	'browser' => (function(ContainerInterface $c) {
		return $c->make('Xhe\XheBrowser', ['server' => $c->get('client')]);
	}),
	
	'webpage' => (function(ContainerInterface $c) {
		return $c->make('Xhe\XheWebpage', ['server' => $c->get('client')]);
	}),
	
	'input' => (function(ContainerInterface $c) {
		return $c->make('Xhe\XheInput', ['server' => $c->get('client')]);
	}),	
	
	'div' => (function(ContainerInterface $c) {
		return $c->make('Xhe\XheDiv', ['server' => $c->get('client')]);
	}),	
	
	'span' => (function(ContainerInterface $c) {
		return $c->make('Xhe\XheSpan', ['server' => $c->get('client')]);
	}),	
	
	'anchor' => (function(ContainerInterface $c) {
		return $c->make('Xhe\XheAnchor', ['server' => $c->get('client')]);
	}),	
	
	'textarea' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheTextarea', ['server' => $c->get('client')]);
    },
	
	'button' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheButton', ['server' => $c->get('client')]);
    },
	
	'checkbox' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheCheckbutton', ['server' => $c->get('client')]);
    },
	
	'image' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheImage', ['server' => $c->get('client')]);
    },
	
	'btn' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheInputbutton', ['server' => $c->get('client')]);
    },
	
	'element' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheElement', ['server' => $c->get('client')]);
    },
	
	'keyboard' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheKeyboard', ['server' => $c->get('client')]);
    },
	
	'mouse' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheMouse', ['server' => $c->get('client')]);
    },
	
	'raw' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheRaw', ['server' => $c->get('client')]);
    },
	
	'window' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheWindow', ['server' => $c->get('client')]);
    },
	
	'inputfile' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheInputfile', ['server' => $c->get('client')]);
    },
	
	'listbox' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheSelectElement', ['server' => $c->get('client')]);
    },
	
	'form' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheForm', ['server' => $c->get('client')]);
    },
	
	'pre' => function (ContainerInterface $c) {
		return $c->make('Xhe\XhePre', ['server' => $c->get('client')]);
	},
	
	'application' => function (ContainerInterface $c) {
        return $c->make('Xhe\XheApplication', ['server' => $c->get('client')]);
    }
];