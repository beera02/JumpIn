<?php
    $_SESSION['error'] = NULL;
    session_unset();
    session_destroy();
    header('Location: home');
?>