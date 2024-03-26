<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/slideshow.css">
  <title>Document</title>
</head>

<body>
  <h1>Herzlich Willkommen bei <br><b class="random">RANDOM X</b>!</h1><br>


  <!-- Slideshow container -->
  <div class="slideshow-container">

    <?php

    $files = glob('img/slideshow/*.{jpg,png,gif}', GLOB_BRACE);
    $filecount = count($files);
    $currentnr = 1;
    foreach ($files as $file) {
      //do your work here
    

      echo '<div class="mySlides fade">';
      echo '  <div class="numbertext">' . $currentnr . ' / ' . $filecount . '</div>';
      echo '  <img src="' . $file . '" class="slideshowPic">';
      echo ' </div>';
      $currentnr++;
    }
    ?>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <br>

  <!-- The dots/circles -->
  <div style="text-align:center">
    <?php

    $files = glob('img/slideshow/*.{jpg,png,gif}', GLOB_BRACE);
    $currentnr = 1;
    foreach ($files as $file) {
      //do your work here
    

      echo '<span class="dot" onclick="currentSlide(' . $currentnr . ')"></span>';
      $currentnr++;
    }
    ?>
  </div>
  <br>

  <p>
    Hi, wir sind <b>RANDOM X</b>, eine Cover-Band aus Haßmersheim! <br>
    Wir covern alles von Pop bis Rock, von <b>(A)</b>BBA bis <b>(Z)</b>ombie. Schaut euch gerne um, über einen Besuch
    auf einem unserer nächsten Konzerte würden wir uns sehr freuen!
  </p>

  <script src="js/slideshow.js"></script>
</body>

</html>