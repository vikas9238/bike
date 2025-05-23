<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../config.php');

//Load Composer's autoloader
require '../vendor/autoload.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email'])) {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $reason = $_POST['reason'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $company = $_POST['company'];
    $mobile = $_settings->info('mobile');
    $company_email = $_settings->info('email');
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'no-reply@nrfindustry.in';                     //SMTP username
        $mail->Password   = 'Nrf@9238';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('no-reply@nrfindustry.in', 'Bike Rental Service');
        $mail->addAddress($email);     //Add a recipient


        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Urgent: Cancellation of Bike Booking Order.';
        $mail->Body    = "<body style='font-family: Arial, sans-serif;background-color: #f4f4f4;margin: 0;padding: 0;'>
    <div style='background-color: #fff;margin: 0 auto;padding: 20px;max-width: 600px;border: 1px solid #ddd;'>
        <div style='background-color: #00B98E;color: #fff;padding: 10px;text-align: center;'>
            <h1>Bike Rental</h1>
        </div>
        <div style='padding: 20px;'>
            <h2>Cancellation of Bike Booking</h2>
            <p style='font-size: 14px;line-height: 1.6;'>Dear $firstname $lastname,</p>
            <p style='font-size: 14px;line-height: 1.6;'>I regret to inform you that we must cancel your recent Bike booking order due to $reason and unforeseen circumstances beyond our control. We apologize sincerely for any inconvenience caused.</p>
            <p style='font-size: 14px;line-height: 1.6;'>Brand: $company.</p>
            <p style='font-size: 14px;line-height: 1.6;'>Bike Modal: $category.</p>
            <p style='font-size: 14px;line-height: 1.6;'>Refund Amount: $amount</p>
            <p style='font-size: 14px;line-height: 1.6;'>As per our commitment to you, if any payment recive then we will process the refund of your payment within 72 hours. The refunded amount will be credited directly to your bank account.</p>
            <p style='font-size: 14px;line-height: 1.6;'>For further details, you can also view your profile on our website at https://bike.iframeit.in</p>
            <p style='color: #d9534f;font-size: 14px;line-height: 1.6;'>If you have any questions or need further assistance, please do not hesitate to contact our customer support team at <b>Email:</b><a href='mailto:$company_email'> $company_email</a> <b>Contact:</b><a href='tel:$mobile'> +91$mobile</a>. We're here to assist you.</p>
            <p style='font-size: 14px;line-height: 1.6;'>Thank you for your understanding and patience in this matter.</p>
            <p style='font-size: 14px;line-height: 1.6;'>Best Regards,<br>
                Bike Rental Team</p>
            <p style='font-size: 14px;line-height: 1.6;'><em>(This is a system generated mail and should not be replied to)</em></p>
            <hr>
            <div style='margin-top: 20px;font-size: 12px;color: #666;'>
                <p style='font-size: 14px;line-height: 1.6;'>Do not share your login username/password via email or over the phone. Bike Rental Team will never ask for it.</p>
                <p style='font-size: 14px;line-height: 1.6;'>*For all Term and Condition (t&c), Please refer to the Website <a href='https://bike.iframeit.in/'>link</a></p>
            </div>
        </div>
    </div>
</body>";



        $mail->send();
        $res['status'] = 'success';
        $res['msg'] = 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Invalid Request';
}
return json_encode($res);
