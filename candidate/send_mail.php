 <?php
require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';

$email = $_POST['mail'];
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'apikey';                 // SMTP username
$mail->Password = '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';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('votingsystem-1c2abe@inbox.mailtrap.io', 'Admin');
//$mail->addAddress('akmalsabri@outlook.com', 'akmal sab');     // Add a recipient
//$mail->addAddress('D031710149@student.utem.edu.my', 'akmal sab');     // Add a recipient
$mail->addAddress($email, 'mail');     // Add a recipient

//$mail->addAddress('ellen@example.com');               // Name is optional
// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'RESET PASSWORD';
$mail->Body    = 'http://localhost/votesystem/respas.php';
$mail->AltBody = 'Please click the link to reset password';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
echo "<script>
alert('Link Sent');
window.location.href='index.php';
</script>";

}