<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('en', 'phpmailer/language/');
	$mail->IsHTML(true);

	/*
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'user@example.com';                     //SMTP username
	$mail->Password   = 'secret';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	*/

	//From who letter
	$mail->setFrom('from@gmail.com', 'Freelancer for Life'); // Add required E-mail
	//No who letter
	$mail->addAddress('to@gmail.com'); // Add required E-mail
	//The subject of the letter
	$mail->Subject = 'Greeting! This is "Freelancer for Life"';

	//The body of the letter
	$body = '<h1>Meet the super letter!</h1>';

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>First Name:</strong> '.$_POST['name'].'</p>';
    }

    if(trim(!empty($_POST['surname']))){
        $body.='<p><strong>Last Name:</strong> '.$_POST['surname'].'</p>';
    }

	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}

    if(trim(!empty($_POST['phone']))){
        $body.='<p><strong>Phone Number:</strong> '.$_POST['phone'].'</p>';
    }

    if(trim(!empty($_POST['message']))){
        $body.='<p><strong>Message:</strong> '.$_POST['message'].'</p>';
    }

	$mail->Body = $body;

	//Sending
	if (!$mail->send()) {
		$message = 'Error';
	} else {
		$message = 'Message sent successful';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>