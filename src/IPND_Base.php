<?php

namespace AussieVoIP\IPND;

class IPND_Base {

	public function render() {
		$values = $this->getLine();
		$rendered = [];
		foreach ($values as $i => $col) {
			$rendered[$i] = $this->formatCol($col);
		}
		return implode($rendered);
	}


	public function formatCol($col) {
		switch ($col['type']) {
		case "X":
			return IPND::formatColX($col['value'], $col['size']);
		case "N":
			return IPND::formatColN($col['value'], $col['size']);
		}
		throw new \Exception("Unknown col ".json_encode($col));
	}

}


