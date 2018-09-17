<?php
if($_SESSION['benutzer']){
    echo '
    <header>
        <img id="img_postlogo" src="./images/postlogo.png" alt="postlogo">
        <nav>
            <span class="span_headertitle">
                <a id="a_headertitle" href="logout">Logout</a>
            </span>
        </nav>
    </header>';
}
else{
    echo '
    <header>
        <img id="img_postlogo" src="./images/postlogo.png" alt="postlogo">
        <span class="div_headertitle">
            <p class="p_headertitle">
                Jump-In Konfiguration
            </p>
        </span>
    </header>';
}
?>