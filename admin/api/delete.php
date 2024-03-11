<?php

$username = $_POST["name"] ?? "";
$password = $_POST["password"] ?? "";

//Check credentials
if ($username != "Random@min" || $password != "Celine! Brot!") {
    http_response_code(403);
    die();
}

$id = $_POST["id"] ?? "";
if (empty($id)) die();

//Read all data
$data = file('../gigs.dat');
$result = [];

//Add all items to new list, except for item with specific
foreach ($data as $line) {
    $curr_id = explode(';', $line) [0];
    if ($curr_id == $id) continue;
    $result[] = $line;
}

file_put_contents('../gigs.dat', $result);

http_response_code(307);	
header("Location: ../index.php");
die();