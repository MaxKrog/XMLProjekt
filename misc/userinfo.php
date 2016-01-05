<?php

function userinfo(){

	$isLoggedIn = FALSE;
	
	echo("<userinfo>");
		if(isset($_COOKIE["username"]) AND isset($_COOKIE["role"])){
			echo("<authorized>true</authorized>");
			echo("<username>" . $_COOKIE["username"] . "</username>" );
			echo("<role>" . $_COOKIE["role"] . "</role>");

			$isLoggedIn = TRUE;
		} else {
			echo("<authorized>false</authorized>");
		}
	echo("</userinfo>");

	return $isLoggedIn;
}