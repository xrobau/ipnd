<?php

namespace AussieVoIP\IPND;

class IPND {

	private $header;
	private $footer;

	private $transactions;

	public function __construct($seq) {
		$this->header = new Header;
		$this->header->setSequence($seq);
		$this->footer = new Footer;
		$this->transactions = [];
	}

	public function addTransaction($t) {
		$this->transactions[] = $t;
	}

	public function render() {
		print $this->header->render()."\n";
		$this->footer->rows = count($this->transactions);
		foreach ($this->transactions as $t) {
			print $t->render()."\n";
		}
		print $this->footer->render()."\n";
	}

	public static function renderDate() {
		// This field contains details of the date and time the
		// creation of the data file commenced. The file header
		// create start date field is 14 digits in length and follows
		// the format YYYYMMDDHHMMSS
		date_default_timezone_set("Australia/Brisbane");
		$d = new \DateTime();
		$d->setTimezone(new \DateTimeZone("Australia/Brisbane"));
		return $d->format("YmdHis");
	}

	public static function formatColX($value, $size) {
		$l = strlen($value);
		if ($l < $size) {
			// It's less, pad it to size
			$str = str_pad($value, $size);
		} else {
			// It's equal or larger. Trim it if it is
			$str = substr($value, 0, $size);
		}
		return $str;
	}

	public static function formatColN($value, $size) {
		// Zero pad it to size
		$str = sprintf("%0".$size."d", $value);
		if (strlen($str) > $size) {
			throw new \Exception("Col is larger than size - ".strlen($str)." > $size for $value");
		}
		return $str;
	}
}



