<?php
class doMail
{	
	
	public function sendMail($email,$subject,$message)
	{
		require_once 'resources/mailer/class.phpmailer.php';
		$mail = new PHPMailer(true);
		$settings = array(
				"site_name"=>'GoCheeta',
				"site_url"=>'',
				"basesmtpsecure"=>'ssl',
				"smtp_port"=>'465',
				"smtp_server"=>'',
				"smtp_email"=>'',
				"smtp_password"=>'',
				"senderemail"=>'',
				"senderemailname"=>'Gocheeta Admin',
				"smtp"=>1
			);
		
		
 
        if($settings['smtp']==1)
		{
			$template  = "<html><body style='margin:0;'><table style='padding:10px' width='100%' bgcolor='#9C2B2C' cellpadding='0' cellspacing='0' border='0'><tr><td><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'><thead><tr height='80'><th colspan='4' style='background-color:#363B4D; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#fff; font-size:34px;' >".$settings['site_name']."</th></tr></thead><tbody><tr><td colspan='4' style='padding:15px;'><p style='font-size:25px;' align='center'>".$subject."</p><hr /><p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>".$message."</p><p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>Thank You,</p><p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'><b>".$settings['site_name']." Team</b></p><p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>info@GoCheetaBucks.com</p></td></tr><tr height='80'><td colspan='4' align='center' style='padding:15px; color:#777; background-color:#f5f5f5; border-top:dashed #9C2B2C 1px; font-size:24px; '><p align='justify' style='font-size: 10px'>This email was sent by <a style='color: #9C2B2C;' href='".$settings['site_url']."/'>".$settings['site_url']."</a>. </p></td></tr></tbody></table></td></tr></table></body></html>";

			try
			{
				$mail->IsSMTP(); 
				$mail->isHTML(true);
				$mail->SMTPDebug  = 0;                     
				$mail->SMTPAuth   = true;                  
				$mail->SMTPSecure = $settings['basesmtpsecure'];                 
				$mail->Host       = $settings['smtp_server'];      
				$mail->Port       = $settings['smtp_port'];            
				$mail->AddAddress($email);
                // $mailer->AddCC("something@gmail.com", "bla");
				$mail->Username   = $settings['smtp_email'];   
				$mail->Password   = $settings['smtp_password'];           
				$mail->SetFrom($settings['senderemail'],$settings['senderemailname']);
				//$mail->AddReplyTo($settings['replytoemail'],$settings['replytoemailname']);
				//$mail->AddCC('person1@domain.com', '');
				$mail->Subject    = $subject;
				$mail->Body 	  = $template;
				$mail->AltBody    = $template;

				if($mail->Send())
				{
					return $mail;
				}
				else
				{
					return false;
				}
			}
			catch(Exception $ex)
			{
				$myExp = $ex->getMessage();
				echo '<script>alert("$email: '.$myExp.'");</script>';
				return false;
			}
		}
		else
		{	
			//echo '<script>alert("33 $email:'.$email.':$subject: '.$subject.' $message: '.$message.'");</script>';
			// Set content-type header for sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// Additional headers
			$headers .= 'From: '.$settings['senderemailname'].'<'.$settings['senderemail'].'>'. "\r\n";

			if(mail($email,$subject,$message,$headers))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
        
    public function sendMailNew($email,$emailCC,$subject,$message)
	{
		require_once 'resources/mailer/class.phpmailer.php';
		require_once 'classes/class.settings.php';
		$mail = new PHPMailer(true);
		$siteSettings = new SETTINGS();
		$settings = $siteSettings->selectSetting();
		//echo '<script>alert("$email: '.$email.' $subject: '.$subject.' smtp: '.$settings['smtp'].'");</script>';
                //echo '<script>alert("$email: '.$email.' $emailCC: '.$emailCC.' ");</script>';
                if($settings['smtp']==1)
		{
			$template  = "<html><body style='margin:0;'><table style='padding:10px' width='100%' bgcolor='#00CC67' cellpadding='0' cellspacing='0' border='0'><tr><td><table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'><thead><tr height='80'><th colspan='4' style='background-color:#363B4D; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#fff; font-size:34px;' >".$settings['site_name']."</th></tr></thead><tbody><tr><td colspan='4' style='padding:15px;'><p style='font-size:25px;' align='center'>".$subject."</p><hr /><p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>".$message."</p><p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>Thanks</p><p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'><b>The ".$settings['site_name']." Team</b></p></p><p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>accountspayable@icicibank.com</p></td></tr><tr height='80'><td colspan='4' align='center' style='padding:15px; color:#777; background-color:#f5f5f5; border-top:dashed #00CC67 1px; font-size:24px; '><p align='justify' style='font-size: 10px'>This email was sent by <a style='color: #00CC67;' href='".$settings['site_url']."/'>".$settings['site_url']."</a>. </p></td></tr></tbody></table></td></tr></table></body></html>";

			try
			{
				$mail->IsSMTP(); 
				$mail->isHTML(true);
				$mail->SMTPDebug  = 0;                     
				$mail->SMTPAuth   = true;                  
				$mail->SMTPSecure = $settings['basesmtpsecure'];                 
				$mail->Host       = $settings['smtp_server'];      
				$mail->Port       = $settings['smtp_port'];            
				$mail->AddAddress($email);                               
				$mail->AddCC($emailCC, '');                                
				$mail->Username   = $settings['smtp_email'];   
				$mail->Password   = $settings['smtp_password'];           
				$mail->SetFrom($settings['senderemail'],$settings['senderemailname']);
				//$mail->AddReplyTo($settings['replytoemail'],$settings['replytoemailname']);
				//$mail->AddCC('person1@domain.com', '');
				$mail->Subject    = $subject;
				$mail->Body 	  = $template;
				$mail->AltBody    = $template;

				if($mail->Send())
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			catch(Exception $ex)
			{
				$myExp = $ex->getMessage();
				echo '<script>alert("$email: '.$myExp.'");</script>';
				return false;
			}
		}
		else
		{	
			//echo '<script>alert("33 $email:'.$email.':$subject: '.$subject.' $message: '.$message.'");</script>';
			// Set content-type header for sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// Additional headers
			$headers .= 'From: '.$settings['senderemailname'].'<'.$settings['senderemail'].'>'. "\r\n";

			if(mail($email,$subject,$message,$headers))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}
?>