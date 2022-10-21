<?php

//require_once __DIR__ . '/init/db.php';
include "init/db.php";

// if pour la story 4
if (isset($_GET['username'])) {
    $search_username = $_GET['username'];
}

// Story 0: request to find all username
/*
$stmt = ... 
$stmt->execute();
$users = $stmt->fetchAll();
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <!-- Input Search -->
    <div></div>

    <!-- Table des Utilisateurs -->
    <div>
        <table>
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>password</th>
                <th>created_at</th>
                <th>updated_at</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
                
                

                for ($a = 0; $a < count($bd->getUsers()); $a++) { 
                    echo "<tr>";
                    for ($b = 0; $b < count($bd->getUsers()[$a]); $b++) {
                    echo "<td>" . $bd->getUsers()[$a][$b] . "</td>";
                    
                    }


                    echo "<form method = 'post'>";
                    echo "<td><button type=submit name ='delete' value=".$bd->getUsers()[$a][0].">Delete</button></td>";
                    echo "<td><button form ='post' name ='a'>Update</button></td>";
                    echo "</form>";
                    echo "</tr>";

                   
                }
                if(isset($_POST["delete"])){
                        
                    echo $_POST["delete"];
                }

            ?>


                
        </tbody>
        </table>

    </div>

       

    <form method="post" action="users.php">

        <input name="username" placeholder="username">
        <input name="password" placeholder="password">
        <button type="submit" name="create">Create</button>

    </form>


    <?php
        
        if(isset($_POST["create"])){
            if(!empty($_POST["username"]) && !empty($_POST["password"])){
                $bd ->addUser($_POST["username"], $_POST["password"]);
            }
            
        }   
        

    ?>
</body>
</html>