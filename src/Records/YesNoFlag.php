<?php

namespace AussieVoIP\IPND\Records;

class YesNoFlag extends Record {

	public $type = "X";
	public $size = 1;

	// This has to be either "Y" or "N", exactly
	public function validate($v) {
		if ($v === "Y" || $v === "N") {
			return true;
		}
		throw new \Exception("Yes or No Flag must be 'Y' or 'N', but is '$v'");
	}
}

