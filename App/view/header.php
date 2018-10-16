<?php
if($_SESSION['benutzer']){
    echo '
    <header>
        <nav>
            <div id="div_header_logout">
                <a href="validate_logout">
                    <img class="img_header_login" src="./image/logout.png" alt="logout">
                </a>
            </div>
            <div class="div_nav_open">
                <span id="span_nav_logout_open">☰</span>
            </div>
        </nav>
    </header>
    <div class="div_header_two">
        <a href="home">
            <img class="img_header_two" src="./image/postlogo.png" alt="postlogo">
        </a>
    </div>';
}
else{
    echo '
    <header>
        <nav>
            <div id="div_header_login">
                <a href="login">
                    <img class="img_header_login" src="./image/login.png" alt="login">
                </a>
            </div>
            <div class="div_nav_open">
                <span id="span_nav_login_open">☰</span>
            </div>
        </nav>
    </header>
    <div class="div_header_two">
        <a href="home">
            <img class="img_header_two" src="./image/postlogo.png" alt="postlogo">
        </a>
    </div>';
}
?>