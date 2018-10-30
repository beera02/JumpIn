<h2>Steckbrief</h2>
<form id="form_filter" action="validate_steckbrief_order" method="post">
    <p id="p_steckbrief_filter">Filter</p>
	<select class="steckbrief_dropdown" name="gruppe">
        <option value="null">-</option>
        <?php
            if(!empty($_SESSION['groupselected'])){
                $groupid = $_SESSION['groupselected'];
            }
            else{
                $groupid = 0;
            }
            $groupselected = 0;
            $groups = getAllGroups();
            $notGroupGroups = $_SESSION['notGroupGroups'];
            while($row = mysqli_fetch_assoc($groups)){
                if(!in_array(strtolower($row['name']), $notGroupGroups)){
                    if($groupid == $row['id_gruppe']){
                        $groupselected = $row['id_gruppe'];
                        echo '
                            <option value="'.$row['id_gruppe'].'" selected>'.$row['name'].'</option>
                        ';  
                    }
                    else{
                        echo '
                            <option value="'.$row['id_gruppe'].'">'.$row['name'].'</option>
                        ';
                    }
                }
            }
        ?>
    </select>
    <input id="button_filter" type="submit" name="submit_btn" value="Ändern">
</form>
<?php
    $user;
    if($groupselected == 0){
        $user = getAllUserOrdered();
    }
    else{
        $user = getUserByGroupID($groupselected);
    }
    $notUserUsers = $_SESSION['notUserUsers'];
    while($row = mysqli_fetch_assoc($user)){
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