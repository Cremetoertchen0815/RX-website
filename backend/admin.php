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

    if ($username != "Random@min" && $password != "Celine! Brot!") {
        //Login section
        ?>

        <div id="logonSection">
            <h1>Anmelden</h1>

            <?php
            if ($username != "" || $password != "") {
                echo '<span id="wrongCredentials">Benutzer oder Passwort falsch!</span>';
            }
            ?>

            <form id="LogonForm" method="post" action="admin.php">
                <label for="name">Benutzer: </label><input type="text" name="name"><br>
                <label for="password">Passwort: </label><input type="password" name="password"><br>
                <br>
                <input type="submit" value="Anmelden">
            </form>
        </div>
        <?php
    } else {
        //Actual page
        ?>
        <h1>Gigs bearbeiten</h1>
        <div id="allGigs">

            <?php

            $data = file('./gigs.dat');
            foreach ($data as $line) {

                //Split CSV by delimiter and skip header
                $current = explode(';', $line);
                if ($current[0] == "Id")
                    continue;
                ?>

                <div class="gig" gigId="<?php echo $current[0]; ?>">
                    <div class="gigIcons">
                        <img src="../img/icons/pencil.svg" class="editIcon">
                        <img src="../img/icons/delete.svg" class="deleteIcon">
                    </div>
                    <b>#<?php echo $current[0]; ?> </b> <?php echo $current[1]; ?><br><br>
                    Datum: <?php echo $current[4]; ?>
                </div>
                <?php
            }
            ?>

            <p id="addGigIcon">+</p>
        </div>

        <!-- 
            This form is used by JavaScript to open the edit page with credentials and information
        -->
        <form method="post" id="editPageForm" action="edit.php">
            <input type="hidden" name="name" value="<?php echo $username; ?>">
            <input type="hidden" name="password" value="<?php echo $password; ?>">
            <input type="hidden" name="method" value="">
            <input type="hidden" name="id" value="">
        </form>

        <script src="../js/admin.js"></script>

        <?php
    }
    ?>
</body>

</html>