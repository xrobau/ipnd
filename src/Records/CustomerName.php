<?php

namespace AussieVoIP\IPND\Records;

class CustomerDetails {

	public $d;

	public function setCompanyName($cn) {
		$this->d['CompanyName'] = $cn;
	}

	public function setCustomerName($title, $fullname) {
		// Split the name on spaces
		$namearr = explode(" ", $fullname);
		if (empty($namearr[0])) {
			throw new \Exception("Nothing in '$fullname'");
		}
		// We want the LAST entry for surname
		$surname = array_pop($namearr);
		$this->d['CustomerName1'] = $surname;

	}

}

