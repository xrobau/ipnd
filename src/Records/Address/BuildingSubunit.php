<?php

namespace AussieVoIP\IPND\Records\Address;

class BuildingSubunit {

	public $multiple = true;

	private $BuildingType = "";
	private $Building1stNum = "";
	private $Building1stSuffix = "";
	private $Building2ndNum = "";
	private $Building2ndSuffix = "";

	public function setBuildingNum($start, $end = "") {
		$tmparr = $this->getBuildingNumAndSuffix($start);
		$this->Building1stNum = $tmparr[0];
		$this->Building1stSuffix = $tmparr[1];
		if ($end) {
			$tmparr = $this->getBuildingNumAndSuffix($end);
			$this->Building2ndNum = $tmparr[0];
			$this->Building2ndSuffix = $tmparr[1];
		}

	}

	public function setBuildingType($type) {
		$validtypes = $this->getAllbuildingTypes();
		if (!isset($validtypes[$type])) {
			throw new \Exception("Invalid building type $type");
		}
		$this->BuildingType = $type;
	}

	public function getBuildingNumAndSuffix($i) {
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

	public function getAllBuildingTypes($val) {
		return [
			"" => "",
			"ANT" => "Antenna",
			"APT" => "Apartment",
			"ATM" => "Automated Teller Machine",
			"BBQ" => "Barbecue",
			"BTSD" => "Boatshed",
			"BLDG" => "Building",
			"BNGW" => "Bungalow",
			"CAGE" => "Cage",
			"CARP" => "Carpark",
			"CARS" => "Carspace",
			"CLUB" => "Club",
			"COOL" => "Coolroom",
			"CTGE" => "Cottage",
			"DUPL" => "Duplex",
			"FCTY" => "Factory",
			"FLAT" => "Flat",
			"GRGE" => "Garage",
			"HALL" => "Hall",
			"HSE" => "House",
			"KSK" => "Kiosk",
			"LSE" => "Lease",
			"LBBY" => "Lobby",
			"LOFT" => "Loft",
			"LOT" => "Lot",
			"MSNT" => "Maisonette",
			"MBTH" => "Marine Berth",
			"OFFC" => "Office",
			"RESV" => "Reserve",
			"ROOM" => "Room",
			"SHED" => "Shed",
			"SHOP" => "Shop",
			"SHRM" => "Showroom",
			"SIGN" => "Sign",
			"SITE" => "Site",
			"STLL" => "Stall",
			"STOR" => "Store",
			"STR" => "Strata unit",
			"STU" => "Studio/studio apartment",
			"SUBS" => "Substation",
			"SE" => "Suite",
			"TNCY" => "Tenancy",
			"TWR" => "Tower",
			"TNHS" => "Townhouse",
			"UNIT" => "Unit",
			"VLT" => "Vault",
			"VLLA" => "Villa",
			"WARD" => "Ward",
			"WHSE" => "Warehouse",
			"WKSH" => "Workshop",
		];
	}

	public function getMultiple() {
		return [ 
			"BuildingType" => ["type" => "X", "size" => 6, "value" => $this->BuildingType ],
			"Building1stNum" => ["type" => "X", "size" => 5, "value" => $this->Building1stNum ],
			"Building1stSuffix" => ["type" => "X", "size" => 1, "value" => $this->Building1stSuffix ],
			"Building2ndNum" => ["type" => "X", "size" => 5, "value" => $this->Building2ndNum ],
			"Building2ndSuffix" => ["type" => "X", "size" => 1, "value" => $this->Building2ndSuffix ],
		];
	}
}

