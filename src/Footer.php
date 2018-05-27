<?php

namespace AussieVoIP\IPND;

class Footer {

	private $sequence;
	private $count;

	public function __construct($i) {
		$seq = (int) $i;
		if ($seq < 1) {
			throw new \Exception("Invalid sequence number '$i'");
		}
		if ($seq >= 1000000) {
			throw new \Exception("Sequence number '$seq' too high");
		}
		$this->sequence = $seq;
	}

	public function render() {
		$values = $this->getLine();
		$rendered = [];
		foreach ($values as $i => $col) {
			$rendered[$i] = IPND::formatCol($col);
		}
		return implode($rendered);
	}

	public function setCount($c) {
		$count = (int) $c;
		if ($count < 1) {
			throw new \Exception("No rows");
		}
		if ($count > 1000000) {
			throw new \Exception("More than 100k rows, can't process");
		}
		$this->count = $count;
	}

	public function getLine() {
		if (!defined("SOURCE")) {
			throw new \Exception("Configuration error - SOURCE not defined");
		}

		return [
			[ "type" => "X", "size" => 3, "value" => "TRL" ],
			[ "type" => "N", "size" => 7, "value" => $this->sequence ],
			[ "type" => "N", "size" => 14, "value" => IPND::renderDate() ],
			[ "type" => "N", "size" => 7, "value" => $this->count ],
			[ "type" => "X", "size" => 874, "value" => "" ],
		];

	}

}


