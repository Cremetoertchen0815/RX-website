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
    $image_names = [];

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

        //Load images
        $image_dir = '../img/gigs/' . $id;

        //Check for folder to exist
        if (!file_exists($image_dir) || !is_dir($image_dir)) {
            mkdir($image_dir, 0777, true);
        } else {
            $image_names = array_diff(scandir($image_dir), array('.', '..', 'thumb'));
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
    <form method="post" action="/admin/api/<?php echo $method; ?>.php" id="editForm" enctype="multipart/form-data">
        <div id="editArea">
            <label for="title">Name: </label><input type="text" name="title" value="<?php echo $title; ?>"><br>
            <label for="adress">Addresse: </label><input type="text" name="adress" value="<?php echo $adress; ?>"><br>
            <label for="price">Eintritt: </label><input type="text" name="price" value="<?php echo $price; ?>"><br>
            <label for="date">Datum: </label><input type="date" name="date" value="<?php echo $date; ?>"><br>
            <label for="entry">Einlass: </label><input type="time" name="entry" value="<?php echo $entry; ?>"><br>
            <label for="begins">Beginn: </label><input type="time" name="begins" value="<?php echo $begins; ?>"><br><br>

            <input type="hidden" name="name" value="<?php echo $username; ?>">
            <input type="hidden" name="password" value="<?php echo $password; ?>">
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
        </div>

        <div id="imageArea">
            <h2>Bilder auswählen:</h2>
            <p>(Klicke auf Bild, um es zu löschen)</p>
            <ul>
                <?php
                foreach ($image_names as $key => $image) {
                    echo '<li class="imagePath">' . $image . '</li>';
                }
                ?>
            </ul>

            <input name="oldImages" type="hidden" value="<?php echo htmlspecialchars('{ "data": ' . json_encode(array_values($image_names)) . ' }', ENT_QUOTES, 'UTF-8') ?>"/>
            <input name="upload[]" type="file" multiple/>
        </div>

        <div id="submit">
            <input type="submit" value="Speichern" style="margin-left: 50px;">
        </div>
    </form>
    <script>
        $("#backBtn").click(() => {
            const form = $("form");
            form.action = "index.php";
            form.submit();
        });

        $(".imagePath").click(x => {
            //Delete element
            let name = x.target.innerHTML;
            x.target.remove();

            //Remove from list
            const field = $('input[name="oldImages"]')[0];
            const items = $('.imagePath').map((_, x) => x.innerHTML).toArray();
            const nuData = JSON.stringify({"data": items});
            field.value = nuData;
            console.log( field.value);
        });
    </script>
</body>

</html>