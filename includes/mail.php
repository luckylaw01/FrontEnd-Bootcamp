<?php



function sendMail($to, $subject, $message, $from = "sender@example.com", $replyTo = "sender@example.com") {
    // Set additional headers
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $replyTo\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        return true; // Email sent successfully
    } else {
        return false; // Failed to send email
    }
}


/* Call the function

    <?php

include 'mail.php';

$to = "recipient@example.com";
$subject = "Test Email";
$message = "This is a test email sent from PHP.";

if (sendMail($to, $subject, $message)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}

?>


*/
