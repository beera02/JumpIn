<?php
    $validated = false;
    $_SESSION['error'] = NULL;

    if($_POST['submit_btn'] == "Anzeigen"){
        if(!empty($_POST['username'])){
            $user = getAllUser();
            while($row = mysqli_fetch_assoc($user)){
                if(strtolower($row['benutzername']) != "admin"){
                    if($row['benutzername'] == $_POST['username']){
                        $validated = true;
                    }
                }
            }
        }

        if($validated){
            $_SESSION['feedback_user'] = $_POST['username'];
            header('Location: feedback_statistics_user');
        }
        else{
            $_SESSION['error'] = "Dieser Benutzername existiert nicht!";
            header('Location: feedback_statistics');
        }   
    }
    else if($_POST['submit_btn'] == "Zurück"){
        header('Location: feedback');
    }

?>