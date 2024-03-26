<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <h1>



        <?php

        if (isset ($_POST['send'])) {
            if (!isset ($_POST['g-recaptcha-response']) || empty ($_POST['g-recaptcha-response'])) {
                echo 'reCAPTHCA verification failed, please try again.';
            } else {
                $secret = 'google_secret_key';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                $response = json_decode($response);

                if ($response->success) {


                    $subject = 'Nachricht von ' . $_POST['name'] . ' auf der Homepage(' . $_POST['mail'] . ')';
                    $message = $_POST['nachricht'];

                    if (mail('kontakt@random-x.de', $subject, $message)) {
                        echo 'Nachricht wurde versendet!';
                    } else {
                        echo 'Fehler beim Versenden der Nachricht!';
                    }
                } else {
                    // Your code here to handle a successful verification
                    echo 'reCAPTCHA-Authentifizierung fehlgeschlagen, bitte versuchen Sie es erneut.';
                }
            }
        }
        ?>
    </h1>
</body>

</html>