<?php

namespace AussieVoIP\IPND\Records\Address;

class BuildingProperty {

	public $BuildingProperty;

	public function __construct($p = "") {
		$this->BuildingProperty = $p;
	}

	public function get() {
		return [ "type" => "X", "size" => 40, "value" => $this->BuildingProperty ];
	}
}

