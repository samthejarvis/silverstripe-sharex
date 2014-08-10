<?php

class ShareXUploadHandler extends Controller {
	function index() {

		if($this->authenticate()) {

			if(isset($_FILES['file'])) {
				$upload = new Upload();
				$upload->load($_FILES['file'], 'sharex');

				$file = $upload->getFile();

				return $file->getAbsoluteURL();
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