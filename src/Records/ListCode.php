<?php

namespace AussieVoIP\IPND\Records;

class ListCode extends Record {

	public $defaultval = "UL";
	public $type = "X";
	public $size = 2;

	// This has to be LE, UL or SA
	public function validate($v) {
		if ($v === "LE" || $v === "UL" || $v === "SA") {
			return true;
		}
		throw new \Exception("ListCode must be LE, UL or SA");
	}
}

