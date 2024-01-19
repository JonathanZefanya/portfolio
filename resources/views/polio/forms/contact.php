<?php
	$DataFormWajib = array("name", "subject", "email", "message");

	// Jika ada data yang gak lengkap, jangan mau kirim email
	foreach ($DataFormWajib as $KeyForm) {
		if (!isset($KeyForm)) {
			http_response_code(400);
			die();
		}
	}


	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	require '../../../../vendor/autoload.php';

	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(false);

	try {
		// Server settings
		$mail->SMTPDebug = SMTP::DEBUG_OFF;
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'mail.tirtagt.xyz';                     // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'jonathanzefanya@tirtagt.xyz';          // SMTP username
		$mail->Password   = 'Kusanali_Nahida27';                    // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->SMTPAutoTLS = true; 									// Force TLS Encryption
		$mail->Port       = 587;                                    // TCP port to connect to
	
		// Recipients
		$mail->setFrom("jonathanzefanya@tirtagt.xyz", "Nahida");
		$mail->addAddress('jonathan.zefanya16@gmail.com', 'Jonathan Natannael Zefanya');
	
		// Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = $_POST['subject'];
		$mail->Body    = '
			From: ' . $_POST['name'] . '<br>
			Email: ' . $_POST['email'] . '<br>
			Message: <br>' . wordwrap($_POST['message'], 70) . '
		';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
		$mail->send();

		echo 'Pesan telah di kirim, terima kasih telah menghubungi';
	} catch (Exception $e) {
		throw $e; // bikin crash agar kecatat di error_log
	}
?>