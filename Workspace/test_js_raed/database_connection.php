<?php
    //Ouverture de la connexion à la base de données
    function database_open($adress, $user_name, $user_password, $database_name){
        $conn = new mysqli($adress, $user_name, $user_password, $database_name);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
        echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL . "</br>";
        return $conn;
    }
    
    //Fermeture de la connexion à la base de données
    function database_close($conn){
        mysqli_close($conn);
    }

    //selection de la table data
    function data_select($conn)
    {
        $sql = "SELECT * FROM data ORDER BY date DESC, time DESC LIMIT 20";
        $result = $conn->query($sql);
        
        $array = [];
        echo $result->num_rows;
        if ($result->num_rows > 0) {
            // output data of each row
            $i = 0;
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
               $array[$i] = $row;
               $i++;
            }
            return $array;
        } else {
            echo "0 results";
            return null;
        }
    }
?>