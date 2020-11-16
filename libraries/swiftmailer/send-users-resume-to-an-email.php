<?php
	include_once '../../connection.php';
	$user_id=$_COOKIE['uid'];
	$query="SELECT * FROM resume_creator WHERE user_id='$user_id'";
	$result=mysqli_query($conn,$query);
	function ShareResume($email_to="",$subject_line="",$text_message="",$user_id="",$sender_name="")
	{
		require_once 'vendor/autoload.php';
		try {
			// Create the SMTP Transport
			$transport = (new Swift_SmtpTransport('mail.ropeyou.com', 587))
				->setUsername('no-reply@ropeyou.com')
				->setPassword('no-reply#2019');
		 
			// Create the Mailer using your created Transport
			$mailer = new Swift_Mailer($transport);
		 
			// Create a message
			$message = new Swift_Message();
		 
			// Set a "subject"
			$message->setSubject($subject_line);
		 
			// Set the "From address"
			$message->setFrom(['no-reply@ropeyou.com' => $sender_name]);
		 
			// Set the "To address" [Use setTo method for multiple recipients, argument should be array]
			$message->addTo($email_to,'You');
		 
			// Add "CC" address [Use setCc method for multiple recipients, argument should be array]
		   // $message->addCc('recipient@gmail.com', 'recipient name');
		 
			// Add "BCC" address [Use setBcc method for multiple recipients, argument should be array]
			//$message->addBcc('recipient@gmail.com', 'recipient name');
		 
			// Add an "Attachment" (Also, the dynamic data can be attached)
			$attachment = Swift_Attachment::fromPath('../../user-data/ru-resume-'.$user_id.'.pdf');
			$attachment->setFilename('ru-resume-'.$user_id.'.pdf');
			$message->attach($attachment);
		 
			// Add inline "Image"
			//$inline_attachment = Swift_Image::fromPath('nature.jpg');
			//$cid = $message->embed($inline_attachment);
		 
			// Set the plain-text "Body"
			//$message->setBody($text_message."\n\n This email has been send via ropeyou.com\n\nThank You\nTeam Ropeyou");
		 
			// Set a "Body"
			$message->addPart($text_message.'<br/><br/>This email has been send via ropeyou.com.<b><br><br>Thank You<br>Team Ropeyou</a>', 'text/html');
		 
			// Send the message
			$res = $mailer->send($message);
			//echo "Success";
		} catch (Exception $e) {
		  echo $e->getMessage();
		}
	}
	if(mysqli_num_rows($result)>0)
	{
		$email=$_REQUEST['email'];
		$subject=$_REQUEST['subject'];
		$text_message=$_REQUEST['text_message'];
		$row=mysqli_fetch_array($result);
		if($email!="" && $subject!="")
		{
			ShareResume($email,$subject,$text_message,$user_id,$row['first_name']);
			echo json_encode(array('status'=>"success"));
		}
		else{
			echo json_encode(array('status'=>"error"));
		}
		//$email_content=share_resume_email_html;
		//$email_content=str_replace("RY-EMAIL",$email,$email_content);
		//$email_content=str_replace("RY-SUBJECT",$subject,$email_content);
		//$email_content=str_replace("RY-MESSAGE",$text_message,$email_content);
	}
	else
	{
		echo json_encode(array('status'=>"error"));
	}
?>