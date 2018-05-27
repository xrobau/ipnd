<?php

namespace AussieVoIP\IPND\Records;

class Entity {

	public $type;
	public $title = "";
	public $rawname = "";
	public $surname = "";
	public $firstname = "";
	public $longname = "";
	public $contactnum = "";

	public function __construct($type = "PERSON") {
		switch($type) {
		case "PERSON":
		case "BUSINESS":
		case "GOVT":
		case "CHARITY":
		case "NA":
			$this->type = $type;
			return;
		}
		throw new \Exception("Unknown name type '$type'");
	}

	public function isBusiness() {
		return ($this->type !== "PERSON" && $this->type !== "NA");
	}

	public function setContactNum($num) {
		// Used in 12.3
		$this->contactnum = substr($num, 0, 20);
	}

	public function setName($name, $title = "") {
		// Max length of rawname is 160 chars
		$this->rawname = substr($name, 0, 160);
		if ($this->isBusiness()) {
			return;
		}

		// It's a person. Split the name on spaces
		$namearr = explode(" ", $name);
		if (empty($namearr[0])) {
			throw new \Exception("Need a name");
		}
		// We want the LAST entry for surname. This is always here, and is hard-limited to 40 chars. Anything
		// longer than that is discarded.
		$this->surname = substr(array_pop($namearr), 0, 40);

		// Grab everything that's left
		if ($namearr) {
			$this->firstname = array_shift($namearr);
		} else {
			$this->firstname = "";
		}

		// If there's anything left, that's $longname
		if ($namearr) {
			$this->longname = implode(" ", $namearr);
		}

		// If we have a title, we want that, too
		if ($title) {
			$this->title = $title;
		}
		return $this;
	}
}

