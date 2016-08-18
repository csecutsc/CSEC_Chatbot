<?php
// hardcoded answers to questions
function hardcode($message){
	if ($message == 'hello' || $message == 'hi' || preg_match("/good (morning|evening)/", $message)){
		return 'Hi';
	}
	elseif (preg_match("/(what is )?name of (the )?club/", $message)){
		return 'The name of the club is Computer Science Enrichment Club (CSEC)';
	}
	elseif (preg_match("/^((good)?( )?(night|bye))/", $message)){
		return 'Goodbye. Have a nice day :)';
	}
	elseif (preg_match("/who is (the )?best/", $message)){
		return 'Prantar is the best';
	} 
	else{
		return false;
	}
}
?>