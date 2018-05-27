<?php

namespace AussieVoIP\IPND\Records;

class Address {

	public $elements;
	public $house = false;
	public $bld = false;

	public function __construct($type = "HOUSE") {
		$this->elements = new \StdClass;

		$this->elements->BuildingSubunit = new Address\BuildingSubunit();
		$this->elements->BuildingFloor = new Address\BuildingFloor();
		$this->elements->BuildingProperty = new Address\BuildingProperty();
		$this->elements->BuildingLocation = new Address\BuildingLocation();
		$this->elements->HouseNumberSubunit = new Address\HouseNumberSubunit();
		$this->elements->StreetAddress = new Address\StreetAddress();
		$this->elements->ServiceLocality = new Address\Locality();
		$this->setAddressType($type);
	}

	public function setAddressType($type) {
		if ($type === "HOUSE") {
			$this->house = true;
			$this->bld = false;
		} elseif ($type === "BUILDING") {
			$this->house = false;
			$this->bld = true;
		} else {
			throw new \Exception("Unknown type $type");
		}
	}

	public function setLocality($postcode, $suburb = false) {
		$this->elements->ServiceLocality->setPostcode($postcode);
		if ($suburb) {
			$this->elements->ServiceLocality->setLocality($suburb);
		}
	}

	public function setStreetNumber($start, $end = "") {
		if ($this->house && $this->bld) {
			throw new \Exception("It's a house and a building. Invalid");
		}
		if ($this->house) {
			$this->elements->HouseNumberSubunit->setHouseNum($start, $end);
		} elseif ($this->bld) {
			$this->elements->BuildingSubunit->setBuildingNum($start, $end);
		}
	}

	public function setStreetName($name, $type, $suffix = "") {
		$this->elements->StreetAddress->setStreetName($name, $type, $suffix);
	}

	public function setBuildingType($type) {
		$this->elements->BuildingSubunit->setBuildingType($type);
	}

	public function getAddress() {
		$retarr = [];
		foreach ($this->elements as $o) {
			if (isset($o->multiple)) {
				foreach ($o->getMultiple() as $row) {
					$retarr[] = $row;
				}
			} else {
				$retarr[] = $o->get();
			}
		}
		return $retarr;
	}
}

