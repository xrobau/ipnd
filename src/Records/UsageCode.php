<?php

namespace AussieVoIP\IPND\Records;

class UsageCode extends Record {

	public $e;

	public $type = "X";
	public $size = 1;

	public function validate() {
		return true;
	}

	public function setEntity(Entity $e) {
		$this->e = $e;
		return $this;
	}

	// This has to be R, B, G, C or N.
	public function getCode() {
		switch ($this->e->type) {
		case "PERSON":
			return "R";
		case "BUSINESS":
			return "B";
		case "GOVT":
			return "G";
		case "CHARITY":
			return "C";
		case "NA":
			return "N";
		}
		throw new \Exception("Unknown Usage type '".$this->e->type."'");
	}

	public function getRecord() {
		return [ "type" => $this->type, "size" => $this->size, "value" => $this->getCode() ];
	}
}

