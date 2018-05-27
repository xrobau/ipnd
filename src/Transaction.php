<?php

namespace AussieVoIP\IPND;

class Transaction {

	public $r = [
		'PublicNumber' => 1,
		'ServiceStatusCode' => 2,
		'PendingFlag' => 3,
		'CancelPendingFlag' => 4,
		'CustomerName' => 5,
		'FindingName' => 6,
		'ServiceAddress' => 7,
		'DirectoryAddress' => 8,
		'ListCode' => 9,
//		'UsageCode' => 10,
//		'TypeOfService' => 11,
//		'CustomerContact' => 12,
//		'CSPCode' => 13,
//		'DataProviderCode' => 14,
//		'TransactionDate' => 15,
//		'ServiceStatusDate' => 16,
//		'AlternateAddressFlag' => 17,
//		'PriorPublicNumber' => 18,
	];

	private $t = [];

	public function addEntry($p) {
		// Trim off "AussieVoIP\IPND\Records\", which is 24 chars
		$resource = substr(get_class($p), 24);
		if (!isset($this->r[$resource])) {
			throw new \Exception("Don't know what to do with resource $resource");
		}
		$index = $this->r[$resource];
		$this->t[$index] = $p;
	}

	public function renderTransaction() {
		$base = new IPND_Base;
		$retarr = [];
		$flipped = array_flip($this->r);
		foreach ($flipped as $i => $v) {
			print "I have $i and $v\n";
			if (!isset($this->t[$i])) {
				// This wasn't provided, so create it. If it doesn't have a default, it will error
				$this->t[$i] = Record::getElement($v);
			}
			if ($this->t[$i]->type === "MULTIPLE") {
				$tmparr = $this->t[$i]->getMultipleRecords();
				foreach ($tmparr as $row) {
					$retarr[] = IPND::formatCol($row);
				}
			} else {
				$retarr[] = IPND::formatCol($this->t[$i]->getRecord());
			}
		}
		return implode($retarr);
	}

}


