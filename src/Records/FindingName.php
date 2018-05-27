<?php

namespace AussieVoIP\IPND\Records;

class FindingName {

	public $d;
	public $type = "MULTIPLE";

	public function setCustomerName($title, $fullname) {
		// Split the name on spaces
		$namearr = explode(" ", $fullname);
		if (empty($namearr[0])) {
			throw new \Exception("Nothing in '$fullname'");
		}
		// We want the LAST entry for surname
		$surname = array_pop($namearr);
		$this->d['CustomerName1'] = $surname;
		// And the First name (up to 40 chars) for CN2
		$firstname = array_shift($namearr);
		$this->d['CustomerName2'] = substr($firstname, 0, 40);

		// If firstname is longer than 40, it goes into Long Name (Up to 80 chars)
		if (strlen($firstname) > 40) {
			$this->d['LongName'] = substr($firstname, 41, 80);
		} else {
			$this->d['LongName'] = "";
		}
		$this->d['CustomerTitle'] = substr($title, 0, 12);
		return $this;
	}

	public function getMultipleRecords() {
		if (empty($this->d)) {
			throw new \Exception("No name given");
		}
		return [ 
			[ "type" => "X", "size" => 40, "value" => $this->d['CustomerName1'] ],
			[ "type" => "X", "size" => 40, "value" => $this->d['CustomerName2'] ],
			[ "type" => "X", "size" => 80, "value" => $this->d['LongName'] ],
			[ "type" => "X", "size" => 12, "value" => $this->d['CustomerTitle'] ]
		];
	}
}

