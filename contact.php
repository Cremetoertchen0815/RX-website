<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/contact.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title>Document</title>
</head>

<body>
    <h1>Kontakt</h1>


    <form method="post" action="/mail.php" target="_self" id="form">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" class="maxwidth"><br>
        <label for="mail">E-Mail Addresse:</label><br>
        <input type="text" id="mail" name="mail" class="maxwidth"><br><br>
        <textarea name="nachricht" rows="5" class="maxwidth" style="resize: none;"></textarea><br>
        <div class="g-recaptcha" data-sitekey="your_site_key"></div>

        <br>
        <input id="submitBtn" type="submit" name="send" value="Senden">
    </form>
</body>

</html>