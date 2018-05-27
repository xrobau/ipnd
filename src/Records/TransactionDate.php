<?php

namespace AussieVoIP\IPND\Records;

class TransactionDate extends Record {

	public $type = "N";
	public $size = 14;

	public function validate($v) {
		// Needs to be in the format YYYYMMDDHHMMSS. So, we just check to make
		// sure it starts with 2, and is 14 chars long.
		if (strlen($v) !== 14) {
			throw new \Exception("Transaction Date is not 14 chars long");
		}
		if ($v[0] !== "2") {
			throw new \Exception("First char of Transaction date is not 2. Is it the year 3000?");
		}
		return true;
	}
}

