<?php

namespace AussieVoIP\IPND\Records;

class ServiceStatusCode extends Record {

	public $type = "X";
	public $size = 1;

	// This has to be either "C" or "D", exactly
	public function validate($v) {
		if ($v === "C" || $v === "D") {
			return true;
		}
		throw new \Exception("ServiceStatusCode must be 'C' or 'D', but is '$v'");
	}
}

