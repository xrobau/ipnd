<?php

namespace AussieVoIP\IPND;

class Transaction {

	public $r = [
		'PublicNumber' => 1,
		'ServiceStatusCode' => 2,
		'PendingFlag' => 3,
		'CancelPendingFlag' => 4,
	];

	private $t = [];

	public function addEntry($p) {
		// Trim off "AussieVoIP\IPND\Records\", which is 24 chars
		$resource = substr(get_class($p), 24);
		if (!isset($this->r[$resource])) {
			throw new \Exception("Don't know what to do with resource $resource");
		}
		$index = $this->r[$resource];
		$this->t[$index] = $p;
	}

	public function renderTransaction() {
		var_tump($this->t);
	}
}


