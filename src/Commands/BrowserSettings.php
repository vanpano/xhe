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
	
	public function initAvatar($userAgent) {
		$path = dirname(ROOT_DIR) . DIRECTORY_SEPARATOR . 'var/profile.json';
		
		file_put_contents($path, json_encode([
			'userAgent' => $userAgent
		]));
		
		$this->container->call(\App\Command\LoadProfile::class, ['path' => $path]);
	}
	
	public function exportCookie() {
		return $this->container->call(\App\Command\GetCookie::class);
	}
}