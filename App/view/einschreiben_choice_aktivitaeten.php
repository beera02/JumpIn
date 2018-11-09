<?php
    if(!empty($_POST['id'])){
        echo '
            <h2>Aktivitäten zum einschreiben</h2>
            <p class="p_untertitel">Hier kannst du dich in eine Aktivität des Aktivitätblockes <b>'.getActivityentityNameByID($_POST['id']).'</b> einschreiben.</p>
        ';

        $activities = getActivityByActivityentityID($_POST['id']);
        while($row = mysqli_fetch_assoc($activities)){
            if(strtotime($row['startzeit']) - strtotime(date("Y-m-d H:i:s")) >= 0){
                echo '
                    <form action="einschreiben" method="post">
                        <button class="button_steckbrief">
                            <div class="div_einschreiben">
                                <p class="p_steckbrief_name">
                                        '.$row['aktivitaetsname'].'   
                                </p>
                                <p class="p_steckbrief_gruppe">
                                    '.getDateString($row['startzeit']).' '.getHours($row['startzeit']).' - '.getHours($row['endzeit']).'
                                </p>
                            </div>
                        </button>
                        <input type="hidden" name="id" value="'.$row['id_aktivitaet'].'">
                    </form>
                ';
            }
        }
    }
    else{
        header('Location: home');
    }



?>