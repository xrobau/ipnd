<?php

namespace AussieVoIP\IPND\Records;

class CustomerName extends Record {

	public $e;

	public $type = "MULTIPLE";

	public function validate() {
		return true;
	}

	public function setEntity(Entity $e) {
		$this->e = $e;
		return $this;
	}

	public function getMultipleRecords() {
		// If this is a business, we want it just as we received it.
		if ($this->e->isBusiness()) {
			return [
				// Note this is 5.1, 5.2, and 5.3
				[ "type" => "X", "size" => 160, "value" => $this->e->rawname ], 
				[ "type" => "X", "size" => 12, "value" => "" ],  // 5.4
			];
		}

		// It's a person. We return Surname first, then Given and then extended
		return [
			[ "type" => "X", "size" => 40, "value" => $this->e->surname ],
			[ "type" => "X", "size" => 120, "value" => $this->e->firstname." ".$this->e->longname ], // Note - 5.2 and 5.3
			[ "type" => "X", "size" => 12, "value" => $this->e->title ],
		];
	}
}
