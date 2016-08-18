<?php
// hardcoded answers to questions
function hardcode($message){
	if ($message == 'hello' || $message == 'hi' || $message == 'good morning' || $message == 'good evening'){
		return 'Hi';
	}
	elseif ($message == 'what is name of the club' || strpos($message, 'name of club') || strpos($message, 'name of the club') || $message == 'name of club' || $message == 'name of the club'){
		return 'The name of the club is Computer Science Enrichment Club (CSEC)';
	}
	elseif ($message == 'good night' || $message == 'goodnight' || $message == 'good bye' || $message == 'goodbye' || $message == 'bye'){
		return 'Goodbye. Have a nice day :)';
	}
	elseif ($message == 'who is best' || $message == 'who is the best'){
		return 'Prantar is the best';
	} 
	else{
		return false;
	}
}
?>