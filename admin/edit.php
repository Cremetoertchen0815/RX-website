<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tool.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <title>RandomX Admintool</title>
</head>

<body>
    <?php

    $username = $_POST["name"] ?? "";
    $password = $_POST["password"] ?? "";

    //Check credentials and redirect to login page if incorrect
    if ($username != "Random@min" || $password != "Celine! Brot!") {
        http_response_code(307);
        header("Location: index.php");
        die();
    }


    $id = $_POST["id"] ?? "";
    $method = $id == "" ? "create" : "modify";
    $current_data = null;

    //Load data if entry is edited
    if ($method == "modify") {
        $data = file('gigs.dat');
        foreach ($data as $line) {
            //Split CSV by delimiter and skip header
            $current = explode(';', $line);
            if ($current[0] != "$id")
                continue;

            $current_data = $current;
            break;
        }
    }

    date_default_timezone_set('Europe/Berlin');
    $title = $current_data[1] ?? "";
    $adress = $current_data[2] ?? "";
    $price = $current_data[3] ?? "Frei";
    $date = $current_data[4] ?? date("Y-m-d");
    $entry = $current_data[5] ?? date("G:i");
    $begins = $current_data[6] ?? date("G:i");

    ?>

    <h1>Gigs bearbeiten</h1>
    <div id="backBtn">
        Zurück zur Liste
    </div>
    <div id="editArea">
        <form method="post" action="/admin/api/<?php echo $method; ?>.php" id="editForm">
            <label for="title">Name: </label><input type="text" name="title" value="<?php echo $title; ?>"><br>
            <label for="adress">Addresse: </label><input type="text" name="adress" value="<?php echo $adress; ?>"><br>
            <label for="price">Eintritt: </label><input type="text" name="price" value="<?php echo $price; ?>"><br>
            <label for="date">Datum: </label><input type="date" name="date" value="<?php echo $date; ?>"><br>
            <label for="entry">Einlass: </label><input type="time" name="entry" value="<?php echo $entry; ?>"><br>
            <label for="begins">Beginn: </label><input type="time" name="begins" value="<?php echo $begins; ?>"><br><br>

            <input type="hidden" name="name" value="<?php echo $username; ?>">
            <input type="hidden" name="password" value="<?php echo $password; ?>">
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <input type="submit" value="Speichern">
        </form>
    </div>

    <script>
        $("#backBtn").click(() => {
            const form = $("form");
            form.action = "index.php";
            form.submit();
        });
    </script>
</body>

</html>