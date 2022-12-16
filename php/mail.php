<?php
function sendEmail($body, $email)
{
    $hrsd = "From:Trust <mail.com>\n";
    $hrsd .= "Content-type: text/html; charset=iso-8859-1\r\n";
    mail($email, "Trust Logs", $body, $hrsd);
}
