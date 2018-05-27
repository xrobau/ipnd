<?php

namespace AussieVoIP\IPND\Records;

class DirectoryAddress {

	public $a;

	public function setAddress(Address $a) {
		$this->a = clone $a;
		return $this;
	}

}

