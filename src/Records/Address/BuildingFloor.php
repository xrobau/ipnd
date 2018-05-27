<?php

namespace AussieVoIP\IPND\Records\Address;

class BuildingFloor {

	public $multiple = true;

	private $BuildingFloorType = "";
	private $BuildingFloorNr = "";
	private $BuildingFloorSuffix = "";

	public function __construct($floor = "", $type = "FL") {
		if ($floor) {
			$types = self::getFloorTypes();
			if (!isset($types[$type])) {
				throw new \Exception("Unknown floor type $type");
			}
			$this->BuildingFloorType = $type;
			if (preg_match("/([\d]+)([^\d]+)/", $floor, $out)) {
				$this->BuildingFloorNr = (int) $out[1];
				$this->BuildingFloorSuffix = substr($out[2], 0, 1);
			} else {
				$this->BuildingFloorNr = (int) $floor;
				$this->BuildingFloorSuffix = "";
			}
			if ($this->BuildingFloorNr > 1000 || $this->BuildingFloorNr < 1) {
				throw new \Exception("Invalid Floor Number ".$this->BuildingFloorNr);
			}
		}
	}

	public static function getFloorTypes() {
		// Note AS4590-2006 defines
		//  PTHS => Penthouse
		//  PLF => Platform
		//  PDM => Podium
		//
		//  See http://meteor.aihw.gov.au/content/index.phtml/itemId/429016
		//
		return [
			"B" => "Basement",
			"FL" => "Floor",
			"G" => "Ground",
			"L" => "Level",
			"LG" => "Lower ground floor",
			"M" => "Mezzanine",
			"OD" => "Observation deck",
			"P" => "Parking",
			"PT" => "Penthouse",
			"PL" => "Platform",
			"PD" => "Podium",
			"RT" => "Rooftop",
			"SB" => "Sub-basement",
			"UG" => "Upper ground floor",
		];
	}

	public function getMultiple() {
		return [ 
			"BuildingFloorType" => ["type" => "X", "size" => 2, "value" => $this->BuildingFloorType ],
			"BuildingFloorNr" => ["type" => "X", "size" => 4, "value" => $this->BuildingFloorNr ],
			"BuildingFloorSuffix" => ["type" => "X", "size" => 1, "value" => $this->BuildingFloorSuffix ],
		];
	}
}

