<?php
namespace App\Controller;

class AvatarController extends Controller {

	public function hasAvatar() {
		return !is_null($this->get());
	}
	
	public function getUserAgent() {
		return $this->get()->useragent;
	}
	
	public function getAvatarLanguage() {
		return $this->get()->language;
	}
	
	public function getAvatarFingerprints() {
		return $this->get()->fingerprints;
	}
	
	public function findUnused() {
		return \App\Model\Avatar::groupBy('used')::getOne();
	}
	
}
	