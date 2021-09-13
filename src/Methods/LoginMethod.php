<?php
namespace App\Method;

abstract class LoginMethod extends Method {

	function __invoke($controller) {
		$controller->working(1);
		
		if (!$controller->hasProxy()) {
			$proxy = \App\Model\ProxyBuilder::findUnused();
			if (!is_null($proxy)) {

				$model = $controller->get();
				$model->proxy = $proxy;
				
				$controller->set($model);
				$controller->update(['proxyId' => $proxy->id]);
				
				unset($model);
				
				$proxyController = new \App\Controller\ProxyController($controller->get()->proxy);
				$this->container->get('App\Command\BrowserSettings')->initProxy(
					$proxyController->getIp(), 
					$proxyController->getPort(),
					$proxyController->getLogin(),
					$proxyController->getPassword(),
				);
			} 
		}

		if (!$controller->hasCookies()) {
			$cookie = \App\Model\CookieBuilder::buildWithUrl($this->url);
			
			$model = $controller->get();
			$model->cookie = $cookie;
			
			$controller->set($model);
			$controller->update(['cookieId' => $cookie->id]);
			
			unset($model);
		} 
		
		$cookieController = new \App\Controller\CookieController($controller->get()->cookie);		
		$this->container->get('App\Command\BrowserSettings')->initCookie(
			$cookieController->getUrl(),
			$cookieController->getValue()
		);
		
		if (!$controller->hasFingerprint()) {
			$fingerprint = \App\Model\FingerprintBuilder::build();
			
			$model = $controller->get();
			$model->fingerprint = $fingerprint;
			
			$controller->set($model);
			$controller->update(['fingerprintId' => $fingerprint->id]);
			
			unset($model);
		} 
		
		$fingerprintController = new \App\Controller\FingerprintController($controller->get()->fingerprint);		
		$this->container->get('App\Command\BrowserSettings')->initFingerprint([
			'useragent' => $fingerprintController->getUseragent(), 
			'language' => $fingerprintController->getLanguage(),
			'timezone' => $fingerprintController->getTimezone(),
			'canvas' => $fingerprintController->getCanvas(),
			'platform' => $fingerprintController->getPlatform(),
			'plugins' => $fingerprintController->getPlugins()
		]);
		
		if (!$authorized = $this->method($controller->getData())) {
			//$controller->deactivate();
			
			printf("Error during login!\n");
		} else {
			$controller->onLogin();
			//$cookieController->setUrl($this->container->get('webpage')->get_url());
			$value = $this->container->call('App\Command\GetCookie');
			
			$cookieController->setValue($value);
			
			printf("Logged in successfully!\n");
		}
		
		$controller->used();
		$controller->onUpdate();
		$controller->working(0);
		
		return $authorized;
	}
}