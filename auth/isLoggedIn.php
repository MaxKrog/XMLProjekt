<?php

function isLoggedIn() {
	if(isset($_COOKIE["username"])) {
		return "true";
	} else {
		return "false";
		
	}
}

echo(isLoggedIn());
