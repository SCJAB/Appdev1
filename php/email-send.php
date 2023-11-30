<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sheanluisralph@gmail.com';                     //SMTP username
    $mail->Password   = 'cvwg yatd dzxr ddsi';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('sheanluisralph@gmail.com', 'Untangled Depression Test');
    $mail->addAddress($_SESSION['email']);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your results!';
    $mail->Body = '
    <html>
    <head>
        <title>Your Results and Recommendations</title>
    </head>
    <body style="font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; padding: 20px;">
        <div style="max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px;">
            <h2 style="color: #007bff;">Dear User ' . htmlspecialchars($_SESSION['firstname']) . ' ' . htmlspecialchars($_SESSION['lastname']) . ',</h2>
            <p>We hope this message finds you well.</p>
            <p>As part of your recent assessment, we wanted to provide you with your depression score and some guidance based on your results.</p>
            <p>Your depression score is: <strong>' . htmlspecialchars($_SESSION['totalScore']) . '</strong></p>
            <p>Your depression level is: <strong>' . htmlspecialchars($_SESSION['depression_level']) . '</strong></p>
            <p>Please remember that these scores are indicators and not definitive measures. It\'s essential to interpret them in context and seek professional advice or support if needed.</p>
            <p>Remember, taking steps towards mental well-being is a courageous journey, and seeking assistance when necessary is a commendable choice. Should you wish to discuss your results or seek further guidance, please don\'t hesitate to reach out.</p>
            <p>Wishing you the best in your journey to well-being.</p>
            <p>Warm regards,<br>Untabgled</p>
        </div>
    </body>
    </html>
';

$mail->AltBody = 'Dear ' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . ',\n\nWe hope this message finds you well.\n\nAs part of your recent assessment, we wanted to provide you with your depression score and some guidance based on your results.\n\nYour depression score is: ' . $_SESSION['totalScore'] . '.\n\nPlease remember that these scores are indicators and not definitive measures. It\'s essential to interpret them in context and seek professional advice or support if needed.\n\nRemember, taking steps towards mental well-being is a courageous journey, and seeking assistance when necessary is a commendable choice. Should you wish to discuss your results or seek further guidance, please don\'t hesitate to reach out.\n\nWishing you the best in your journey to well-being.\n\nWarm regards,\nUntangled';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

session_destroy();
header("location: ../index.php?save-success=true");