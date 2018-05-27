<?php

namespace AussieVoIP\IPND\Records;

class ServiceAddress {

	public $type = "MULTIPLE";

	public $a;

	public function setAddress(Address $a) {
		$this->a = clone $a;
		return $this;
	}

	public function getMultipleRecords() {
		$bsu = $this->a->elements->BuildingSubunit->getMultiple();
		$bfl = $this->a->elements->BuildingFloor->getMultiple();
		$bprop = $this->a->elements->BuildingProperty->get();
		$bloc = $this->a->elements->BuildingLocation->get();
		$hno = $this->a->elements->HouseNumberSubunit->getMultiple();
		$saddr = $this->a->elements->StreetAddress->getMultiple();
		$locale = $this->a->elements->ServiceLocality->getMultiple();
		var_dump($bsu); exit;
		return [ 
			"BuildingType" => ["type" => "X", "size" => 6, "value" => $this->BuildingType ],
			"Building1stNum" => ["type" => "X", "size" => 5, "value" => $this->Building1stNum ],
			"Building1stSuffix" => ["type" => "X", "size" => 1, "value" => $this->Building1stSuffix ],
			"Building2ndNum" => ["type" => "X", "size" => 5, "value" => $this->Building2ndNum ],
			"Building2ndSuffix" => ["type" => "X", "size" => 1, "value" => $this->Building2ndSuffix ],
		];
	}

}

