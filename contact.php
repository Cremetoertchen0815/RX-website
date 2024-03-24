<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>

<body>
    <h1>Kontakt</h1>


    <form method="post" action="/mail.php" target="_self">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" size="45" class="maxwidth"><br>
        <label for="mail">E-Mail Addresse:</label><br>
        <input type="text" id="mail" name="mail" size="45" class="maxwidth"><br><br>
        <input type="checkbox" name="mailconfirm" class="maxwidth"><br>
        <textarea name="nachricht" cols="45" rows="5" class="maxwidth" style="resize: none;"></textarea><br>
        <input type="submit" value="Senden">
    </form>
</body>

</html>