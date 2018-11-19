<?php
	if(!empty($_SESSION['error'])){
		echo '
			<p class="p_error">'.$_SESSION['error'].'</p>
		';
	}
?>