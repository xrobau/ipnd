<?php

namespace AussieVoIP\IPND;

class Header {

	private $sequence;

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

	public function getLine() {
		if (!defined("SOURCE")) {
			throw new \Exception("Configuration error - SOURCE not defined");
		}

		return [
			[ "type" => "X", "size" => 3, "value" => "HDR" ],
			[ "type" => "X", "size" => 6, "value" => "IPNDUP" ],
			[ "type" => "X", "size" => 5, "value" => \SOURCE ],
			[ "type" => "N", "size" => 7, "value" => $this->sequence ],
			[ "type" => "N", "size" => 14, "value" => IPND::renderDate() ],
			[ "type" => "X", "size" => 870, "value" => "" ],
		];
	}
}


