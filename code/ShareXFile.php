<?php

class ShareXFile extends File {

	static $db = array(
		'Token' => 'Varchar(255)'
	);

	function onBeforeWrite() {
		parent::onBeforeWrite();

		if(!$this->Token) {
			$token = $this->generateUniqueToken();
			$this->Token = $token;
		}
	}

	function generateToken() {
		$adjectives = Config::inst()->get("ShareXFile", "url_adjectives");
		$nouns = Config::inst()->get("ShareXFile", "url_nouns");

		do {
			$adjective_1 = $adjectives[array_rand($adjectives)];
			$adjective_2 = $adjectives[array_rand($adjectives)];
		} while ($adjective_1 == $adjective_2);

		$noun = $nouns[array_rand($nouns)];

		return $adjective_1 . $adjective_2 . $noun;
	}

	function generateUniqueToken() {

		$file_count = ShareXFile::get()->Count();
		$try_count = 0;

		$unique = false;

		while($unique == false && $try_count < $file_count) {
			//try until we get a unique token or until all possibilities have been exhausted

			$token = $this->generateToken();
			$try_count++;

			if(ShareXFile::get()->filter('Token', $token)->Count() == 0) {
				$unique = true;
			}
		}

		if($try_count >= $file_count) {
			die("No unique URLs left.");
		}

		return $token;
	}

	function Link() {
		$controller = new ShareXController();

		return $controller->Link().$this->Token;
	}
}