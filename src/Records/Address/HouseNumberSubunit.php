<?php

namespace AussieVoIP\IPND\Records\Address;

class HouseNumberSubunit {

	public $multiple = true;

	private $House1stNum;
	private $House1stSuffix = "";
	private $House2ndNum = "";
	private $House2ndSuffix = "";

	public function setHouseNum($i) {
		$tmparr = $this->getHouseNumAndSuffix($i);
		$this->House1stNum = $tmparr[0];
		$this->House1stSuffix = $tmparr[1];
	}

	public function setHouse2ndPart($i) {
		$tmparr = $this->getHouseNumAndSuffix($i);
		$this->House2ndNum = $tmparr[0];
		$this->House2ndSuffix = $tmparr[1];
	}

	public function getHouseNumAndSuffix($i) {
		// If we've been given '3A', split it into number and suffix
		if (preg_match("/([\d]+)([^\d]+)/", $i, $out)) {
			$num = (int) $out[1];
			$suffix = $out[2];
		} else {
			$num = (int) $i;
			$suffix = "";
		}

		if ($i === 0) {
			throw new \Exception("Can't have number zero");
		}
		if ($i < 0) {
			throw new \Exception("Negative building number?");
		}

		if ($i > 99999) {
			throw new \Exception("Number too large");
		}

		if (strlen($suffix) > 1) {
			throw new \Exception("Suffix too long (Max 1 char)");
		}

		return [ $num, $suffix ];
	}

	public function getMultiple() {
		return [ 
			"House1stNum" => ["type" => "X", "size" => 5, "value" => $this->House1stNum ],
			"House1stSuffix" => ["type" => "X", "size" => 3, "value" => $this->House1stSuffix ],
			"House2ndNum" => ["type" => "X", "size" => 5, "value" => $this->House2ndNum ],
			"House2ndSuffix" => ["type" => "X", "size" => 1, "value" => $this->House2ndSuffix ],
		];
	}
}

