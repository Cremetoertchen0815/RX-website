<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/gigs.css">
    <title>Document</title>
</head>

<body>
    <h1>Gigs</h1>

    <br>

    <?php
    $data = file('./admin/gigs.dat');
    $old_dates = [];

    foreach ($data as $line) {
        //Split CSV by delimiter and skip header
        $current = explode(';', $line);
        if ($current[0] == "Id")
            continue;

        //If gig is passed already, we'll add it to the list later and can forget about it now
        if ($current[4] < date("Y-m-d")) {
            $old_dates[] = $current;
            continue;
        }

        $redate = DateTime::createFromFormat('Y-m-d', $current[4])

        //Render gig
        ?>

        <div class="gig">
            <div class="gigLeft">
                <h2><?php echo $current[1] ?></h2>
                <b>Eintritt: </b><?php echo $current[3] ?><br>
                <span class="place"><?php echo $current[2] ?></span>
            </div>
            <div class="gigRight">
                <span class="dateSpan"><?php echo $redate->format('d.m.Y') ?></span><br>
                <b>Einlass: </b><?php echo $current[5] ?> Uhr<br>
                <b>Beginn: </b><?php echo $current[6] ?> Uhr
            </div>
        </div>

    <?php
    }

    echo '<span id="oldConcertsHeading">VERGANGENE KONZERTE:</span>';

    $old_dates = array_reverse($old_dates);
    foreach ($old_dates as $current) {
        $redate = DateTime::createFromFormat('Y-m-d', $current[4])
        ?>

        <div class="gig">
            <div class="gigLeft">
                <h2><?php echo $current[1] ?></h2>
                <br>
                <span class="place"><?php echo $current[2] ?></span>
            </div>
            <div class="gigRight">
                <span class="dateSpan"><?php echo $redate->format('d.m.Y') ?></span><br>
                <a href="gallery.php?id=<?php echo $current[0] ?>" class="gigLink">Bilder</a><br>
                <a href="gallery.php?id=<?php echo $current[0] ?>" class="gigLink">Videos</a>
            </div>
        </div>

        <?php
    }
    ?>
</body>

</html>