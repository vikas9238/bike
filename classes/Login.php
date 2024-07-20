<?php
require_once '../config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
class Login extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	public function index()
	{
		echo "<h1>Access Denied</h1> <a href='" . base_url . "'>Go Back.</a>";
	}
	public function login()
	{
		extract($_POST);

		$qry = $this->conn->query("SELECT * from users where username = '$username' and password = md5('$password') ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $k => $v) {
				if (!is_numeric($k) && $k != 'password') {
					$this->settings->set_admindata($k, $v);
				}
			}
			$this->settings->set_admindata('loggedin', 1);
			return json_encode(array('status' => 'success'));
		} else {
			return json_encode(array('status' => 'incorrect', 'last_qry' => "SELECT * from users where username = '$username' and password = md5('$password') "));
		}
	}
	public function logout()
	{
		if ($this->settings->sess_des()) {
			redirect('admin/login.php');
		}
	}
	function login_user()
	{
		extract($_POST);
		$qry = $this->conn->query("SELECT * from clients where email = '$email' and password = md5('$password') ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $k => $v) {
				$this->settings->set_userdata($k, $v);
			}
			$this->settings->set_userdata('login_type', 0);
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'incorrect';
		}
		if ($this->conn->error) {
			$resp['status'] = 'failed';
			$resp['_error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function forgot_password()
	{
		extract($_POST);
		$qry = $this->conn->query("SELECT * from clients where email = '$email' ");
		if ($qry->num_rows > 0) {
			$user = $qry->fetch_assoc();
			$reset_key = md5(date('YmdHis') . $email);
			$this->conn->query("UPDATE clients set reset_key = '$reset_key' where id = " . $user['id']);
			$subject = 'Password Reset Link';
			$body = "<body style='font-family: Arial, sans-serif;background-color: #f4f4f4;margin: 0;padding: 0;'>
    <div style='background-color: #fff;margin: 0 auto;padding: 20px;max-width: 600px;border: 1px solid #ddd;'>
        <div style='background-color: #00B98E;color: #fff;padding: 10px;text-align: center;'>
            <h1>Bike Rental</h1>
        </div>
        <div style='padding: 20px;'>
            <h2>Forgot Password</h2>
            <p style='font-size: 14px;line-height: 1.6;'>Dear " . $user['firstname'] . " " . $user['lastname'] . ",</p>
            <p style='font-size: 14px;line-height: 1.6;'>We received a request to reset your password. Please click the link below to reset your password.</p>
            <p style='font-size: 14px;line-height: 1.6;'><a style='background-color: #11299e;color: white;padding: 15px 32px;text-decoration: none;' href='" . base_url . "?p=reset&key=$reset_key'>Reset Password</a></p>
            <p style='color: #d9534f;font-size: 14px;line-height: 1.6;'>If you did not request a password reset, please ignore this email.</p>
            <p style='font-size: 14px;line-height: 1.6;'>Thank you for choosing Bike Rental Service. We look forward to serving you.</p>
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

			$mail = new PHPMailer(true);
			try {
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

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = "$subject";
				$mail->Body    = "$body";
				if ($mail->send()) {
					$resp['status'] = 'success';
				} else {
					$resp['status'] = 'failed';
					$resp['_error'] = $mail->ErrorInfo;
				}
			} catch (Exception $e) {
				$resp['status'] = 'failed';
				$resp['_error'] = $mail->ErrorInfo;
			}
		} else {
			$resp['status'] = 'incorrect';
		}
		if ($this->conn->error) {
			$resp['status'] = 'failed';
			$resp['_error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function change_password()
	{
		extract($_POST);
		$qry = $this->conn->query("SELECT * from clients where reset_key='$key' ");
		if ($qry->num_rows > 0) {
			$user = $qry->fetch_assoc();
			$this->conn->query("UPDATE clients set password = md5('$password'), reset_key = null where id = " . $user['id']);
			$resp['status'] = 'success';
		} else {
			$resp['status'] = 'incorrect';
		}
		if ($this->conn->error) {
			$resp['status'] = 'failed';
			$resp['_error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login':
		echo $auth->login();
		break;
	case 'login_user':
		echo $auth->login_user();
		break;
	case 'logout':
		echo $auth->logout();
		break;
	case 'forgot_password':
		echo $auth->forgot_password();
		break;
	case 'change_password':
		echo $auth->change_password();
		break;
	default:
		echo $auth->index();
		break;
}
