<?php
namespace App\Command;

class BrowserSettings extends Command {
	public function initCookie($url, $value) {
		//$this->container->call(\App\Command\ClearCookies::class);
		$this->container->call(\App\Command\Vanish::class);
		$this->container->call(\App\Command\SetCookieForUrl::class, ['url' => $url, 'entry' => $value]);
	}
	
	public function initProxy($ip, $port, $login, $password) {
		$this->container->call(\App\Command\DisableProxy::class);
		$this->container->call(\App\Command\EnableProxy::class, ['ip' => $ip, 'port' => $port, 'login' => $login, 'pass' => $password]);
	}
	
	public function initProfile($data) {
		extract($data);
		
		$output = [];
		
		if (isset($useragent) && !is_null($useragent)) {
			$output = array_merge($output, [
				"UserAgent" => $useragent
			]);
			//$this->container->call(\App\Command\SetUseragent::class, ['useragent' => $useragent]);
		}
		
		if (isset($language) && !is_null($language)) {
			$output = array_merge($output, [
				"BrowserLanguage" => $language
			]);
			//$this->container->call(\App\Command\SetLanguage::class, ['language' => $language]);
		}
		
		if (isset($timezone)  && !is_null($timezone)) {
			$output = array_merge($output, [
				"TimeZone" => $timezone
			]);
			//$this->container->call(\App\Command\SetTimezone::class, ['timezone' => $timezone]);
		}
		
		if (isset($canvas)  && !is_null($canvas)) {
			$output = array_merge($output, [
				"CanvasNoise" => $canvas
			]);
			//$this->container->call(\App\Command\SetCanvas::class, ['canvas' => $canvas]);
		}
		
		if (isset($resolution)  && !is_null($resolution)) {
			$output = array_merge($output, [
				"BrowserWidth" => (isset($resolution->browserWidth) ? $resolution->browserWidth : 1400),
				"BrowserHeight" => (isset($resolution->browserHeight) ? $resolution->browserHeight : 900),
				"ScreenWidth" => (isset($resolution->screenWidth) ? $resolution->screenWidth : 1400),
				"ScreenHeight" => (isset($resolution->screenHeight) ? $resolution->screenHeight : 900),
				"ScreenPixelDepth" => (isset($resolution->screenPixelDepth) ? $resolution->screenPixelDepth : 24),
			]);
			/*
			$this->container->call(\App\Command\SetPlatform::class, [
				'platform' => $platform['platform'], 
				'cpuClcass' => $platform['cpuClass']
			]);
			*/
		}
		
		if (isset($hardware)  && !is_null($hardware)) {
			$output = array_merge($output, [
				"HardwareConcurrency" => (isset($hardware->concurrency) ? $hardware->concurrency : 4),
				"DeviceMemory" => (isset($hardware->deviceMemory) ? $hardware->deviceMemory : 24),
				"DevicePixelRatio" => (isset($hardware->devicePixelRatio) ? $hardware->devicePixelRatio : "-1"),
			]);
			//$this->container->call(\App\Command\SetPlugins::class, ['plugins' => $plugins]);
		}
		
		if (isset($audio)  && !is_null($audio)) {
			$output = array_merge($output, [
				"AudioNoise" => $audio->noise,
				"FrequencyNoise" => $audio->frequency,
			]);
			/*
			$this->container->call(\App\Command\SetAudioFingerprint::class, [
				'noise' => $audio['noise'],
				'frequency' => $audio['frequency']
			]);
			*/
		}
		
		if (isset($bound) && !is_null($bound)) {
			$output = array_merge($output, [
				"BoundNoise" => $bound
			]);
			/*
			$this->container->call(\App\Command\SetBoundsFingerprint::class, [
				'noise' => $bounds,
			]);
			*/
		}
		
		file_put_contents(($path = PROFILE_DIR . DIRECTORY_SEPARATOR . 'profile.json'), json_encode($output));
		$this->container->call(\App\Command\LoadProfile::class, ['path' => $path]);
	}
}