<?php

include 'user.php';

class Database {
  public static function addUser($user) {

  }

  public static function getUserByNick($nick) {
    $foundUser = NULL;
    if(($handle = fopen("users.csv", "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $num = count($data);
          if($data[1] == $nick) {
            $foundUser = pack;
            break;
          }
      }
      fclose($handle);
    }
    if($foundUser === NULL) {
      return NULL;
    }
    $foundUserInstance = new User;
    $foundUserInstance->unpickle($foundUser);
    return $foundUserInstance;
  }
}

?>
