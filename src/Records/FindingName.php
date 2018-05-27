<?php

namespace AussieVoIP\IPND\Records;

class FindingName {

	public $type = "MULTIPLE";
	public $e;

	public function setEntity(Entity $e) {
		$this->e = $e;
		return $this;
	}

	public function getMultipleRecords() {
		if ($this->e->isBusiness()) {
			return [
				// Note this is 6.1 and 6.2
				[ "type" => "X", "size" => 80, "value" => $this->e->rawname ], 
				[ "type" => "X", "size" => 12, "value" => "" ],  // 6.3
			];
		}

		// It's a person. We return Surname first, then Given and then title
		return [
			[ "type" => "X", "size" => 40, "value" => $this->e->surname ],
			[ "type" => "X", "size" => 40, "value" => $this->e->firstname ],
			[ "type" => "X", "size" => 12, "value" => $this->e->title ],
		];
	}
}

