<?php

require("thumb.php");

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

    if ($curr_data[0] != "Id")
        $keyed_data[$curr_data[4]] = $curr_data;
}

//Append new item
$nu_id = "-69";
$keyed_data[$_POST["date"]] = [$nu_id, $_POST["title"], $_POST["adress"], $_POST["price"], $_POST["date"], $_POST["entry"], $_POST["begins"], ""];

//Sort by date
ksort($keyed_data);

//Update Ids & implode
$half_imploded = ["Id;Name;Preis;Datum;Einlass;Beginn;-"];
foreach ($keyed_data as $key => $val) {
    $id_orig = $val[0];
    $val[0] = (string)count($half_imploded);
    $half_imploded[] = implode(";", $val);

    //Remember the ID of the new element
    if ($id_orig == $nu_id) $nu_id = $val[0];
}

file_put_contents('../gigs.dat', implode("\n", $half_imploded));

//Handle image uploads
$image_dir = '../../img/gigs/' . $nu_id;
$thumb_dir = '../../img/gigs/' . $nu_id . '/thumb';
if (!file_exists($thumb_dir) || !is_dir($thumb_dir)) mkdir($thumb_dir, 0777, true);
$total = count($_FILES['upload']['name']);

// Loop through each file
for( $i=0 ; $i < $total ; $i++ ) {

  //Get the temp file path
  $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

  //Make sure we have a file path
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = $image_dir . "/" . $_FILES['upload']['name'][$i];
    $newThumbPath = $thumb_dir . "/" . $_FILES['upload']['name'][$i];

    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
        createThumbnail($newFilePath, $newThumbPath, 88);
    }
  }
}

http_response_code(307);
header("Location: ../index.php");
die();