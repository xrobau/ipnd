<?php

namespace AussieVoIP\IPND\Records;

class TypeOfService extends Record {

	public $defaultval = "";
	public $type = "X";
	public $size = 5;

	// This has to be one of "FAX", "FCALL", "FIXED", "MOBIL", "MODEM", "ONE3",
	// "PAGER", "PAYPH", "PRVPY", "PREM" or "SATEL", or, it can be empty.
	public function validate($v) {
		switch ($v) {
		case "":
		case "FAX":
		case "FCALL":
		case "FIXED":
		case "MOBIL":
		case "MODEM":
		case "ONE3":
		case "PAGER":
		case "PAYPH": 
		case "PRVPY":
		case "PREM":
		case "SATEL":
			return true;
		}
		throw new \Exception("Usagecode $v invalid");
	}
}

