<?php
    	function getDatabase(){
            $db = array("localhost", "jumpin", "1234", "jumpin");
            return new Mysqli($db[0], $db[1], $db[2], $db[3]);
        }
        
        function getAllUser(){
            $db = getDatabase();
            $sql = ("SELECT * FROM BENUTZER");
            $result = $db->query($sql);
            $db->close();
            return $result; 
        }
    
        function getUserIDByUsername($username){
            $db = getDatabase();
            $sql = ("SELECT id_benutzer FROM BENUTZER WHERE benutzername = '$username' LIMIT 1");
            $resultat = $db->query($sql);
            $resultatarray = mysqli_fetch_assoc($resultat);
            $db->close();
            return $resultatarray['id_benutzer'];
        }
    
        function getPasswordByUsername($username){
            $db = getDatabase();
            $passwortabfrage = $db->query("SELECT passwort FROM BENUTZER
                WHERE benutzername = '$username' LIMIT 1");
            $passwortabfragearray = mysqli_fetch_assoc($passwortabfrage);
            $db->close();
            return $passwortabfragearray['passwort'];
        }
    
        function getUserByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM BENUTZER WHERE id_benutzer = '$id'");
            $userbyid = $db->query($sql);
            $datensatz = mysqli_fetch_assoc($userbyid);
            $db->close();
            return $datensatz;
        }
    
        function getUsernameByUsername($username){
            $db = getDatabase();
            $sql = ("SELECT benutzername FROM BENUTZER WHERE benutzername = '$username' LIMIT 1");
            $resultat = $db->query($sql);
            $resultatarray = mysqli_fetch_assoc($resultat);
            $resultatstring = $resultatarray['benutzername'];
            $db->close();
            return $resultatstring;
        }
    
        function getAllGroups(){
            $db = getDatabase();
            $gruppenabfrage = $db->query("SELECT * FROM GRUPPE");
            $db->close();
            return $gruppenabfrage;
        }

        function getGroupByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM GRUPPE WHERE id_gruppe = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }
        
        function getGroupnameByGroupname($groupname){
            $db = getDatabase();
            $sql = ("SELECT name FROM GRUPPE WHERE name = '$groupname' LIMIT 1");
            $resultat = $db->query($sql);
            $resultatarray = mysqli_fetch_assoc($resultat);
            $resultatstring = $resultatarray['name'];
            $db->close();
            return $resultatstring;
        }

        function getGroupnameByUsername($username){
            $db = getDatabase();
            return $db->query("SELECT g.name AS gruppenname FROM gruppe AS g
                INNER JOIN benutzer_gruppe AS bg ON g.id_gruppe=bg.gruppe_id
                INNER JOIN benutzer AS b ON bg.benutzer_id=b.id_benutzer
                WHERE b.benutzername = '" . $username . "'");
            $db->close();
        }
    
        function getGroupIDByName($name){
            $db = getDatabase();
            $sql = ("SELECT id_gruppe FROM GRUPPE WHERE name = '$name' LIMIT 1");
            $resultat = $db->query($sql);
            $resultatarray = mysqli_fetch_assoc($resultat);
            $db->close();
            return $resultatarray['id_gruppe'];
        }
    
        function getAllUserGroupsByUserID($userid){
            $db = getDatabase();
            $gruppenbenutzerabfrage = $db->query("SELECT * FROM BENUTZER_GRUPPE WHERE benutzer_id = '$userid'");
            $db->close();
            return $gruppenbenutzerabfrage;
        }

        function getArtnameByArtname($artname){
            $db = getDatabase();
            $sql = ("SELECT name FROM ART WHERE name = '$artname' LIMIT 1");
            $resultat = $db->query($sql);
            $resultatarray = mysqli_fetch_assoc($resultat);
            $resultatstring = $resultatarray['name'];
            $db->close();
            return $resultatstring;
        }

        function getAllArts(){
            $db = getDatabase();
            $artabfrage = $db->query("SELECT * FROM ART");
            $db->close();
            return $artabfrage;
        }

        function getArtByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM ART WHERE id_art = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }

        function getArtIDByName($name){
            $db = getDatabase();
            $sql = ("SELECT * FROM ART WHERE name = '$name'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray['id_art'];
        }

        function getArtNameByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM ART WHERE id_art = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray['name'];
        }

        function getAllActivitiesOrdered(){
            $db = getDatabase();
            $activityquery = $db->query("SELECT * FROM AKTIVITAET ORDER BY startzeit");
            $db->close();
            return $activityquery;
        }

        function getActivityByID($id){
            $db = getDatabase();
            $activityquery = $db->query("SELECT * FROM AKTIVITAET WHERE id_aktivitaet = '$id'");
            $resultarray = mysqli_fetch_assoc($activityquery);
            $db->close();
            return $resultarray;
        }

        function getAllActivityGroupsByActivityID($id){
            $db = getDatabase();
            $abfrage = $db->query("SELECT * FROM AKTIVITAET_GRUPPE WHERE aktivitaet_id = '$id'");
            $db->close();
            return $abfrage;
        }

        function getAllCharacteristicsCategories(){
            $db = getDatabase();
            $abfrage = $db->query("SELECT * FROM STECKBRIEFKATEGORIE");
            $db->close();
            return $abfrage;
        }

        function getCharacteristicsCategoryByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM STECKBRIEFKATEGORIE WHERE id_steckbriefkategorie = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }

        function getAllEmergencyCategories(){
            $db = getDatabase();
            $abfrage = $db->query("SELECT * FROM NOTFALLKATEGORIE");
            $db->close();
            return $abfrage;
        }

        function getEmergencyCategoryByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM NOTFALLKATEGORIE WHERE id_notfallkategorie = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }
    
        function insertUser($username, $password, $name, $prename){
            $db = getDatabase();
            $hash = hash('sha256', $password . $username);
            $preparedquery = $db->prepare("INSERT INTO BENUTZER (id_benutzer, benutzername, passwort, name, vorname) VALUES (NULL,?,?,?,?)");
            $preparedquery->bind_param("ssss", $username, $hash, $name, $prename);
            $preparedquery->execute();
            $db->close();
        }

        function insertGroup($groupname){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO GRUPPE (id_gruppe, name) VALUES (NULL,?)");
            $preparedquery->bind_param("s", $groupname);
            $preparedquery->execute();
            $db->close();
        }
    
        function insertUserGroup($groupid, $userid){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO BENUTZER_GRUPPE (gruppe_id,benutzer_id) VALUES (?,?)");
            $preparedquery->bind_param("ii", $groupid, $userid);
            $preparedquery->execute();
            $db->close();
        }

        function insertArt($artname){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO ART (id_art, name) VALUES (NULL,?)");
            $preparedquery->bind_param("s", $artname);
            $preparedquery->execute();
            $db->close();
        }

        function insertActivity($activityname, $artid, $meetpoint, $writein, $participants, $writetime, $starttime, $endtime, $info){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO aktivitaet (id_aktivitaet, aktivitaetsname, art_id, treffpunkt, einschreiben, anzahlteilnehmer, einschreibezeit, startzeit, endzeit, info) VALUES (NULL,?,?,?,?,?,?,?,?,?)");
            $preparedquery->bind_param("sisiissss", $activityname, $artid, $meetpoint, $writein, $participants, $writetime, $starttime, $endtime, $info);
            $preparedquery->execute();
            $_SESSION['activity_add'] = $db->insert_id;
            $db->close();
        }

        function insertActivityGroup($groupid, $activityid){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO AKTIVITAET_GRUPPE (gruppe_id,aktivitaet_id) VALUES (?,?)");
            $preparedquery->bind_param("ii", $groupid, $activityid);
            $preparedquery->execute();
            $db->close();
        }

        function insertCharacteristicsCategory($name, $obligate, $oneliner){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO STECKBRIEFKATEGORIE (id_steckbriefkategorie, name, obligation, einzeiler) VALUES (NULL,?,?,?)");
            $preparedquery->bind_param("sii", $name, $obligate, $oneliner);
            $preparedquery->execute();
            $db->close();
        }

        function insertEmergencyCategory($name, $info){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO NOTFALLKATEGORIE (id_notfallkategorie, name, info) VALUES (NULL,?,?)");
            $preparedquery->bind_param("ss", $name, $info);
            $preparedquery->execute();
            $db->close();
        }
    
        function deleteUserGroup($groupid, $userid){
            $db = getDatabase();
            $sql = "DELETE FROM BENUTZER_GRUPPE WHERE gruppe_id = '$groupid' AND benutzer_id = '$userid'";
            mysqli_query($db,$sql); 
            $db->close(); 
        }

        function deleteActivityGroup($groupid, $activityid){
            $db = getDatabase();
            $sql = "DELETE FROM AKTIVITAET_GRUPPE WHERE gruppe_id = '$groupid' AND aktivitaet_id = '$activityid'";
            mysqli_query($db,$sql); 
            $db->close(); 
        }
    
        function deleteUser($userid){
            $db = getDatabase();
            $sql = "DELETE FROM BENUTZER WHERE id_benutzer = '".$userid."'";
            mysqli_query($db,$sql);
            $db->close();
        }
    
        function updateUserByID($userid, $password, $username, $name, $prename){
            $db = getDatabase();
            $hash = hash('sha256', $password . $username);
            $preparedquery = $db->prepare("UPDATE BENUTZER SET benutzername = ?, passwort = ?, name = ?, vorname = ? WHERE id_benutzer = '$userid'");
            $preparedquery->bind_param("ssss", $username, $hash, $name, $prename);
            $preparedquery->execute();
            $db->close();
        }

        function updateGroupByID($groupid, $groupname){
            $db = getDatabase();
            $preparedquery = $db->prepare("UPDATE GRUPPE SET name = ? WHERE id_gruppe = '$groupid'");
            $preparedquery->bind_param("s", $groupname);
            $preparedquery->execute();
            $db->close();
        }

        function updateArtByID($artid, $artname){
            $db = getDatabase();
            $preparedquery = $db->prepare("UPDATE ART SET name = ? WHERE id_art = '$artid'");
            $preparedquery->bind_param("s", $artname);
            $preparedquery->execute();
            $db->close();
        }

        function updateActivity($activityid, $activityname, $artid, $meetpoint, $writein, $participants, $writetime, $starttime, $endtime, $info){
            $db = getDatabase();
            $preparedquery = $db->prepare("UPDATE aktivitaet SET aktivitaetsname = ?, art_id = ?, treffpunkt = ?, einschreiben = ?, anzahlteilnehmer = ?, einschreibezeit = ?, startzeit = ?, endzeit = ?, info = ? WHERE id_aktivitaet = '$activityid'");
            $preparedquery->bind_param("sisiissss", $activityname, $artid, $meetpoint, $writein, $participants, $writetime, $starttime, $endtime, $info);
            $preparedquery->execute();
            $db->close();
        }

        function updateCharacteristicsCategory($id, $name, $obligate, $oneliner){
            $db = getDatabase();
            $preparedquery = $db->prepare("UPDATE STECKBRIEFKATEGORIE SET name = ?, obligation = ?, einzeiler = ? WHERE id_steckbriefkategorie = '$id'");
            $preparedquery->bind_param("sii", $name, $obligate, $oneliner);
            $preparedquery->execute();
            $db->close();
        }

        function updateEmergencyCategory($id, $name, $info){
            $db = getDatabase();
            $preparedquery = $db->prepare("UPDATE NOTFALLKATEGORIE SET name = ?, info = ? WHERE id_notfallkategorie = '$id'");
            $preparedquery->bind_param("ss", $name, $info);
            $preparedquery->execute();
            $db->close();
        }

        function resetJumpin(){
            $db = getDatabase();
            $sql1 = "DELETE FROM GRUPPE WHERE name NOT IN ('admin','coach')";
            mysqli_query($db,$sql1);
            $sql2 = "DELETE FROM BENUTZER
                WHERE id_benutzer NOT IN(
                    SELECT benutzer_id from BENUTZER_GRUPPE
                    WHERE gruppe_id IN(
                        SELECT id_gruppe FROM GRUPPE
                        WHERE name IN ('coach','admin')
                    )
                )
            ;";
            mysqli_query($db,$sql2);
            $sql3 = "DELETE FROM AKTIVITAET";
            mysqli_query($db,$sql3);
            $db->close();
        }
        
?>