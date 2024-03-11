<?php

$username = $_POST["name"] ?? "";
$password = $_POST["password"] ?? "";

$password = $_POST["title"] ?? "";
$password = $_POST["password"] ?? "";

//Check credentials
if ($username != "Random@min" || $password != "Celine! Brot!") {
    http_response_code(403);
    die();
}


//Read all data
$raw_data = file('../gigs.dat');
$keyed_data = [];

//Add all items to keyed array, except for item with specific
foreach ($raw_data as $line) {
    $curr_data = explode(';', str_replace("\n", "", $line));

    if ($curr_data[0] == $_POST["id"]) {
        $curr_data = [$_POST["id"], $_POST["title"], $_POST["adress"], $_POST["price"], $_POST["date"], $_POST["entry"], $_POST["begins"], ""];
    }

    if ($curr_data[0] != "Id")
        $keyed_data[$curr_data[4]] = $curr_data;
}

//Sort by date
ksort($keyed_data);

//Update Ids & implode
$half_imploded = ["Id;Name;Preis;Datum;Einlass;Beginn;-"];
foreach ($keyed_data as $key => $val) {
    $val[0] = (string)count($half_imploded);
    $half_imploded[] = implode(";", $val) . ";-";
}

file_put_contents('../gigs.dat', implode("\n", $half_imploded));

http_response_code(307);
header("Location: ../index.php");
die();