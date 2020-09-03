<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    require 'database.php';

    if(isset($_POST["email"])){
        $emailTo = $_POST["email"];

        $code = uniqid(true);
        $sql = "INSERT INTO reset(code, email) VALUES('$code', '$emailTo');";
        $run = mysqli_query($conn, $sql);
        if(!$run){
            exit("Error");
        }

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'nasa.nase72@gmail.com';
            $mail->Password   = 'Jasamnikola1';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('pavlovicnikola511@gmail.com', 'Paki');
            $mail->addAddress($emailTo);
            $mail->addReplyTo('no-reply@gmail.com', 'No reply');

            // Content
            $url = "http://" .$_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code";
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Request';
            $mail->Body    = "<h1>You requested a password reset</h1>
                                Click <a href='$url'>this link</a> to reset your password";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Reset password link has been sent to your email';
        } 
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        exit();
    }
    
?> 
<form method='POST'>
    <input type='text' name='email' placeholder='Email'>
    <input type='submit' name='submit' value='Reset password'>
</form>