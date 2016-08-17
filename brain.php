<?php
// finds the keywords nad makes message smaller
function make_smaller($message){
	$KEYWORDS = ['when', 'where', 'how', 'what', 'name', 'club', 'csec'];
	$message = explode(" ", $message);
	
	foreach ($message as &$word){
		if (in_array($word, $KEYWORDS)){
			$result .= " $word";
		}
	}
	return $result;	
}
// matches the message with the appropriate question and displays answers
function check_cases($message){
	if ($message == 'what name club'){
		return 'The name of the club is Computer Science Enrichment Club (CSEC)';
	}
}
// Calls on the necessary functions to give the bot ability to think
function think($message){
	$answer = trim(make_smaller($message));
	$answer = check_cases($answer);
	
	return $answer;
}
?>