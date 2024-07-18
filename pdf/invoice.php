<?php
require_once('../config.php');
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;


// $qry = $conn->query("SELECT r.*,c.firstname,c.lastname,c.email,c.contact,c.address,c.gender,br.name,p.category,q.address as location from `rent_list` r inner join bike_list q on q.id=r.quotation_id inner join clients c on c.id = r.client_id inner join brand_list br on br.id=q.company_id inner join product p on p.id=q.product_id where r.id = '{$_POST['id']}' ");
$qry = $conn->query("SELECT r.*,c.firstname,c.lastname,c.email,c.contact,br.name,ca.category,b.bike_model,b.daily_rate from `rent_list` r inner join clients c on c.id=r.client_id inner join bike_list b on b.id=r.bike_id inner join brand_list br on br.id=b.brand_id inner join categories ca on ca.id=b.category_id where r.id = '{$_GET['id']}' ");
// $qry = $conn->query("SELECT r.*,c.firstname,c.lastname,c.email,c.contact from `rent_list` r inner join clients c on c.id=r.client_id where r.id = '{$_GET['id']}' ");
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
              <td>' . $bike_modal . '</td>
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
$dompdf->stream("invoice.pdf");
$pdfstring = $dompdf->output();
