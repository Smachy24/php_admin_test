<?php

// connexion a la DB
class BDD{

  private $connexion;
  private $listUsers;

  public function __construct(){
    $this -> connect();
    $this ->listUsers = [];
  }
  

  function getUsers(){
    return $this -> listUsers;
  }

  function connect(){
    
    try {
      if ($this->connexion === null) {
      
        $this -> connexion = new PDO('mysql:host=localhost;dbname=controle', 'root', '');
        $this -> connexion -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        }
      } 
    catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();

    }
  }

  function selectUsers(){
    $sql = "SELECT * FROM Users";
    $req = $this -> connexion -> prepare($sql);
    $req -> execute();
    $all = $req -> fetchAll();
    

    foreach($all as $row){
      $array = [$row['id'],$row['username'], $row['password'], $row['created_at'] , $row['updated_at']];
      array_push($this -> listUsers, $array);

    }
  }
  function deleteUser($id){
    $sql = "DELETE FROM Users WHERE id =".$id;
    $req = $this -> connexion -> prepare($sql);
    $req -> execute();
    $req -> fetchAll();
  }

  function addUser($username, $password){
    $sql = "INSERT INTO Users(username, password) VALUES(\"".$username."\",\"".$password."\")";
    $req = $this -> connexion -> prepare($sql);
    $req -> execute();
    $req -> fetchAll();
  }

}

// par défaut, les SELECT FROM  -> fetch et fetchAll recupere des tableaux associatifs
// possible de recup des objets en changeant PDO::FETCH_ASSOC par PDO::FETCH_OBJ



$bd = new Bdd();
$bd -> selectUsers();
