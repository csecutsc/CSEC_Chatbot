<!--
The MIT License (MIT)

Copyright (c) 2016 Prantar Bhowmik<prantarbhowmik@yahoo.com>

Permission is hereby granted, free of charge, to any person obtaining a
copy of this software and associated documentation files (the "Software"),
to deal in the Software without restriction, including without limitation
the rights to use, copy, modify, merge, publish, distribute, sublicense,
and/or sell copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.
 -->
<?php
	// information from facebook
	$input = json_decode(file_get_contents('php://input'), true);

	// userID used to send back message
	$userID = $input['entry'][0]['messaging'][0]['sender']['id'];

	// user message
	$user_message = strtolower($input['entry'][0]['messaging'][0]['message']['text']);
	
	// remove symbols
	$user_message = preg_replace('/[^\p{L}\p{N}\s]/u', '', $user_message);
	
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
	// for text output
	if ($user_message != 'show meme'){
		$jsonData = "{
			'recipient': {
				'id': $userID
			},
			'message': {
				'text': '$answer'
			}
		}";
	}
	// for pic output
	else{
		$jsonData = "{
			'recipient': {
				'id': $userID
			},
			'message': {
				'attachment':{
					'type': 'image',
					'payload': {
						'url': 'https://fast-sea-68862.herokuapp.com/image.jpg'
					}
				}
			}
		}";
	}

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

	// bot ignores its own message therefore no infinite loops
	if(!empty($input['entry'][0]['messaging'][0]['message'])){
		curl_exec($ch);
	}
?>
