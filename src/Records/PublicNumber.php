<?php

namespace AussieVoIP\IPND\Records;

class PublicNumber extends Record {

	public $type = "X";
	public $size = 20;

	// This has to start with a single zero, and be 10 digits long, exactly.
	public function validate($v) {
		$l = strlen($v);
		if ($l !== 10) {
			throw new \Exception("PublicNumber is not 10 digits, it's $l - Do you have a 13 number?");
		}
		if ($v[0] !== "0") {
			throw new \Exception("PublicNumber $v doesn't start with 0");
		}

		if (!is_numeric($v)) {
			throw new \Exception("PublicNumber is not numeric");
		}
		return true;
	}
}

