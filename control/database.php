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
    
        function getGroupnameByUsername($username){
            $db = getDatabase();
            return $db->query("SELECT g.name AS gruppenname FROM gruppe AS g
                INNER JOIN benutzer_gruppe AS bg ON g.id_gruppe=bg.gruppe_id
                INNER JOIN benutzer AS b ON bg.benutzer_id=b.id_benutzer
                WHERE b.benutzername = '" . $username . "'");
            $db->close();
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
    
        function insertUser($username, $password, $name, $prename){
            $db = getDatabase();
            $hash = hash('sha256', $password . $username);
            $preparedquery = $db->prepare("INSERT INTO BENUTZER (id_benutzer, benutzername, passwort, name, vorname) VALUES (NULL,?,?,?,?)");
            $preparedquery->bind_param("ssss", $username, $hash, $name, $prename);
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
    
        function deleteUserGroup($groupid, $userid){
            $db = getDatabase();
            $sql = "DELETE FROM BENUTZER_GRUPPE WHERE gruppe_id = '$groupid' AND benutzer_id = '$userid'";
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
?>