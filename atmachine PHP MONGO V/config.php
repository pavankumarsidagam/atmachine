<?php
require 'vendor/autoload.php';

$mongoUri = "mongodb+srv://pavankumarsidagam:Xp2evrcxVoOtlNRq@cluster0.38qfz.mongodb.net/";
$databaseName = "atmachine";

try {
    $client = new MongoDB\Client($mongoUri);
    $db = $client->$databaseName;

    $collection = $db->users_table;
    $atm_machine = $db->atm_machine;
    $atm_transactions = $db->atm_transactions;

    $document = $collection->findOne();
    // print_r($document);

} catch (Exception $e) {
    echo "Failed to connect to MongoDB: " . $e->getMessage();
}
?>
