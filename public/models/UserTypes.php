<?php

class UserTypes extends model {
  public function getAll()
  {
    $arr = [];

    $sql = 'SELECT * FROM user_types';
    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function get($id)
  {
    $arr = [];

    $sql = 'SELECT * FROM user_types WHERE MD5(id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }
}
