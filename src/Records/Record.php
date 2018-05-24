<?php

namespace AussieVoIP\IPND\Records;

class Record {

	private $val;

	public $type;
	public $size;

	public function __construct($v = false) {
		if (!method_exists($this, "validate")) {
			throw new \Exception("No validate method");
		}

		if (!$this->type) {
			throw new \Exception("No type in this record");
		}
		if (!$this->size) {
			throw new \Exception("No length in this record");
		}

		// If we weren't given anything in the constructor, we may have
		// a default.
		if (!$v && isset($this->defaultval)) {
			$v = $this->defaultval;
		}

		if ($this->validate($v)) {
			$this->val = $v;
		} else {
			throw new \Exception("Unknown error validating $v");
		}
	}

	public function renderRecord() {
		return [ "type" => $this->type, "size" => $this->size, "value" => $this->val ];
	}
}

