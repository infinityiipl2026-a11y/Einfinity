<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mail = new PHPMailer(true);

    try {

        // ==========================
        // SMTP SETTINGS
        // ==========================

        $mail->isSMTP();
        $mail->Host = "mail.einfinity.in";
        $mail->SMTPAuth = true;
        $mail->Username = "hrmanager@einfinity.in";
        $mail->Password = "Infinity@2288";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // ==========================
        // APPLICANT DETAILS
        // ==========================

        $fullname   = htmlspecialchars($_POST["fullname"]);
        $email      = htmlspecialchars($_POST["email"]);
        $phone      = htmlspecialchars($_POST["phone"]);
        $position   = htmlspecialchars($_POST["position"]);
        $experience = htmlspecialchars($_POST["experience"]);
        $location   = htmlspecialchars($_POST["location"]);
        $message    = htmlspecialchars($_POST["message"]);

        // ==========================
        // FROM & TO
        // ==========================

        $mail->setFrom(
            "hrmanager@einfinity.in",
            "Infinity Industries Careers"
        );

        $mail->addAddress(
            "hrmanager@einfinity.in",
            "HR Manager"
        );

        // Reply goes to applicant

        $mail->addReplyTo($email, $fullname);

        // ==========================
        // ATTACH RESUME
        // ==========================

        if (
            isset($_FILES["resume"]) &&
            $_FILES["resume"]["error"] == 0
        ) {

            $mail->addAttachment(
                $_FILES["resume"]["tmp_name"],
                $_FILES["resume"]["name"]
            );

        }

        // ==========================
        // EMAIL
        // ==========================

        $mail->isHTML(true);

        $mail->Subject = "New Career Application - " . $fullname;

        $mail->Body = "

        <h2>New Career Application</h2>

        <table border='1' cellpadding='10' cellspacing='0' style='border-collapse:collapse;font-family:Arial;'>

            <tr>
                <td><strong>Full Name</strong></td>
                <td>$fullname</td>
            </tr>

            <tr>
                <td><strong>Email</strong></td>
                <td>$email</td>
            </tr>

            <tr>
                <td><strong>Phone</strong></td>
                <td>$phone</td>
            </tr>

            <tr>
                <td><strong>Position Applied For</strong></td>
                <td>$position</td>
            </tr>

            <tr>
                <td><strong>Experience</strong></td>
                <td>$experience</td>
            </tr>

            <tr>
                <td><strong>Location</strong></td>
                <td>$location</td>
            </tr>

            <tr>
                <td><strong>Message</strong></td>
                <td>$message</td>
            </tr>

        </table>

        <br>

        <p>
        <strong>Resume:</strong> Please find the applicant's resume attached with this email.
        </p>

        ";

        $mail->send();

        echo "<script>

        alert('Application Submitted Successfully.');

        window.location.href='career.html';

        </script>";

    } catch (Exception $e) {

        echo "<script>

        alert('Application could not be submitted. Error: " . addslashes($mail->ErrorInfo) . "');

        window.history.back();

        </script>";

    }

}
?>