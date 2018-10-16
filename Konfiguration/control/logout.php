<?php
    //session zerstören und zurück zur login seite gehen
    session_unset();
    session_destroy();
    header('Location: login');
?>