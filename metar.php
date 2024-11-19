<?php 

include_once "includes/vamsys.php";
$vamsys =   new vamsys();


$metar = $vamsys->metar(["airport_code" => "EHAM"]);
echo "<pre>", print_R(  $metar["data"]["weather"]["metar"] );


echo "<hr> <pre>", print_R(  $metar );