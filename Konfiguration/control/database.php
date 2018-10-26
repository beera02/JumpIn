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
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray['id_benutzer'];
        }
    
        function getPasswordByUsername($username){
            $db = getDatabase();
            $sql = ("SELECT passwort FROM BENUTZER WHERE benutzername = '$username' LIMIT 1");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray['passwort'];
        }
    
        function getUserByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM BENUTZER WHERE id_benutzer = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }

        function getUserprenameByUsername($username){
            $db = getDatabase();
            $sql = ("SELECT vorname FROM BENUTZER WHERE benutzername = '$username'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray['vorname'];
        }
    
        function getUsernameByUsername($username){
            $db = getDatabase();
            $sql = ("SELECT benutzername FROM BENUTZER WHERE benutzername = '$username' LIMIT 1");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $resultstring = $resultarray['benutzername'];
            $db->close();
            return $resultstring;
        }
    
        function getAllGroups(){
            $db = getDatabase();
            $sql = ("SELECT * FROM GRUPPE");
            $result = $db->query($sql);
            $db->close();
            return $result;
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
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $resultstring = $resultarray['name'];
            $db->close();
            return $resultstring;
        }

        function getGroupnameByUsername($username){
            $db = getDatabase();
            $sql = ("SELECT g.name AS gruppenname FROM gruppe AS g INNER JOIN benutzer_gruppe AS bg ON g.id_gruppe=bg.gruppe_id INNER JOIN benutzer AS b ON bg.benutzer_id=b.id_benutzer WHERE b.benutzername = '" . $username . "'");
            return $db->query($sql);
            $db->close();
        }
    
        function getGroupIDByName($name){
            $db = getDatabase();
            $sql = ("SELECT id_gruppe FROM GRUPPE WHERE name = '$name' LIMIT 1");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray['id_gruppe'];
        }
    
        function getAllUserGroupsByUserID($userid){
            $db = getDatabase();
            $sql = ("SELECT * FROM BENUTZER_GRUPPE WHERE benutzer_id = '$userid'");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getArtnameByArtname($artname){
            $db = getDatabase();
            $sql = ("SELECT name FROM ART WHERE name = '$artname' LIMIT 1");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $resultstring = $resultarray['name'];
            $db->close();
            return $resultstring;
        }

        function getAllArts(){
            $db = getDatabase();
            $sql = ("SELECT * FROM ART");
            $result = $db->query($sql);
            $db->close();
            return $result;
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

        function getArtByName($name){
            $db = getDatabase();
            $sql = ("SELECT * FROM ART WHERE name = '$name'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }

        function getAllActivitiesOrdered(){
            $db = getDatabase();
            $sql = ("SELECT * FROM AKTIVITAET ORDER BY startzeit");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getActivityByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM AKTIVITAET WHERE id_aktivitaet = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }

        function getActivityByActivityentityID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM AKTIVITAET WHERE aktivitaetblock_id = '$id'");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getAllActivityGroupsByActivityID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM AKTIVITAET_GRUPPE WHERE aktivitaet_id = '$id'");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getAllCharacteristicsCategories(){
            $db = getDatabase();
            $sql = ("SELECT * FROM STECKBRIEFKATEGORIE");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getCharacteristicsCategoryByObligation(){
            $db = getDatabase();
            $sql = ("SELECT * FROM STECKBRIEFKATEGORIE WHERE obligation = 1");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getCharacteristicsCategoriesByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM STECKBRIEFKATEGORIE WHERE id_steckbriefkategorie = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }

        function getCharacteristicsByUserID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM STECKBRIEF WHERE benutzer_id = '$id'");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getAllEmergencyCategories(){
            $db = getDatabase();
            $sql = ("SELECT * FROM NOTFALLKATEGORIE");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getEmergencyCategoryByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM NOTFALLKATEGORIE WHERE id_notfallkategorie = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }

        function getFeedbackCategoryByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM FEEDBACKKATEGORIE WHERE id_feedbackkategorie = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }

        function getAllFeedbackCategories(){
            $db = getDatabase();
            $sql = ("SELECT * FROM FEEDBACKKATEGORIE");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getAllOptionsByFeedbackID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM OPTIONEN WHERE feedbackkategorie_id = '$id'");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getAllActivityEntities(){
            $db = getDatabase();
            $sql = ("SELECT * FROM AKTIVITAETBLOCK");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getActivityentityByID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM AKTIVITAETBLOCK WHERE id_aktivitaetblock = '$id'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray;
        }

        function getActivityentityIDByName($name){
            $db = getDatabase();
            $sql = ("SELECT id_aktivitaetblock FROM AKTIVITAETBLOCK WHERE name = '$name'");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $db->close();
            return $resultarray['id_aktivitaetblock'];
        }

        function getActivityentitynameByName($name){
            $db = getDatabase();
            $sql = ("SELECT name FROM AKTIVITAETBLOCK WHERE name = '$name' LIMIT 1");
            $result = $db->query($sql);
            $resultarray = mysqli_fetch_assoc($result);
            $resultstring = $resultarray['name'];
            $db->close();
            return $resultstring;
        }

        function getActivityentitiesByArtID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM AKTIVITAETBLOCK WHERE art_id = '$id'");
            $result = $db->query($sql);
            $db->close();
            return $result;
        }

        function getCharacteristicsByObligationAndID($id){
            $db = getDatabase();
            $sql = ("SELECT * FROM steckbrief AS s JOIN steckbriefkategorie AS sk ON s.steckbriefkategorie_id = sk.id_steckbriefkategorie WHERE sk.obligation = '0' AND s.benutzer_id = '$id'");
            $result = $db->query($sql);
            $db->close();
            return $result;
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

        function insertArt($artname, $writein){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO ART (id_art, name, einschreiben) VALUES (NULL,?,?)");
            $preparedquery->bind_param("si", $artname, $writein);
            $preparedquery->execute();
            $db->close();
        }

        function insertActivity($activityname, $activityentityid, $artid, $meetpoint, $participants, $starttime, $endtime, $info){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO aktivitaet (id_aktivitaet, aktivitaetsname, aktivitaetblock_id, art_id, treffpunkt, anzahlteilnehmer, startzeit, endzeit, info) VALUES (NULL,?,?,?,?,?,?,?,?)");
            $preparedquery->bind_param("siisisss", $activityname, $activityentityid, $artid, $meetpoint, $participants, $starttime, $endtime, $info);
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
            return $db->insert_id;
            $db->close();
        }

        function insertEmergencyCategory($name, $info){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO NOTFALLKATEGORIE (id_notfallkategorie, name, info) VALUES (NULL,?,?)");
            $preparedquery->bind_param("ss", $name, $info);
            $preparedquery->execute();
            $db->close();
        }

        function insertFeedbackCategory($question, $options){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO FEEDBACKKATEGORIE (id_feedbackkategorie, frage, anzahloptionen) VALUES (NULL,?,?)");
            $preparedquery->bind_param("si", $question, $options);
            $preparedquery->execute();
            $_SESSION['feedback_add'] = $db->insert_id;
            $db->close();
        }

        function insertOption($id, $answer){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO OPTIONEN (id_optionen, feedbackkategorie_id, antwort) VALUES (NULL,?,?)");
            $preparedquery->bind_param("is", $id, $answer);
            $preparedquery->execute();
            $db->close();
        }

        function insertActivityentity($name, $artid, $writeintime){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO AKTIVITAETBLOCK (id_aktivitaetblock, name, art_id, einschreibezeit) VALUES (NULL,?,?,?)");
            $preparedquery->bind_param("sis", $name, $artid, $writeintime);
            $preparedquery->execute();
            $db->close();
        }

        function insertCharacteristics($characteristicsid, $userid, $answer){
            $db = getDatabase();
            $preparedquery = $db->prepare("INSERT INTO STECKBRIEF (steckbriefkategorie_id, benutzer_id, antwort) VALUES (?,?,?)");
            $preparedquery->bind_param("iis", $characteristicsid, $userid, $answer);
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

        function deleteAllOptionsByFeedbackID($id){
            $db = getDatabase();
            $sql = "DELETE FROM OPTIONEN WHERE feedbackkategorie_id = '$id'";
            mysqli_query($db,$sql);
            $db->close();
        }

        function deleteSteckbriefkategorieByID($id){
            $db = getDatabase();
            $sql = "DELETE FROM STECKBRIEFKATEGORIE WHERE id_steckbriefkategorie = '$id'";
            mysqli_query($db,$sql);
            $db->close();
        }

        function deleteEmergencyCategoryByID($id){
            $db = getDatabase();
            $sql = "DELETE FROM NOTFALLKATEGORIE WHERE id_notfallkategorie = '$id'";
            mysqli_query($db,$sql);
            $db->close();
        }

        function deleteGroupByID($id){
            $db = getDatabase();
            $sql = "DELETE FROM GRUPPE WHERE id_gruppe = '$id'";
            mysqli_query($db,$sql);
            $db->close();
        }

        function deleteFeedbackCategoryByID($id){
            $db = getDatabase();
            $sql = "DELETE FROM FEEDBACKKATEGORIE WHERE id_feedbackkategorie = '$id'";
            mysqli_query($db,$sql);
            $db->close();
        }

        function deleteArtByID($id){
            $db = getDatabase();
            $sql = "DELETE FROM ART WHERE id_art = '$id'";
            mysqli_query($db,$sql);
            $db->close();
        }

        function deleteActivityByID($id){
            $db = getDatabase();
            $sql = "DELETE FROM AKTIVITAET WHERE id_aktivitaet = '$id'";
            mysqli_query($db,$sql);
            $db->close();
        }

        function deleteActivityentityByID($id){
            $db = getDatabase();
            $sql = "DELETE FROM AKTIVITAETBLOCK WHERE id_aktivitaetblock = '$id'";
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

        function updateArtByID($artid, $artname, $writein){
            $db = getDatabase();
            $preparedquery = $db->prepare("UPDATE ART SET name = ?, einschreiben = ? WHERE id_art = '$artid'");
            $preparedquery->bind_param("si", $artname, $writein);
            $preparedquery->execute();
            $db->close();
        }

        function updateActivity($activityid, $activityname, $activityentityid, $artid, $meetpoint, $participants, $starttime, $endtime, $info){
            $db = getDatabase();
            $preparedquery = $db->prepare("UPDATE aktivitaet SET aktivitaetsname = ?, aktivitaetblock_id = ?, art_id = ?, treffpunkt = ?, anzahlteilnehmer = ?, startzeit = ?, endzeit = ?, info = ? WHERE id_aktivitaet = '$activityid'");
            $preparedquery->bind_param("siisisss", $activityname, $activityentityid, $artid, $meetpoint, $participants, $starttime, $endtime, $info);
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

        function updateFeedbackCategory($id, $question, $options){
            $db = getDatabase();
            $preparedquery = $db->prepare("UPDATE FEEDBACKKATEGORIE SET frage = ?, anzahloptionen = ? WHERE id_feedbackkategorie = '$id'");
            $preparedquery->bind_param("si", $question, $options);
            $preparedquery->execute();
            $db->close();
        }

        function updateActivityentity($id, $name, $artid, $writeintime){
            $db = getDatabase();
            $preparedquery = $db->prepare("UPDATE AKTIVITAETBLOCK SET name = ?, art_id = ?, einschreibezeit = ? WHERE id_aktivitaetblock = '$id'");
            $preparedquery->bind_param("sis", $name, $artid, $writeintime);
            $preparedquery->execute();
            $db->close();
        }

        function updateUserPictureByID($id, $image){
            $db = getDatabase();
            $preparedquery = $db->prepare("UPDATE BENUTZER SET bild = ? WHERE id_benutzer = '$id'");
            $null = NULL;
            $preparedquery->bind_param("b", $null);
            $preparedquery->send_long_data(0, $image);
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
            $sql4 = "DELETE FROM STECKBRIEFKATEGORIE WHERE obligation != 1";
            mysqli_query($db,$sql4);
            $db->close();
        }
        
?>