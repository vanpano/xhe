<?php

namespace App\Method;


class GooglePlaygroundLogin extends GoogleLogin {
	public $url = 'https://accounts.google.com/o/oauth2/v2/auth/oauthchooseaccount?redirect_uri=https%3A%2F%2Fdevelopers.google.com%2Foauthplayground&prompt=consent&response_type=code&client_id=407408718192.apps.googleusercontent.com&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fcalendar%20https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fcalendar.events&access_type=offline&flowName=GeneralOAuthFlow';
	
	public function method($data) {
		extract($data);
		
		if (!isset($url))
			$url = $this->url;
		
		$this->navigate($url);
		
		if ($this->isChooseAccountRequired($email)) {
			$this->chooseAccount($email);
			
			if ($this->isAllowConsentRequired()) {
				$this->allowConsent();
				$this->submitAllowConsentForm();
			}
			
			if ($this->isLoggedIn()) {
				printf("Logged in successfully as %s!\n", $email);
				return true;
			}
		}

		if ($this->isEmailFormVisibled()) {
			$this->inputEmail($email);
			$this->submitEmailForm();
		}
		sleep(3);
		if ($this->isPasswordFormVisibled()) {
			$this->inputPassword($password);
			$this->submitPasswordForm();
		}
		
		if ($this->isReserveEmailRequired()) {
			$this->chooseREmailChallenge();
			$this->inputReserveEmail($reserveEmail);
			$this->submitReserveEmailForm();
		}
		
		if ($this->isPhoneRequired()) {
			$this->inputPhone($phone);
			$this->submitPhoneForm();
		}
		
		if ($this->isSmsVerificationRequired()) {
			printf("Sms verification required!\n");
			return false;
		}
		
		$this->phoneVerificationCheck();
		$this->phoneVerificationCheck();
		
		
		if ($this->isDeviceVerificationRequired()) {
			printf("Device verification required!\n");
			return false;
		}
		
		if ($this->isBanned()) {
			printf("Account banned!\n");
			
			return false;
		}
		
		if ($this->isAllowConsentRequired()) {
			$this->allowConsent();
			$this->submitAllowConsentForm();
		}
		
		if ($this->isLoggedIn()) {
			printf("Logged in successfully as %s!\n", $email);
			return true;
		} else {
			printf("Error during login as %s!\n", $email);
			return false;
		}
	}
	
	public function isDeviceVerificationRequired() {
		
	}
	
	public function isBanned() {
		
	}
	
	public function isAllowConsentRequired() {
		$this->container->get('browser')->wait();
		sleep(2);
		if (preg_match("#consentsummary#", $this->container->get('webpage')->get_url()))  {
			
			return true;
		}
	}
	
	public function submitAllowConsentForm() {
		$this->container->get('div')->get_by_id('submit_approve_access', false)->click();
		$this->container->get('browser')->wait();
		$this->container->get('browser')->wait_js();
		sleep(2);
	}
	
	public function allowConsent() {
	$this->container->get('browser')->wait();
		$vars = $this->container->get('checkbox')->get_all()->elements;
		
		foreach($vars as $var) {
			if (!$var->is_checked()) {
				$this->container->get('browser')->wait();
				$var->click();
				$this->container->get('browser')->wait();
			}
		}
	}
	
	public function isLoggedIn() {
		$this->denied();
		$this->skipRecovery();
		$this->skipFeatures();
		
		$this->container->get('browser')->wait();
		$url = $this->container->get('webpage')->get_url();
		$this->container->get('browser')->wait();
		
		if(preg_match("#code=#", $url)) {
			return true;
		} else {
			if (!$this->container->get('browser')->check_connection($url,30)) {
				$this->container->get('browser')->wait();
				
				printf("Connection issue!\n");
			}
		}
	}
}