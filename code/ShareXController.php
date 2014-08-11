<?php

class ShareXController extends Controller {

	public static $url_handlers = array(
	    '$FileToken' => 'index'
	);

	function Link() {
		$random_actions = array(
			'~'
		);

		return $random_actions[array_rand($random_actions)]."/";
	}

	function index(){ 
		$params = $this->getURLParams();
		$token = $params['FileToken'];

		$file = ShareXFile::get()->filter('Token', $token)->First();

		$file_name = $file->getFullPath();

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime_type = finfo_file($finfo, $file_name);
		
		$this->response->addHeader('Content-Disposition', 'filename="' . basename($file_name) . '"');
		$this->response->addHeader('Content-Type', $mime_type);
		$this->response->addHeader('X-Sendfile', $file_name);
	}
}