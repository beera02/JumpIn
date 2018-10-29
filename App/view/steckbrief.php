<h2>Steckbrief</h2>

<?php
    $alluser = getAllUserOrdered();
    $notUserUsers = $_SESSION['notUserUsers'];
    $notGroupGroups = $_SESSION['notGroupGroups'];
    while($row = mysqli_fetch_assoc($alluser)){
        if(!in_array(strtolower($row['benutzername']), $notUserUsers)){
            $resultarray = getGroupByUsernameAndLevel($row['benutzername']);
            echo '
                <form action="steckbrief_view" method="post">
                    <button class="button_steckbrief">
                        <div class="div_steckbrief_left">
                            <img class="img_steckbrief" src="data:image/jpeg;base64,'.base64_encode($row['bild']).'" alt="Profilbild"/>
                        </div>
                        <div class="div_steckbrief_right">
                            <p class="p_steckbrief_name">
                                    '.$row['vorname'].' '.$row['name'].'   
                            </p>
                            <p class="p_steckbrief_gruppe">
                                    '.$resultarray['name'].'
                            </p>
                        </div>
                    </button>
                    <input type="hidden" name="id" value="'.$row['id_benutzer'].'">
                </form>
            ';
        }
    }
?>