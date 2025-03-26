<?php
	include('config.php');

	if (session_status() === PHP_SESSION_NONE) {
	    session_start();
	}

	function saveLeads($data,$file){
		global $db,$conn;
		$name = (isset($data['last_name']) ? $data['last_name'] : false);
		$email = (isset($data['email']) ? $data['email'] : false);
		$phone = (isset($data['mobile']) ? $data['mobile'] : false);
		$message = (isset($data['message']) ? $data['message'] : '');	
		$form_name = (isset($data['form_name']) ? $data['form_name'] : '');	
		$utm_source = (isset($data['utm_source']) ? $data['utm_source'] : '');
		$utm_medium = (isset($data['utm_medium']) ? $data['utm_medium'] : '');
		$utm_term = (isset($data['utm_term']) ? $data['utm_term'] : '');
		$utm_content = (isset($data['utm_content']) ? $data['utm_content'] : '');
		$utm_campaign = (isset($data['utm_campaign']) ? $data['utm_campaign'] : '');
		$captchaResponse = (isset($data['g-recaptcha-response']) ? $data['g-recaptcha-response'] : '');
		$pageUrl = (isset($data['pageUrl']) ? $data['pageUrl'] : '');
		$captcha = (isset($data['captcha']) ? $data['captcha'] : '');
	
		$ip_address = getIP();
	
		$prject_name = (isset($data['project']) ? $data['project'] : '');
	
		$isUserExistsQry = mysqli_query($conn, "SELECT email FROM "._TABLE_NAME_." WHERE `email` = '$email'");
		$isUserExists = mysqli_fetch_array($isUserExistsQry);
		if($isUserExists)
			$userExist = $isUserExists['email'];
		if(false)
			$response = showResponse(2, 'user already exists');
		else{
			if($name && $phone && $email){
				$insert = array(
					'name' => $name,
					'email' => $email,
					'phone' => $phone,
					'message' => $message
					);
			
			
				$dateTime = date('Y-m-d H:i:s');

				// $result = mysqli_query($conn,"INSERT INTO "._TABLE_NAME_."(`name`, `email`, `mobile`, `company_name`,  `country_code`, `utm_source`, `utm_medium`, `utm_term`, `utm_content`, `utm_campaign`, `page_url`,  `ip_address`, `date_time` ) VALUES ('$name','$email','$mobile', '$company_name', '$country_code', '$utm_source', '$utm_medium', '$utm_term', '$utm_content', '$utm_campaign', '$pageUrl', '$ip_address', '$dateTime' )");
				$result = mysqli_query($conn,"INSERT INTO "._TABLE_NAME_."(`name`, `email`, `mobile`, `project_name`, `message`, `form_name`, `utm_source`, `utm_medium`, `utm_term`, `utm_content`, `utm_campaign`, `page_url`,  `ip_address`, `date_time` ) VALUES ('$name','$email','$phone', '$prject_name', '$message', '$form_name', '$utm_source', '$utm_medium', '$utm_term', '$utm_content', '$utm_campaign', '$pageUrl', '$ip_address', '$dateTime' )");
				
				
				if(isset($_SESSION['captcha']) && $_SESSION['captcha'] == $captcha){
					sendToCRM($data);
					if($result)
						$response = showResponse(1,'informations successfully saved');
					else
						$response = showResponse(0,'failed to save info'.mysqli_error($conn));
				}
				else{
					$result = false;
					$response = showResponse(3,'captcha verified failed,'.$_SESSION['captcha'].$captcha);
					
				}

			// fnSendMail($data);
			// if($result)
			// 	$response = showResponse(1,'informations successfully saved');
			// else
			// 	$response = showResponse(0,'failed to saved info'.mysqli_error($conn));

		}
		else
			$response = showResponse(-1, 'data insuffient');

	}
		return $response;
}

function verifyCaptcha($captchaResponse){

		$secretKey = "6LcDNnIpAAAAAMMQ9Vx-PaGdSBKLxmqbwha3U0um"; 

		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
		    'secret' => $secretKey,
		    'response' => $captchaResponse
		]));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);

		
		$responseData = json_decode($response);

		
		if ($responseData && $responseData->success) {
		    
			return true;
		} else {
		    
			return false;
		}
}

function fnSendMail($post){

  $headers = "From: ".EMAIL_FROM_NAME."<".FROM_EMAIL.">"."\r\n";
	$headers .='Content-type: text/html; charset=iso-8859-1; format=flowed\n';
	$headers .="MIME-Version: 1.0\n";
	$headers .="Content-Transfer-Encoding: 8bit\n";
	$headers .="X-Mailer: PHP\n";	
	$headers .= 'Cc: '.CONTACT_CC.'' . " \r\n";
	$headers .= 'Bcc: ' .CONTACT_BCC.''." \r\n";

	// Mail it
	$message='<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	  <title>'.CONTACT_SUBJECT.'</title>
	</head>
	<body>
		<p>Hi,<br/>
		Please find below registration details of '.LP_NAME.' landing page,</p>
		<table>';
	 if(isset($post['name'])){
	  	 $message .='<tr>
	      	<td>Name</td><td>:</td><td>'.$post['name'].'</td>
	    </tr>';
	  }  	
	   if(isset($post['phone'])){
	  	 $message .='<tr>
	      	<td>Phone No.</td><td>:</td><td>'.$post['phone'].'</td>
	    </tr>';
	  }  

	  if(isset($post['email'])){
	  	 $message .='<tr>
	      	<td>Email</td><td>:</td><td>'.$post['email'].'</td>
	    </tr>';
	  }  

	 if(isset($post['message'])){
	  	 $message .='<tr>
	      	<td>Message</td><td>:</td><td>'.$post['message'].'</td>
	    </tr>';
	  }  

	  if(isset($post['pageUrl'])){
	  	 $message .='<tr>
	      	<td>Page URL</td><td>:</td><td>'.$post['pageUrl'].'</td>
	    </tr>';
	  }  

	  
	   $message .='<tr>
	      	<td>Date Time</td><td>:</td><td>'.date('d/m/20y h:i:s').'</td>
	    </tr>';

     $message .='<tr>
	      	<td><br>Track All Leads in this URL <a href="'.BASE_URL.'/list-leads.php">Here</a></td>
	    </tr>';
	    
	$message .='</table></body>
	</html>
	';
	//echo $message.CONTACT_TO;exit;
	mail(CONTACT_TO,CONTACT_SUBJECT, $message, $headers);

}

function sendToCRM($data){

	$name = (isset($data['last_name']) ? $data['last_name'] : false);
	$mobile = (isset($data['mobile']) ? $data['mobile'] : false);
	$email = (isset($data['email']) ? $data['email'] : false);

$urlparams = array(
	'encoding' => 'UTF-8',
	'orgId' => '00D2v000000N0r0',

);
$data_fields = array(
	// 'oid' => '21492fc42c975df0b33df3c5ea91f1d85978626076e5483f6e01fb44925e1d3a',
	'oid' => '00D2v000000N0r0',
	// '00N2v00000GtoQD' => 'Vajram New Town Phase 2', // project_name
	'00N2v00000GtoQD' => 'Vajram Vivera', // project_name
	'retURL' => 'https://www.vajramgroup.com/campaigns/Codename(KGF)/LR/Landing_page/thankyou.php',
	'last_name' => $name,
	'mobile' => $mobile,
	'email' => $email,
	// '00N2v00000GtoQD' => '',
	'00N2u000000qreq' => '',
	'lead_source' => 'Google',
	'00N2v00000GtoQW' => 'Website',
	'encoding' => 'UTF-8'
);

// $curl = curl_init();

// $url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?'.http_build_query($urlparams);

// curl_setopt_array($curl, array(
//   CURLOPT_URL => $url,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS => $data_fields,
// ));

// echo $response = curl_exec($curl);

// curl_close($curl);

$encoded_array = [];

foreach ($data_fields as $key => $value) {
    $encoded_array[] = urlencode($key) . '=' . urlencode($value);
}

$post_data = implode('&', $encoded_array);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://webto.salesforce.com/servlet/servlet.WebToLead?'.http_build_query($urlparams),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $post_data,
  CURLOPT_HTTPHEADER => array(
    // 'Content-Type: application/x-www-form-urlencoded',
  ),
));

$response = curl_exec($curl);

curl_close($curl);


}



function getIP(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}


function showResponse($response_code, $response_message){
	header('Content-Type: application/json');
	$responseArray = array(
		"code" => $response_code,
		"message" => $response_message
	);
	$responseArray = array("response" => $responseArray);
	return stripslashes( json_encode ($responseArray, 128) );
}

echo saveLeads($_POST,$_FILES); 

// mysqli_close($conn);
?>