<?php

namespace App\Method;

class GoogleLogin extends LoginMethod {
	public $url = 'https://accounts.google.com/o/oauth2/v2/auth/oauthchooseaccount?redirect_uri=https%3A%2F%2Fdevelopers.google.com%2Foauthplayground&prompt=consent&response_type=code&client_id=407408718192.apps.googleusercontent.com&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fcalendar%20https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fcalendar.events&access_type=offline&flowName=GeneralOAuthFlow';
	
	public function denied() {
		$url = $this->container->get('webpage')->get_url();

		if (preg_match("#deniedsigninrejected#", $url)) 
			printf("Account sign-in was denied!\n");		
	}
	
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
				return true;
			}
		}

		if ($this->isEmailFormVisibled()) {
			$this->inputEmail($email);
			$this->submitEmailForm();
		}
		
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
		
		if ($this->isPhoneVerificationRequired()) {
			//$phone = App\Service\OnlineSim::buyPhone('google');
			$phone = '';
			$this->inputPhoneRequired($phone);
			$this->submitPhoneRequiredForm();
			
			$sms = App\Service\OnlineSim::getSms($phone);
			$this->inputSms($sms);
			$this->submitSmsForm();
		}
		
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
		
		return $this->isLoggedIn();
	}
	
	public function chooseREmailChallenge() {
		$this->container->get('div')->get_by_attribute('data-challengetype', '12', false)->click();
		$this->container->get('browser')->wait();
	}
	
	public function navigate($url) {
		$this->container->get('browser')->navigate($url);
		$this->container->get('browser')->wait();
	}
	
	public function spin() {
		$this->container->get('div')->get_by_attribute('role', 'progressbar');
		$this->container->get('browser')->wait();
	}
	
	public function isChooseAccountRequired($email) {
		$this->container->get('browser')->wait();
		$result = $this->container->get('div')->get_by_attribute('data-email', $email)->is_visibled() || 
		$this->container->get('button')->get_by_value($email, false)->is_visibled();
		
		return $result;
	}
	
	public function chooseAccount($email) {
		$this->container->get('browser')->wait();
		$this->container->get('div')->get_by_attribute('data-email', $email)->click() || 
		$this->container->get('button')->get_by_value($email, false)->click();
		$this->container->get('browser')->wait();
	}
	
	public function skipRecovery() {
		if (preg_match("#signinoptions\/recovery-options-collection#", $this->container->get('webpage')->get_url())) {
			($btn = array_pop($this->container->get('div')->get_all_by_attribute('role', 'button')))->click();
			$this->container->get('browser')->wait();
		}
	}
	
	public function skipFeatures() {
		if (preg_match("#signin\/newfeatures#", $this->container->get('webpage')->get_url())) {
			$this->container->get('div')->get_by_attribute('role', 'button')->click();
			$this->container->get('browser')->wait();
			
			$this->container->get('div')->get_by_attribute('role', 'button')->click();
			$this->container->get('browser')->wait();
					
			$this->container->get('button')->get_by_number(0)->click();
			$this->container->get('browser')->wait();
		}
	}
	
	public function setBirthday() {
		if (preg_match("#interstitials\/birthday#", $this->container->get('webpage')->get_url())) {
			$this->container->get('input')->get_by_attribute('id', 'i4', false)->send_input(mt_rand(1,28));
			$this->container->get('browser')->wait();
			$this->container->get('input')->get_by_attribute('id', 'i9', false)->send_input("1985");
			$this->container->get('browser')->wait();
			$this->container->get('element')->get_by_attribute('data-value', mt_rand(1,12), false)->click();
			$this->container->get('browser')->wait();
		}
	}
	
	public function isLoggedIn() {
		$this->denied();
		$this->skipRecovery();
		$this->skipFeatures();
		
		if(preg_match("#code=#", $this->container->get('webpage')->get_url()))
			return true;
	}
	
	public function isEmailFormVisibled() {
		$result = $this->container->get('input')->get_by_attribute('type', 'email', false)->is_visibled();
		$this->container->get('browser')->wait();

		return $result;
	}
	
	public function inputEmail($email) {
		$this->container->get('input')->get_by_attribute('type', 'email', false)->send_input($email);
		$this->container->get('browser')->wait();
	}
	
	public function isPasswordFormVisibled() {
		$result = $this->container->get('input')->get_by_attribute('type', 'password', false)->is_visibled();
		$this->container->get('browser')->wait();
		
		return $result;
	}
	
	public function inputPassword($password) {
		$this->container->get('input')->get_by_attribute('type', 'password', false)->send_input($password);
		$this->container->get('browser')->wait();
	}
	
	public function submitEmailForm() {
		$this->container->get('div')->get_by_id('identifierNext', false)->click();
		$this->container->get('browser')->wait();
	}
	
	public function submitPasswordForm() {
		$this->container->get('div')->get_by_id('passwordNext', false)->click();
		$this->container->get('browser')->wait();
	}
	
	public function isReserveEmailRequired() {
		if(preg_match("#challenge\/selection#", $this->container->get('webpage')->get_url()))
			return true;
	}
	
	public function inputReserveEmail($reserveEmail) {
		$this->container->get('input')->get_by_id('knowledge-preregistered-email-response', false)->send_input($reserveEmail);
		$this->container->get('browser')->wait();
	}
	
	public function submitReserveEmailForm() {
		$this->container->get('button')->get_by_number(0)->click();
		$this->container->get('browser')->wait();
	}
	
	public function isPhoneRequired() {
		$this->container->get('browser')->wait();
	}
	
	public function inputPhone($phone) {}
	
	public function submitPhoneForm() {
		
	}
	
	public function isPhoneVerificationRequired() {
		
	}
	
	public function inputPhoneRequired($phone) {}
	
	public function submitPhoneRequiredForm() {
		
	}
	
	public function inputSms($sms) {}
	
	public function submitSmsForm() {
		
	}
	
	public function isDeviceVerificationRequired() {
		
	}
	
	public function isBanned() {
		
	}
	
	public function isAllowConsentRequired() {
		if (preg_match("#consentsummary#", $this->container->get('webpage')->get_url())) 
			return true;
	}
	
	public function submitAllowConsentForm() {
		$this->container->get('div')->get_by_id('submit_approve_access', false)->click();
		$this->container->get('browser')->wait();
	}
	
	public function allowConsent() {		
		$vars = $this->container->get('checkbox')->get_all()->elements;
		
		foreach($vars as $var) {
			if (!$var->is_checked()) {
				$this->container->get('browser')->wait();
				$var->click();
				$this->container->get('browser')->wait();
			}
		}
	}
}