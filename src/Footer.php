<?php

namespace AussieVoIP\IPND;

class Footer extends IPND_Base {

	private $sequence;
	private $count;

	public function setSequence($i) {
		$seq = (int) $i;
		if ($seq < 1) {
			throw new \Exception("Invalid sequence number '$i'");
		}
		if ($seq >= 1000000) {
			throw new \Exception("Sequence number '$seq' too high");
		}
		$this->sequence = $seq;
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
		if (!$this->sequence) {
			throw new \Exception("No Sequence defined");
		}
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


