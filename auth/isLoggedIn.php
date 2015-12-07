<?php

function isLoggedIn() {
	if(isset($_COOKIE["username"])) {
		return TRUE;
	} else {
		return FALSE;
		
	}
}
