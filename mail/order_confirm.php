<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
require_once('../config.php');
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;

ini_set('memory_limit', '256M'); // Increase PHP memory limit
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id'])) {

  set_time_limit(300); // Increase the maximum execution time to 5 minutes
  $qry = $conn->query("SELECT r.*,c.firstname,c.lastname,c.email,c.contact,br.name,ca.category,b.bike_model,b.daily_rate from `rent_list` r inner join clients c on c.id=r.client_id inner join bike_list b on b.id=r.bike_id inner join brand_list br on br.id=b.brand_id inner join categories ca on ca.id=b.category_id where r.id = '{$_POST['id']}' ");
  if ($qry->num_rows > 0) {
    foreach ($qry->fetch_assoc() as $k => $v) {
      $$k = $v;
    }
  }
  $html = '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    <style>
      body {
        margin: 0;
        padding: 0;
      }
      .invoice {
        text-align: center;
      }
      .invoice h1 {
        text-transform: uppercase;
        color: #333;
        margin-bottom: 10px;
      }
      .invoice .NRF {
        text-align: center;
        margin-bottom: 20px;
      }
      .invoice .NRF h2 {
        color: #3498db;
        margin-bottom: 5px;
        text-transform: uppercase;
      }
      .invoice .NRF p {
        margin: 5px 0;
        font-weight: bold;
      }
      .details {
        display: flex;
        margin-bottom: 20px;
        border-bottom: 2px solid #333;
      }
      .details p {
        text-transform: capitalize;
      }
      .left {
        text-align: left;
        float: left;
      }
      .right {
        text-align: right;
        float: right;
      }
      .invoice table {
        border-collapse: collapse;
        margin-top: 20px;
      }
      .invoice table th,
      .invoice table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
      }
      .invoice table th {
        background-color: #f2f2f2;
        color: #333;
        text-transform: uppercase;
      }
      .invoice table td {
        background-color: #fff;
        color: #555;
      }
      .invoice table tbody {
        font-weight: bold;
      }
      .invoice .total {
        text-align: right;
      }
      .invoice .total p {
        color: #333;
        font-weight: bold;
      }
      .signature {
        margin-top: 40px;
        float: right;
      }
      .signature p {
        margin-top: 20px;
      }
    </style>
  </head>
  <body>
    <div class="invoice-container">
      <div class="invoice">
        <h1>Invoice</h1>
        <div class="NRF">
          <h2>Bike Rental Service</h2>
           <p>
            <strong
              >' . $_settings->info('address') . '</strong
            >
          </p>
          <p><strong>Email:</strong> ' . $_settings->info('email') . '</p>
          <p><strong>Phone:</strong> +91-' . $_settings->info('mobile') . '</p>
          <p><strong>GST No:</strong> XXXXXXXXXXXXX</p>
        </div>
        <div class="details">
          <div class="left">
            <p><strong>Billed To</strong></p>
            <p><strong>Name:</strong> ' . $firstname . $lastname . '</p>
            <p><strong>Address:</strong> ' . $address . '</p>
            <p><strong>Contact:</strong> ' . $contact . '</p>
            <p><strong>Email:</strong> ' . $email . '</p>
          </div>
          <div class="right">
            <p><strong>Order Details</strong></p>
            <p><strong>Order Id:</strong> #' . $id . '</p>
            <p><strong>Order Date:</strong> ' . $date_created . '</p>
            <p><strong>Booking Start Date:</strong> ' . $date_start . '</p>
            <p><strong>Booking End Date:</strong> ' . $date_end . '</p>
            <p><strong>Invoice Download Date:</strong> ' . date('Y-m-d H:i:sa') . '</p>
          </div>
        </div>
        <hr style="clear: both" />
        <table>
          <thead>
            <tr>
              <th>Brand</th>
              <th>Category</th>
              <th>Bike Modal</th>
              <th>Rent Days</th>
              <th>Daily Rate</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>' . $name . '</td>
              <td>' . $category . '</td>
              <td>' . $bike_model . '</td>
              <td>' . $rent_days . '</td>
              <td>' . $daily_rate . '</td>
              <td>' . $amount . '</td>
            </tr>
          </tbody>
        </table>
        <div class="total">
          <p>
            <strong>Total Amount:</strong
            ><span style="font-family: DejaVu Sans; sans-serif;"> &#8377;</span>
            ' . $amount . '
          </p>
        </div>
        <div class="signature">
          <div class="right-signature">
            <span>Authorized Signature:</span><br>
            <span>________________________</span>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>';
  $dompdf = new Dompdf();
  $dompdf->loadHtml($html);
  $dompdf->setPaper('A4', 'portrait');
  $dompdf->render();
  // $dompdf->stream("invoice.pdf");
  $output = $dompdf->output();
  file_put_contents('invoice.pdf', $output); // Save the PDF locally

  // Retrieve form data
  $id = $_POST['id'];
  // $quantity = $_POST['quantity'];
  $amount = $daily_rate * $approved_quantity;
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
    // $mail->addAttachment('$pdfstring','invoice.pdf');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    // Attach the PDF generated by DOMPDF
    $mail->addStringAttachment($output, 'invoice.pdf'); // 'invoice.pdf' is the name of the file as it will appear in the email
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Order Confirmation - Thank You for Your Purchase!';
    $mail->Body    = "<body style='font-family: Arial, sans-serif;background-color: #f4f4f4;margin: 0;padding: 0;'>
    <div style='background-color: #fff;margin: 0 auto;padding: 20px;max-width: 600px;border: 1px solid #ddd;'>
        <div style='background-color: #00B98E;color: #fff;padding: 10px;text-align: center;'>
            <h1>Bike Rental</h1>
        </div>
        <div style='padding: 20px;'>
            <h2>Order Confirmation</h2>
            <p style='font-size: 14px;line-height: 1.6;'>Dear $firstname $lastname,</p>
            <p style='font-size: 14px;line-height: 1.6;'>We are pleased to inform you that your order has been successfully confirmed! Thank you for choosing Bike Rental Service for your purchase.</p>
            <p style='font-size: 14px;line-height: 1.6;'>Order Details:<br>
                Order Id: #$id<br>
                Date of Order: $date_created<br>
                Booking Start Date: $date_start<br>
                Booking End Date: $date_end<br>
                Brand: $name<br>
                Bike Model: $bike_model<br>
                Category: $category<br>
                Rent Days: $rent_days<br>
                Daily Rate: $daily_rate<br>
                Total Amount: $amount</p>
            <p style='font-size: 14px;line-height: 1.6;'>For further details, you can also view this transaction in your profile on our website at https://bike.iframeit.in</p>
            <p style='color: #d9534f;font-size: 14px;line-height: 1.6;'>If you have any urgent inquiries or need further assistance, please don't hesitate to contact our support team at <b>Email:</b><a href='mailto:$company_email'> $company_email</a> <b>Contact:</b><a href='tel:$mobile'> +91$mobile</a>. We're here to assist you.</p>
            <p style='font-size: 14px;line-height: 1.6;'>Thank you for your prompt attention to this matter.</p>
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
    unlink('invoice.pdf'); // Delete the PDF file after sending the email
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
} else {
  echo 'Invalid Request';
}
return json_encode($res);
