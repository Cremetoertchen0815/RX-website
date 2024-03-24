<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery View</title>
    <link rel="stylesheet" href="css/main.css">
    <link href="css/simple-lightbox.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/simple-lightbox.jquery.min.js"></script>
</head>

<body>
    <a class="backBtn" href="gigs.php">Zurück</a>
    <div class="gallery">

        <?php
        // Image extensions
        $image_extensions = array("png", "jpg", "JPG", "JPEG", "jpeg", "gif");

        // Target directory
        $dir = 'img/gigs/' . htmlspecialchars($_GET["dir"]);

        if (is_dir($dir)) {

            if ($dh = opendir($dir)) {
                $count = 1;

                // Read files
                while (($file = readdir($dh)) !== false) {

                    if ($file != '' && $file != '.' && $file != '..') {

                        // Thumbnail image path
                        $thumbnail_path = $dir . "/thumb/" . $file;

                        // Image path
                        $image_path = $dir . "/" . $file;

                        $thumbnail_ext = pathinfo($thumbnail_path, PATHINFO_EXTENSION);
                        $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);

                        // Check its not folder and it is image file
                        if (
                            !is_dir($image_path) &&
                            in_array($thumbnail_ext, $image_extensions) &&
                            in_array($image_ext, $image_extensions) &&
                            file_exists($thumbnail_path)
                        ) {
                            ?>

                            <!-- Image -->
                            <a href="<?php echo $image_path; ?>">
                                <img src="<?php echo $thumbnail_path; ?>" alt="" title="" width="102px" />
                            </a>
                            <!-- --- -->
                            <?php


                            $count++;
                        }
                    }

                }
                closedir($dh);
            }
        }
        ?>
    </div>

    <script type='text/javascript'>
        $(document).ready(function () {

            // Intialize gallery
            var gallery = $('.gallery a').simpleLightbox();

        });
    </script>
</body>

</html>