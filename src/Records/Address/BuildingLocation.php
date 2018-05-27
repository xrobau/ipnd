<?php

namespace AussieVoIP\IPND\Records\Address;

class BuildingLocation {

	public $BuildingLocation;

	public function __construct($l = "") {
		$this->BuildingLocation = $l;
	}

	public function get() {
		return [ "type" => "X", "size" => 30, "value" => $this->BuildingLocation ];
	}
}

