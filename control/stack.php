<?php
	oneStackBack();

	function oneStackBack(){
        $stackstring = $_SESSION['stack'];
        $stackarray = explode("/",$stackstring);
		header('Location: '.$stackarray[count($stackarray) - 4].'');
    }
?>