<code style="white-space: pre;">
<?php
include_once "../src/Date/DateTime.php";

$str = "2019-08-15 18:30:05";
echo "INPUT: ".$str."<br>";
$date = new \Date\DateTime($str);
echo print_r($date)."<br>";
echo $date->format("d. m. Y H:i:s")."<br>";
echo "<br>---------------------------------------------<br><br>";

$str = "2019-08-15 18:30:05";
echo "INPUT: ".$str."<br>";
$date = new \DateTime($str);
echo print_r($date)."<br>";
echo $date->format("d. m. Y H:i:s")."<br>";
echo "<br>---------------------------------------------<br><br>";


$str = "15. 08. 2019 18:30:05";
echo "INPUT: ".$str."<br>";
$date = new \Date\DateTime($str);
echo print_r($date)."<br>";
echo $date->format("d. F Y H:i:s")."<br>";
echo "<br>---------------------------------------------<br><br>";

$str = "15. 08. 2019 18:30";
echo "INPUT: ".$str."<br>";
$date = new \Date\DateTime($str);
echo print_r($date)."<br>";
echo $date->format("D d. m. Y H:i:s")."<br>";
echo "<br>---------------------------------------------<br><br>";



$str = "15. 08. 2019";
echo "INPUT: ".$str."<br>";
$date = new \Date\DateTime($str);
echo print_r($date)."<br>";
echo $date->format("d. m. Y H:i:s")."<br>";
echo "<br>---------------------------------------------<br><br>";

$str = "15. 08.";
echo "INPUT: ".$str."<br>";
$date = new \Date\DateTime($str);
echo print_r($date)."<br>";
echo $date->format("d. m. Y H:i:s")."<br>";
echo "<br>---------------------------------------------<br><br>";
echo "<br>---------------------------------------------<br><br>";

$str = "15. 08. 2019 18:30";
echo "INPUT: ".$str."<br>";
$date = \Date\DateTime::createFromFormat('d. m. Y H:i', $str);
echo print_r($date)."<br>";
echo $date->format("d. F Y H:i:s")."<br>";
echo "<br>---------------------------------------------<br><br>";
