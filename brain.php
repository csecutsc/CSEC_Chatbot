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
// finds the keywords nad makes message smaller
function make_smaller($message){
	$KEYWORDS = ['when', 'where', 'how', 'what', 'name', 'club', 'csec', 'random', 'trivia', 'year', 'date', 'math'];
	$message = explode(" ", $message);
	$result = '';
	
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
	elseif (preg_match("/(when|where)( when| where)? (csec|club)/", $message)){
		return 'CSEC is held in IC 402 weekly at Friday 4 PM to 6 PM. Unless university is closed';
	}
	elseif (preg_match("/what csec/", $message)){
		return 'CSEC is a student-run group that focuses on helping students with a passion for Computer Science to take the next steps in their career. We focus on teaching the basics of competitive programming, introducing coding competitions and hackathons to students';
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
