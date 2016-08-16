<?php
	// information from facebook
	$input = json_decode(file_get_contents('php://input'), true);

	// userID used to send back message
	$userID = $input['entry'][0]['messaging'][0]['sender']['id'];

	// user message
	$user_message = strtolower($input['entry'][0]['messaging'][0]['message']['text']);
	
	$token = "XXXXX_ENTER_REAL_TOKEN_HERE_XXXXX";

	$url = "https://graph.facebook.com/v2.6/me/messages?access_token=$token";

	// hardcoded answers
	include_once "fixedAnswer.php";
	$answer = hardcode($user_message);

	// give bot simple brain
	if ($answer == false){
		include_once "brain.php";
		$answer = think($user_message);
	}
	
	// information arranged to send back to facebook
	$jsonData = "{
		'recipient': {
			'id': $userID
		},
		'message': {
			'text': '$answer'
		}
	}";

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

	// bot ignores its own message therefore no infinite loops
	if(!empty($input['entry'][0]['messaging'][0]['message'])){
		curl_exec($ch);
	}
?>