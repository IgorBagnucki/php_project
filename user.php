<?php

include 'database.php';

session_start();

class User {
  private $id;
  private $nick;
  private $passwordHash;

  private $loggedIn = false;

  public function login($nick, $password) {
    if($loggedIn) {
      return;
    }
    $userData = Database::getUserByNick($nick);
    if($userData === NULL) {
      return;
    }
    $this->id = $userData->id();
    $this->nick = $userData->nick();
    $this->passwordHash = $userData->passwordHash();
    $_SESSION['user'] = $this;
  }

  public function register($nick, $password) {
    if($loggedIn) {
      return;
    }
    $userData = Database::getUserByNick($nick);
    if($userData !== NULL) {
      return;
    }
    $this->nick = $nick;
    $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $this->id = Database::addUser($this);
    User::login($nick, $password);
  }

  public function isLoggedIn() {
    return $this->loggedIn;
  }

  public function id() {
    return $this->id;
  }

  public function nick() {
    return $this->nick;
  }

  public function passwordHash() {
    return $this->passwordHash;
  }

  public function pickle() {
    return strval($this->id).", ".strval($this->nick).", ".strval($this->passwordHash);
  }

  public static function unpickle($packedUser) {
    $this->arrayedUser = str_getcsv($packedUser);
    $this->id = $arrayedUser[0];
    $this->nick = $arrayedUser[1];
    $this->passwordHash = $arrayedUser[2];
  }
}
?>
