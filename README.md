## DATE \ DATE TIME
- extends **\DateTime** class

Work with DateTime class. But has czech name of Months and Week Days

Allows multiple way to create DateTime. Specificly Czech typo of writing
```php
// SQL
$date = new \Date\DateTime("2019-08-15 18:30:05");
$date = new \Date\DateTime("2019-08-15");
$date = new \Date\DateTime("18:30");

// CZECH
$date = new \Date\DateTime("15. 08. 2019 18:30:05");
$date = new \Date\DateTime("15. 08. 2019");
$date = new \Date\DateTime("18:30");

// iCAL
$date = new \Date\DateTime("20190815T183005Z");

// Your own Format
$date = \Date\DateTime::createFromFormat('Y-m-d H:i:s', "2019-08-15 18:30:05");


$date->format("d. m. Y H:i:s")	=> "15. 08. 2019 18:30:05"
$date->format("D d. F Y H:i:s")	=> "PÁ 15. srpna 2019 18:30:05"
$date->format("l d. F Y H:i:s")	=> "Pátek 15. srpna 2019 18:30:05"

```
