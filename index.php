<?php

//index.php

$message = '';

$connect = new PDO("mysql:host=localhost;dbname=tables", "root", "");

function fetch_customer_data($connect)
{
	$query = "SELECT * FROM table1";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<tr>
				<th>Name</th>
				<th>Address</th>
				<th>City</th>
				<th>Postal Code</th>
			</tr>
	';
	foreach($result as $row)
	{
		$output .= '
			<tr>
				<td>'.$row["name"].'</td>
				<td>'.$row["rollno"].'</td>
				<td>'.$row["city"].'</td>
				<td>'.$row["DOB"].'</td>
			</tr>
		';
	}
	$output .= '
		</table>
	</div>
	';
	return $output;
}

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
  	use PHPMailer\PHPMailer\Exception;

if(isset($_POST["action"]))
{
	require_once './vendor/autoload.php';
	$file_name = md5(rand()) . '.pdf';
	$html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
	$html_code .= fetch_customer_data($connect);
    $mpdf = new \Mpdf\Mpdf();
	$mpdf->WriteHTML($html_code);
	$mpdf->SetWatermarkText('Tripodeal.com');
	$mpdf->showWatermarkText = true;
	$mpdf->watermarkTextAlpha = 0.05;
	$file = $mpdf->output();
	$filecontent = file_put_contents($file_name, $file);

	require 'vendor/autoload.php';


	$mail = new PHPMailer;
	$mail->IsSMTP();								//Sets Mailer to send message using SMTP
	$mail->Host = 'smtp.sendgrid.net';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = '587';								//Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->Username = 'apikey';					//Sets SMTP username
	$mail->Password = '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';					//Sets SMTP password
	$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = 'iammohammadfaizz@gmail.com';			//Sets the From email address for the message
	$mail->FromName = 'Mohd Faiz';			//Sets the From name of the message
	$mail->AddAddress('emeff011@gmail.com', 'Emeff XOX');		//Adds a "To" address
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
	$mail->Subject = 'This is a Test Mail';			//Sets the Subject of the message
	$mail->Body = 'this is the message body';				//An HTML or plain text message body
	if($mail->Send())								//Send an Email. Return true on success or false on error
	{
		$message = '<label class="text-success">Customer Details has been send successfully...</label>';
	}
	unlink($file_name);
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Create Dynamic PDF Send As Attachment with Email in PHP</title>
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<script src="bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center">Create Dynamic PDF Send As Attachment with Email in PHP</h3>
			<br />
			<form method="post">
				<input type="submit" name="action" class="btn btn-danger" value="PDF Send" /><?php echo $message; ?>
			</form>
			<br />
			<?php
			echo fetch_customer_data($connect);
			?>
		</div>
		<br />
		<br />
	</body>
</html>





