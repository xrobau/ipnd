<?php

namespace AussieVoIP\IPND\Records;

class CustomerContact extends Record {

	public $e;

	public $type = "MULTIPLE";

	public function validate() {
		return true;
	}

	public function setEntity(Entity $e) {
		$this->e = $e;
		return $this;
	}

	// This must always be a person, as it's an alternate contact number
	// if emergency services can't get the address.
	public function getMultipleRecords() {
		if (!$this->e) {
			throw new \Exception("No Customer Contact provided");
		}
		return [
			[ "type" => "X", "size" => 40, "value" => $this->e->surname ],
			[ "type" => "X", "size" => 40, "value" => $this->e->firstname ],
			[ "type" => "X", "size" => 20, "value" => $this->e->contactnum ],
		];
	}
}
