<?php
/**
* Nameber.php class takes a string and creates a data object
* describing the string in numbers based on the absolute value
* of the characters in the order of their alphabet mapping,
* and displaying that value in a number of popular numerical
* systems.
*
*/

//include_once("pi_1B.php");

class Nameber {

  // Properties
  public $name = [];
  public $numbers = [];
  private $language_code;
  private $character_maps = [];
  private $radices = [];

  // Constructor
  public function __construct($name_string, $language_code = "eng") {
    // Provide a mockable construction function for unit testing.
    $this->init($name_string, $language_code);
  }

  private function init($name_string, $language_code = "eng") {

    $this->language_code = $language_code;
    $this->character_maps["eng"] = range('a', 'z');
    $this->radices = range(2, 36);

    /* --- Name --- */
    $this->name["string"] = $name_string;
    $this->name["segments"] = explode(" ", $name_string);
    $this->name["count"] = count($this->name["segments"]);
    $this->name["letters"] = str_split(strtoupper($name_string), 1);

    /* -- Numbers --- */

    //Calculations
    $letter_numbers = [];
    foreach($this->name["letters"] as $letter) {
      $letter_numbers[] = strval( array_search( strtolower( $letter ), $this->character_maps[$this->language_code] ) + 1 );
    }
    $letter_numbers_string = implode("", $letter_numbers);
    $letter_numbers_sum = array_sum($letter_numbers);

    //Base Convert (2-36)
    foreach($this->radices as $radix) {
      foreach($letter_numbers as $letter_number) {
        $this->numbers["arabic"]["base"][$radix]["array"][] = base_convert($letter_number, 10, $radix);
       }
      $this->numbers["arabic"]["base"][$radix]["string"] = implode("", $this->numbers["arabic"]["base"][$radix]["array"]);
      $this->numbers["arabic"]["base"][$radix]["sum"] = base_convert($letter_numbers_sum, 10, $radix);
    }

    /* Special Conversions */

    //Unary
    for ($tally = 0; $tally < $letter_numbers_sum; $tally++) {
      $this->numbers["arabic"]["base"][1]["array"][] = "1";
    }
    $this->numbers["arabic"]["base"][1]["string"] = implode("", $this->numbers["arabic"]["base"][1]["array"]);
    $this->numbers["arabic"]["base"][1]["sum"] = $this->numbers["arabic"]["base"][1]["string"];

    //Roman
    foreach ($letter_numbers as $letter_number) {
      $this->numbers["roman"]["array"][] = $this->romanize($letter_number);
    }
    $this->numbers["roman"]["string"] = implode("", $this->numbers["roman"]["array"]);
    $this->numbers["roman"]["sum"] = $this->romanize($letter_numbers_sum);
  }

  function romanize($N){
    $c='IVXLCDM';
    for($a=5,$b=$s='';$N;$b++,$a^=7) {
      for($o=$N%$a,$N=$N/$a^0;$o--;$s=$c[$o>2?$b+$N-($N&=-2)+$o=1:$b].$s);
    }
    return $s;
  }
}
