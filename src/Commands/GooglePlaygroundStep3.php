<?php

namespace App\Command;

class GooglePlaygroundStep3 extends Command {
	public $authCode;
	public $refreshToken;
	public $accessToken;
	
	public function credentials() {
		$container = $this->container;
		
		$this->setAuthCode($container->call(function() use (&$container) {
			preg_match("#code=(.*?)\&#", $container->get('webpage')->get_url(), $match);

			if (is_array($match) && isset($match[1]))
				return $match[1];
			return false;
		}));
		
		$this->container->call('App\Command\ExchangeTokens'); 
		
		$this->setRefreshToken($container->call('App\Command\GetRefreshToken'));
		$this->setAccessToken($container->call('App\Command\GetAccessToken'));
	}
	
	public function setAuthCode($authCode) {
		$this->authCode = $authCode;
	}
	
	public function getAuthCode() {
		return $this->authCode;
	}
	
	public function getRefreshToken() {
		return $this->refreshToken;
	}
	
	public function getAccessToken() {
		return $this->accessToken;
	}
	
	public function setRefreshToken($refreshToken) {
		$this->refreshToken = $refreshToken;
	}
	
	public function setAccessToken($accessToken) {
		$this->accessToken = $accessToken;
	}
	
	public function __invoke($requestUri, $requestMethod, $requestBody) {
		$url = 'https://developers.google.com/oauthplayground/#step3&auth_code=' . $this->getAuthCode() . '&refresh_token=' . $this->getRefreshToken() . '&access_token_field=' . $this->getAccessToken() . '&url=' . urlencode($requestUri) . '&content_type=application%2Fjson&http_method=' . $requestMethod . '&useDefaultOauthCred=unchecked&oauthEndpointSelect=Google&oauthAuthEndpointValue=https%3A%2F%2Faccounts.google.com%2Fo%2Foauth2%2Fv2%2Fauth&oauthTokenEndpointValue=https%3A%2F%2Foauth2.googleapis.com%2Ftoken&expires_in=3598&for_access_token=' . $this->getAccessToken() . '&includeCredentials=checked&accessTokenType=bearer&autoRefreshToken=checked&accessType=offline&prompt=consent&response_type=code&wrapLines=on';
		
		$this->container->get('browser')->navigate('google.com');		
		$this->container->get('browser')->navigate($url);
		$this->container->get('browser')->wait();
		
		$this->container->get('anchor')->get_by_id('requestBodyButton')->click();
		$this->container->get('browser')->wait();
		
		//$this->container->get('window')->execute_open_file("File Upload", trim($requestFile), "&Открыть", false, true);
		//$this->container->get('inputfile')->get_by_number(0)->send_mouse_click();
		
		$this->container->get('anchor')->get_by_id('requestBodyButton')->click();
		$this->container->get('browser')->wait();
		
		$this->container->get('textarea')->get_by_id('postData')->set_value($requestBody);
		$this->container->get('browser')->wait();
	
		$this->container->get('button')->get_by_id('sendRequestButton')->click();
		$this->container->get('browser')->wait();
	}
}