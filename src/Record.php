<?php

namespace AussieVoIP\IPND;

class Record extends IPND_Base {

	public static function getElement($c, $v) {
		$class = "AussieVoIP\\IPND\\Records\\$c";
		return new $class($v);
	}

}

