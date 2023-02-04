<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
if ( isset( $_POST[ 'email' ] ) ) {

	$string_exp = "/^[A-Za-z .'-]+$/";

	$name = $_POST[ 'name' ];
	$email_from = $_POST[ 'email' ];
	$telephone = $_POST[ 'telephone' ];
	$comments = $_POST[ 'comments' ];

	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if ( !preg_match( $email_exp, $email_from ) ) {
		echo '<script>alert("รูปแบบอีเมลล์ไม่ถูกต้องค่ะ");window.location.href="contact.php";</script>';
		exit();
	}
 
	require("PHPMailer_v5.0.2/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->CharSet = "utf-8";
	$mail->IsSMTP();
	$mail->SMTPDebug = 1;
	$mail->SMTPAuth = true;
	$mail->Host = "mail.jplaluminium.com"; // SMTP server old : mail.pmart.co.th
	$mail->Port = 25; // พอร์ท
	$mail->Username = "system@jplaluminium.com"; // account SMTP
	$mail->Password = "Jpl@2018"; // รหัสผ่าน SMTP
	$mail->SetFrom( "system@jplaluminium.com","ระบบ" );
	
	$email_message = "ลูกค้าส่งรายละเอียดถึงคุณ<br>";
	$email_message .= "Name: " . $name . "<br>";
	$email_message .= "Email: " . $email_from . "<br>";
	$email_message .= "Telephone: " . $telephone . "<br>";
	$email_message .= "Comments: " . $comments . "<br>";
	
	
	$mail->Subject = "ลูกค้าส่งรายละเอียดถึงคุณ";
	$body = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body><div style="padding:40px;">' .$email_message. '</div></body></html>';
	$mail->MsgHTML( $body );
	$mail->AddAddress( "jplaluminium@gmail.com" ); // ผู้รับคนที่หนึ่ง
	// $mail->AddAddress("recipient2@somedomain.com", "recipient2"); // ผู้รับคนที่สอง
	$mail->Send();
	echo '<script>alert("ส่งข้อมูลของคุณเรียบร้อยแล้วค่ะ");window.location.href="contact.php";</script>';
}
?>