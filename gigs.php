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
                <?php
                echo '<h3>' . $current[1] . '</h3>';
                if ($current[2] != 'Privat')
                    echo '<b>Eintritt: </b>' . $current[3] . '<br><span class="place">' . $current[2] . '</span>';
                else
                    echo '<i>' . $current[2] . '</i>';
                ?>
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
    $counter = 0;
    foreach ($old_dates as $current) {
        $redate = DateTime::createFromFormat('Y-m-d', $current[4]);
        if ($counter % 2 == 0)
            echo '<div class="oldGigPair">';
        ?>


        <div class="oldGig">
            <a href="view.php?dir=<?php echo $current[0] ?>" class="gigLink">
                <h3><?php echo $current[1] ?></h3>
                <span class="dateSpanSmall"><?php echo $redate->format('d.m.Y') ?></span><br>
            </a>
        </div>

        <?php
        if ($counter % 2 != 0 || $counter == count($old_dates))
            echo '</div>';
        $counter++;
    }
    ?>
</body>

</html>