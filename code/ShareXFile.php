<?php

class ShareXFile extends File {
	static $db = array(
		'Token' => 'Varchar(8)'
	);

	function onBeforeWrite() {
		parent::onBeforeWrite();

		if(!$this->Token) {
			$this->Token = substr(rtrim(base64_encode(md5(microtime())),"="),0,5);
		}
	}

	function Link() {
		$controller = new ShareXController();

		return $controller->Link().$this->Token;
	}
}