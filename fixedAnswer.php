<?php
// hardcoded answers to questions
function hardcode($message){
	if ($message == 'hello' || $message == 'hi' || $message == 'hey' || preg_match("/good (morning|evening)/", $message)){
		return 'Hi';
	}
	elseif (preg_match("/(what is )?name of (the )?club/", $message)){
		return 'The name of the club is Computer Science Enrichment Club (CSEC)';
	}
	elseif (preg_match("/^((good)?( )?(night|bye))/", $message)){
		return 'Goodbye. Have a nice day :)';
	}
	elseif (preg_match("/(when|where)( and)?( when| where)? is csec/", $message)){
		return 'CSEC is held in IC 402 weekly at Friday 4 PM to 6 PM. Unless university is closed';
	}
	elseif (preg_match("/what is csec/", $message)){
		return 'CSEC is a student-run group that focuses on helping students with a passion for Computer Science to take the next steps in their career. We focus on teaching the basics of competitive programming, introducing coding competitions and hackathons to students';
	}
	elseif (preg_match("/who is (the )?best/", $message)){
		return 'Prantar is the best';
	}
	elseif(preg_match("/tell (me a )?joke/", $message)){
		$holder = json_decode(file_get_contents('http://api.icndb.com/jokes/random'), true);
		return $holder['value']['joke'];
	}
	elseif ($message == 'info'){
		return 'Version - 1.66. Last updated - Aug 30, 2016. Bot made by Prantar';
	}
	else{
		return false;
	}
}
?>