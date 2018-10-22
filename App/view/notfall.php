<h2>Notfallzettel</h2>
<table>
<?php
    $emergencies = getAllEmergencyCategories();
    while($row = mysqli_fetch_assoc($emergencies)){
        echo '
            <tr>
                <th>'.$row['name'].'</th>
                <th>'.$row['info'].'</th>
            </tr>
        ';
    }
?>
</table>