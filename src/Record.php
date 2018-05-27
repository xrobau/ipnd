<?php

namespace AussieVoIP\IPND;

class Record {

	public static function getElement($c, $v = false) {
		$class = "AussieVoIP\\IPND\\Records\\$c";
		return new $class($v);
	}

}

