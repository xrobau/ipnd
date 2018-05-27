<?php

namespace AussieVoIP\IPND\Records;

class DirectoryAddress {

	public $type = "MULTIPLE";

	public $a;

	public function setAddress(Address $a) {
		$this->a = clone $a;
		return $this;
	}

	public function getMultipleRecords() {
		$tmparr = [];
		$tmparr[] = $this->a->elements->BuildingSubunit->getMultiple();
		$tmparr[] = $this->a->elements->BuildingFloor->getMultiple();
		$tmparr[] = [ $this->a->elements->BuildingProperty->get() ];
		$tmparr[] = [ $this->a->elements->BuildingLocation->get() ];
		$tmparr[] = $this->a->elements->HouseNumberSubunit->getMultiple();
		$tmparr[] = $this->a->elements->StreetAddress->getMultiple();
		$tmparr[] = $this->a->elements->ServiceLocality->getMultiple();

		$retarr = [];
		foreach ($tmparr as $rows) {
			foreach ($rows as $r) {
				$retarr[] = $r;
			}
		}
		return $retarr;
	}

}

