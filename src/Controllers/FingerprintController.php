<?php
namespace App\Controller;

class FingerprintController extends Controller {	
	public function getUseragent() {
		return $this->get()->useragent;
	}
	
	public function getLanguage() {
		return $this->get()->language;
	}
	
	public function getTimezone() {
		return $this->get()->timezone;
	}
	
	public function getCanvas() {
		return $this->get()->canvas;
	}
	
	public function getPlatform() {
		return $this->get()->platform;
	}
	
	public function getPlugins() {
		return $this->get()->plugins;
	}
	
}
	