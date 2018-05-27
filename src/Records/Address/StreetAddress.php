<?php

namespace AussieVoIP\IPND\Records\Address;

class StreetAddress {

	public $multiple = true;

	private $Street1Name = "";
	private $Street1Type = "";
	private $Street1Suffix = "";
	private $Street2Name = "";
	private $Street2Type = "";
	private $Street2Suffix = "";

	public function setStreetName($street, $type, $suffix = "") {
		$this->Street1Name = $street;
		$this->Street1Type = $this->validateType($type);
		$this->Street1Suffix = $suffix;
	}

	public function setStreet2ndPart($street, $type, $suffix = "") {
		$this->Street2Name = $street;
		$this->Street2Type = $this->validateType($type);
		$this->Street2Suffix = $suffix;
	}

	public function validateType($type) {
		$alltypes = self::getRoadTypes();
		// Do we know about this unflipped?
		if (isset($alltypes[$type])) {
			return $type;
		}

		// Flip it so we can look it up
		$flipped = array_flip($alltypes);
		if (!isset($flipped[$type])) {
			throw new \Exception("Unknown type $type");
		}
		return $flipped[$type];
	}

	public function getMultiple() {
		return [ 
			"Street1Name" => ["type" => "X", "size" => 25, "value" => $this->Street1Name ],
			"Street1Type" => ["type" => "X", "size" => 8, "value" => $this->Street1Type ],
			"Street1Suffix" => ["type" => "X", "size" => 6, "value" => $this->Street1Suffix ],
			"Street2Name" => ["type" => "X", "size" => 25, "value" => $this->Street2Name ],
			"Street2Type" => ["type" => "X", "size" => 4, "value" => $this->Street2Type ],
			"Street2Suffix" => ["type" => "X", "size" => 2, "value" => $this->Street2Suffix ],
		];
	}

	public static function getRoadSuffixes() {
		return [
			"CN" => "Central",
			"E" => "East",
			"EX" => "Extension",
			"LR" => "Lower",
			"N" => "North",
			"NE" => "North East",
			"NW" => "North West",
			"S" => "South",
			"SE" => "South East",
			"SW" => "South West",
			"UP" => "Upper",
			"W" => "West",
		];
	}

	public static function getRoadTypes() {
		return [
			"ACCS" => "Access",
			"ALLY" => "Alley",
			"ALWY" => "Alleyway",
			"AMBL" => "Amble",
			"APP" => "Approach",
			"ARC" => "Arcade",
			"ARTL" => "Arterial",
			"ARTY" => "Artery",
			"AV" => "Avenue",
			"BA" => "Banan",
			"BEND" => "Bend",
			"BWLK" => "Boardwalk",
			"BVD" => "Boulevard",
			"BR" => "Brace",
			"BRAE" => "Brae",
			"BRK" => "Break",
			"BROW" => "Brow",
			"BYPA" => "Bypass",
			"BYWY" => "Byway",
			"CSWY" => "Causeway",
			"CTR" => "Centre",
			"CH" => "Chase",
			"CIR" => "Circle",
			"CCT" => "Circuit",
			"CRCS" => "Circus",
			"CL" => "Close",
			"CON" => "Concourse",
			"CPS" => "Copse",
			"CNR" => "Corner",
			"CT" => "Court",
			"CTYD" => "Courtyard",
			"COVE" => "Cove",
			"CR" => "Crescent",
			"CRST" => "Crest",
			"CRSS" => "Cross",
			"CSAC" => "Cul-de-sac",
			"CUTT" => "Cutting",
			"DALE" => "Dale",
			"DIP" => "Dip",
			"DR" => "Drive",
			"DVWY" => "Driveway",
			"EDGE" => "Edge",
			"ELB" => "Elbow",
			"END" => "End",
			"ENT" => "Entrance",
			"ESP" => "Esplanade",
			"EXP" => "Expressway",
			"FAWY" => "Fairway",
			"FOLW" => "Follow",
			"FTWY" => "Footway",
			"FORM" => "Formation",
			"FWY" => "Freeway",
			"FRTG" => "Frontage",
			"GAP" => "Gap",
			"GDNS" => "Gardens",
			"GTE" => "Gate",
			"GLDE" => "Glade",
			"GLEN" => "Glen",
			"GRA" => "Grange",
			"GRN" => "Green",
			"GR" => "Grove",
			"HTS" => "Heights",
			"HIRD" => "Highroad",
			"HWY" => "Highway",
			"HILL" => "Hill",
			"INTG" => "Interchange",
			"JNC" => "Junction",
			"KEY" => "Key",
			"LANE" => "Lane",
			"LNWY" => "Laneway",
			"LINE" => "Line",
			"LINK" => "Link",
			"LKT" => "Lookout",
			"LOOP" => "Loop",
			"MALL" => "Mall",
			"MNDR" => "Meander",
			"MEWS" => "Mews",
			"MTWY" => "Motorway",
			"NOOK" => "Nook",
			"OTLK" => "Outlook",
			"PDE" => "Parade",
			"PWY" => "Parkway",
			"PASS" => "Pass",
			"PSGE" => "Passage",
			"PATH" => "Path",
			"PWAY" => "Pathway",
			"PIAZ" => "Piazza",
			"PLZA" => "Plaza",
			"PKT" => "Pocket",
			"PNT" => "Point",
			"PORT" => "Port",
			"PROM" => "Promenade",
			"QDRT" => "Quadrant",
			"QYS" => "Quays",
			"RMBL" => "Ramble",
			"REST" => "Rest",
			"RTT" => "Retreat",
			"RDGE" => "Ridge",
			"RISE" => "Rise",
			"RD" => "Road",
			"RTY" => "Rotary",
			"RTE" => "Route",
			"ROW" => "Row",
			"RUE" => "Rue",
			"SVWY" => "Serviceway",
			"SHUN" => "Shunt",
			"SPUR" => "Spur",
			"SQ" => "Square",
			"ST" => "Street",
			"SBWY" => "Subway",
			"TARN" => "Tarn",
			"TCE" => "Terrace",
			"THFR" => "Thoroughfare",
			"TLWY" => "Tollway",
			"TOP" => "Top",
			"TOR" => "Tor",
			"TRK" => "Track",
			"TRL" => "Trail",
			"TURN" => "Turn",
			"UPAS" => "Underpass",
			"VALE" => "Vale",
			"VIAD" => "Viaduct",
			"VIEW" => "View",
			"VSTA" => "Vista",
			"WALK" => "Walk",
			"WKWY" => "Walkway",
			"WHRF" => "Wharf",
			"WYND" => "Wynd",
		];
	}
}

