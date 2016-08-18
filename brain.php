<?php
// finds the keywords nad makes message smaller
function make_smaller($message){
	$KEYWORDS = ['when', 'where', 'how', 'what', 'name', 'club', 'csec', 'random', 'trivia', 'year', 'date', 'math'];
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
	elseif($message == 'random'){
		return file_get_contents('http://numbersapi.com/random/');
	}
	elseif(preg_match("/^(random (trivia|fact))$/", $message)){
		return file_get_contents('http://numbersapi.com/random/trivia');
	}
	elseif(preg_match("/^(random year( fact)?)$/", $message)){
		return file_get_contents('http://numbersapi.com/random/year');
	}
	elseif(preg_match("/^(random date( fact)?)$/", $message)){
		return file_get_contents('http://numbersapi.com/random/date');
	}
	elseif(preg_match("/^(random math( fact)?)$/", $message)){
		return file_get_contents('http://numbersapi.com/random/math');
	}
}
// Calls on the necessary functions to give the bot ability to think
function think($message){
	$answer = trim(make_smaller($message));
	$answer = check_cases($answer);
	
	return $answer;
}
?>