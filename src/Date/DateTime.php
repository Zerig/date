<?php
namespace Date;

class DateTime extends \DateTime{
	//public $interface;
	public $dt = null;

	public function __construct($str_date = null){
		//parent::__construct();

		$php_dateTime = [];

		//SQL format
		$php_dateTime[] = parent::createFromFormat('Y-m-d H:i:s', $str_date);
		$php_dateTime[] = parent::createFromFormat('Y-m-d H:i', $str_date);
		$php_dateTime[] = parent::createFromFormat('Y-m-d', $str_date);
		$php_dateTime[] = parent::createFromFormat('Y-m', $str_date);

		$php_dateTime[] = parent::createFromFormat('H:i:s', $str_date);
		$php_dateTime[] = parent::createFromFormat('H:i', $str_date);

		// CZECH format
		$php_dateTime[] = parent::createFromFormat('d. m. Y H:i:s', $str_date);
		$php_dateTime[] = parent::createFromFormat('d. m. Y H:i', $str_date);
		$php_dateTime[] = parent::createFromFormat('d. m. Y', $str_date);
		$php_dateTime[] = parent::createFromFormat('d. m.', $str_date);

		$php_dateTime[] = parent::createFromFormat('H:i', $str_date);
		$php_dateTime[] = parent::createFromFormat('H.i', $str_date);
		$php_dateTime[] = parent::createFromFormat('H.i\h', $str_date);
		$php_dateTime[] = parent::createFromFormat('H\h', $str_date);

		// iCAL format
		$php_dateTime[] = parent::createFromFormat('Ymd\THis\Z', $str_date);


		// Find which format were used and create \DateTime object
		$php_dateTime = array_filter($php_dateTime);
		$_php_dateTime = (!empty($php_dateTime))? end($php_dateTime) : null;



		if($_php_dateTime) 	parent::__construct($_php_dateTime->format('Y-m-d H:i:s'));
		else   		parent::__construct($str_date);

	}

	public static function createFromFormat($interface, $str_date, ?\DateTimeZone $object = NULL){
		$parent_class = parent::createFromFormat($interface, $str_date, $object);

		if($parent_class) 	return new DateTime( $parent_class->format('Y-m-d H:i:s') );
		else   				return $this->dt;
	}

	public function setInterface($interface){
		//$this->interface = $interface;
	}



	public function format($str_date){
		$str_date = self::setMonth($str_date);		// Find Month chars
		$str_date = self::setWeekDay($str_date);	// Find Week day chars

		return parent::format($str_date);
	}







	public function setMonth($str_date){
		//  MONTH
		if( strpos($str_date, "M") !== false ){
			$cz_month = self::cz_month(0);
			$cz_month = "\\".implode("\\", str_split($cz_month));

			$str_date = str_replace("M", $cz_month, $str_date);
		}
		if( strpos($str_date, "F") !== false ){
			$cz_month = self::cz_month();
			$cz_month = "\\".implode("\\", str_split($cz_month));

			$str_date = str_replace("F", $cz_month, $str_date);
		}

		return $str_date;
	}



	public function setWeekDay($str_date){
		//  WEEK DAY
		if( strpos($str_date, "D") !== false ){
			$cz_weekday = self::cz_weekday(0);
			$cz_weekday = "\\".implode("\\", str_split($cz_weekday));

			$str_date = str_replace("D", $cz_weekday, $str_date);
		}
		if( strpos($str_date, "l") !== false ){
			$cz_weekday = self::cz_weekday();
			$cz_weekday = "\\".implode("\\", str_split($cz_weekday));

			$str_date = str_replace("l", $cz_weekday, $str_date);
		}

		return $str_date;
	}





	/*
	 * DATE CZ MONTH
	 * transform DateTime or month_num to CZECH format of MONTH
	 */
	public function cz_month($f = 2){
		$m = intval(parent::format("m"));

		$month = array(
			1 => array(  	0=>"led", 	1=>"leden", 	2=>"ledna", 	3=>"lednu", 	4=>"leden", 	5=>"ledne", 	6=>"lednu", 	7=>"lednem"),
			2 => array( 	0=>"úno", 	1=>"únor", 		2=>"února", 	3=>"únoru", 	4=>"únor", 		5=>"únore", 	6=>"únoru", 	7=>"únorem"),
			3 => array( 	0=>"bře", 	1=>"březen", 	2=>"března", 	3=>"březnu", 	4=>"březen", 	5=>"březne", 	6=>"březnu", 	7=>"březnem"),
			4 => array( 	0=>"dub", 	1=>"duben", 	2=>"dubna", 	3=>"dubnu", 	4=>"duben", 	5=>"dubne", 	6=>"dubnu", 	7=>"dubnem"),
			5 => array( 	0=>"kvě", 	1=>"květen", 	2=>"květne", 	3=>"květnu", 	4=>"květen", 	5=>"květne", 	6=>"květnu", 	7=>"květnem"),
			6 => array( 	0=>"čvn", 	1=>"červen", 	2=>"června", 	3=>"červnu", 	4=>"červen", 	5=>"červne", 	6=>"červnu", 	7=>"červnem"),
			7 => array( 	0=>"čvc", 	1=>"červenec", 	2=>"července", 	3=>"červenci", 	4=>"červenec", 	5=>"červenci", 	6=>"červenci", 	7=>"červencem"),
			8 => array( 	0=>"srp", 	1=>"srpen", 	2=>"srpna", 	3=>"srpnu", 	4=>"srpen", 	5=>"srpne", 	6=>"srpnu", 	7=>"srpnem"),
			9 => array( 	0=>"zář",	1=>"září", 		2=>"září", 		3=>"září", 		4=>"září", 		5=>"září", 		6=>"září", 		7=>"zářím"),
			10 => array( 	0=>"říj", 	1=>"říjen", 	2=>"října", 	3=>"říjnu", 	4=>"říjen", 	5=>"říjne", 	6=>"říjnu", 	7=>"říjnem"),
			11 => array( 	0=>"lis", 	1=>"listopad", 	2=>"listopadu", 3=>"listopadu", 4=>"listopad", 	5=>"listopade", 6=>"listopadu", 7=>"listopadem"),
			12 => array( 	0=>"pros", 	1=>"prosinec", 	2=>"prosinece", 3=>"prosineci", 4=>"prosinec", 	5=>"prosineci", 6=>"prosineci", 7=>"prosinecem"),
		);

		return isset($month[$m][$f])? $month[$m][$f] : null;
	}


	public function cz_weekday($f = 1){
		$d = intval(parent::format("N"));

		$week_day = array(
			1 => array(  	0=>"PO", 	1=>"Pondělí", 	2=>"Pondělí", 	3=>"Pondělí", 	4=>"Pondělí", 	5=>"Pondělí", 	6=>"Pondělí", 	7=>"Pondělím"),
			2 => array( 	0=>"ÚT", 	1=>"Úterý", 	2=>"Úterý", 	3=>"Úterý", 	4=>"Úterý", 	5=>"Úterý", 	6=>"Úterý", 	7=>"Úterým"),
			3 => array( 	0=>"ST", 	1=>"Středa", 	2=>"Středy", 	3=>"Středě", 	4=>"Středu", 	5=>"Středo", 	6=>"Středě", 	7=>"Středou"),
			4 => array( 	0=>"ČT", 	1=>"čtvrtek", 	2=>"čtvrta", 	3=>"čtvrtu", 	4=>"čtvrtek", 	5=>"čtvrtu", 	6=>"čtvrtu", 	7=>"čtvrtem"),
			5 => array( 	0=>"PÁ", 	1=>"Pátek", 	2=>"Pátku", 	3=>"Pátku", 	4=>"Pátek", 	5=>"Pátku", 	6=>"Pátku", 	7=>"Pátkem"),
			6 => array( 	0=>"SO", 	1=>"Sobota", 	2=>"Soboty", 	3=>"Sobotě", 	4=>"Sobotu", 	5=>"Soboto", 	6=>"Sobotě", 	7=>"Sobotou"),
			7 => array( 	0=>"NE", 	1=>"Neděle", 	2=>"Neděle", 	3=>"Neděli", 	4=>"Neděli", 	5=>"Neděle", 	6=>"Neděli", 	7=>"Nedělí"),
		);

		return isset($week_day[$d][$f])? $week_day[$d][$f] : null;
	}


}
