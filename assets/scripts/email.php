<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "edmcdarwin777@gmail.com"; // Admin email
    $subject = "New User Joined";

    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $location = $_POST['location'];
    $message = $_POST['message'];

    $body = "
        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='background-color: #0d1016; border: 1px solid #ddd; border-radius: 8px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);'>
            <tr>
                <td style='padding: 20px;'>
                    <h2 style='color: #1abc9c; margin-top: 0; text-align: center;'>New Project Order</h2>
                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                        <tr>
                            <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>Name:</td>
                            <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>$name</td>
                        </tr>
                        <tr>
                            <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>Email:</td>
                            <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>$email</td>
                        </tr>
                        <tr>
                            <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>Tel:</td>
                            <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>$tel</td>
                        </tr>
                        <tr>
                            <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>Location:</td>
                            <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>$location</td>
                        </tr>
                        <tr>
                            <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>Message:</td>
                            <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>$message</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    ";

    // Send email to the admin
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";

    if (mail($to, $subject, $body, $headers)) {
        // Send confirmation email to the user
        $confirmationSubject = "Thanks For Joining...";
        $confirmationBody = "
            <table cellpadding='0' cellspacing='0' border='0' width='100%' style='background-color: #0d1016; border: 1px solid #ddd; border-radius: 8px; padding: 20px;'>
                <tr>
                    <td style='padding: 20px;'>
                        <h2 style='color: #1abc9c; margin-top: 0; text-align: center;'>Thank You for Your Submission!</h2>
                        <p style='color: #fff;'>Dear $name,</p>
                        <p style='color: #fff;'>Thank you for reaching out! We have received your project request and will get back to you shortly.</p>
                        <h2 style='color: #1abc9c; margin-top: 0; text-align: center;'>Request Summary!</h2>
                        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                            <tr>
                                <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>Name:</td>
                                <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>$name</td>
                            </tr>
                            <tr>
                                <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>Email:</td>
                                <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>$email</td>
                            </tr>
                            <tr>
                                <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>Tel:</td>
                                <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>$tel</td>
                            </tr>
                            <tr>
                                <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>Location:</td>
                                <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>$location</td>
                            </tr>
                            <tr>
                                <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>Message:</td>
                                <td style='width: 50%; padding: 10px; color: #fff; border-bottom: 1px solid #444;'>$message</td>
                            </tr>
                        </table>
                        <p style='color: #fff; text-align: center;'>Best Regards,</p>
                        <i>Copyright © Creation AI <br> A Product Of <a href='https://zorithautomations.com/'>Zorith Automations</a></i> 
                    </td>
                </tr>
            </table>
        ";

        // Send confirmation email
        $confirmationHeaders = "MIME-Version: 1.0" . "\r\n";
        $confirmationHeaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $confirmationHeaders .= "From: <$to>" . "\r\n"; // Company email for From
        $confirmationHeaders .= "Reply-To: $to" . "\r\n";

        mail($email, $confirmationSubject, $confirmationBody, $confirmationHeaders);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
