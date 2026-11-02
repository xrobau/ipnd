<?php

namespace AussieVoIP\IPND\Records\Address;

class Locality {

	public $multiple = true;

	public $State;
	public $Postcode;
	public $Locality;

	private $postcode_data;

	public function __construct($postcode = false, $locality = "") {
		if ($postcode) {
			$this->Postcode = $this->setPostcode($postcode);
			if ($locality) {
				$this->setLocality($locality);
			}
		}
	}

	public function setPostcode($postcode) {
		// This requires the Australia Post Postcode file. See the POSTCODE.md
		// file in the 'data' folder.
		if (!file_exists(__DIR__."/../../../data/postcode_to_suburb.hash.php")) {
			throw new \Exception("Postcode hash data not present");
		}
		include __DIR__."/../../../data/postcode_to_suburb.hash.php";
		if (!isset($postcode_to_suburb_hash[$postcode])) {
			throw new \Exception("Unknown postcode $postcode");
		}
		$this->postcode_data = $postcode_to_suburb_hash[$postcode];
		$this->Postcode = $postcode;
		$this->State = $this->postcode_data[0]['STATE'];
		return $postcode;
	}

	public function setLocality($sub, $state = null) {
		// A postcode can cover more than one state (2620 is NSW and ACT), so if we were told the
		// state, the suburb has to be in the postcode for that state.
		foreach ($this->postcode_data as $row) {
			if ($row['LOCALITY'] === $sub && ($state === null || $row['STATE'] === $state)) {
				$this->Locality = $sub;
				$this->State = $row['STATE'];
				return true;
			}
		}
		$in = $state === null ? "" : " for $state";
		throw new \Exception("Suburb $sub is not in postcode ".$this->Postcode.$in);
	}

	public function getMultiple() {

		if (!$this->Locality) {
			throw new \Exception("No Locality set");
		}

		return [
			"State" => [ "type" => "X", "size" => 3, "value" => $this->State ],
			"Locality" => [ "type" => "X", "size" => 40, "value" => $this->Locality ],
			"Postcode" => [ "type" => "N", "size" => 4, "value" => $this->Postcode ],
		];
	}
}

