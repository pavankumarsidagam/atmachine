<?php
$sever = "localhost";
$username = "root";
$password = "";
$database = "atmachine";

$conn = new mysqli ($sever , $username , $password , $database);

if ($conn !=""){
    $min = 1000000000; // Minimum 10-digit number
    $max = 9999999999; // Maximum 10-digit number

    $randomNumber = random_int($min, $max);
    //echo $randomNumber;

    $str = "bitchescomendgobruh";
    //echo md5($str);

}else{
}
?>