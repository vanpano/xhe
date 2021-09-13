<?php
namespace App\Command;

class BrowserSettings extends Command {
	public function initCookie($url, $value) {
		$this->container->call(\App\Command\ClearCookies::class);
		$this->container->call(\App\Command\SetCookieForUrl::class, ['url' => $url, 'entry' => $value]);
	}
	
	public function initProxy($ip, $port, $login, $password) {
		$this->container->call(\App\Command\DisableProxy::class);
		$this->container->call(\App\Command\EnableProxy::class, ['ip' => $ip, 'port' => $port, 'login' => $login, 'pass' => $password]);
	}
	
	public function initFingerprint($data) {
		extract($data);
		
		if (isset($useragent) && !is_null($useragent)) {
			var_dump($useragent);
			$this->container->call(\App\Command\SetUseragent::class, ['useragent' => $useragent]);
		}
		
		if (isset($language) && !is_null($language)) {
			var_dump($language);
			$this->container->call(\App\Command\SetLanguage::class, ['language' => $language]);
		}
		
		if (isset($timezone)  && !is_null($timezone)) {
			var_dump($timezone);
			$this->container->call(\App\Command\SetTimezone::class, ['timezone' => $timezone]);
		}
		
		if (isset($canvas)  && !is_null($canvas)) {
			var_dump($canvas);
			$this->container->call(\App\Command\SetCanvas::class, ['canvas' => $canvas]);
		}
		
		if (isset($platform)  && !is_null($platform)) {
			var_dump($platform);
			$this->container->call(\App\Command\SetPlatform::class, ['platform' => $platform]);
		}
		
		if (isset($plugins)  && !is_null($plugins)) {
			var_dump($plugins);
			$this->container->call(\App\Command\SetPlugins::class, ['plugins' => $plugins]);
		}
		
		//$this->container->call(\App\Command\LoadProfile::class, ['path' => $path]);
	}
}