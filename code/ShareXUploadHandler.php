<?php

class ShareXUploadHandler extends Controller {
	function index() {

		if($this->authenticate()) {

			if(isset($_FILES['file'])) {
				$upload = new Upload();
				$file = new ShareXFile();

				$upload->loadIntoFile($_FILES['file'], $file, 'sharex');

				return Director::absoluteBaseURL().$file->Link();
			}
		} else {
			return $this->httpError(403, 'Oi.');
		}
	}

	function authenticate() {
		$secret = Config::inst()->get($this->class, 'secret');

		if(
			$secret == null || (
				isset($_REQUEST['secret']) &&
				$_REQUEST['secret'] == $secret
			)
		) {
			return true;
		} else {
			return false;
		}
	}
}