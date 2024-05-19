<?php

class Team extends model {
  public function getAll($options)
  {
    $arr = [];
    $columns = ['photo', 'name', 'profession', 'id'];

    $sql = 'SELECT * FROM team';

    if (!empty($options['search']['value'])) {
      $sql .= ' WHERE name LIKE "%' . $options['search']['value'] . '%"';
      $sql .= ' OR profession LIKE "%' . $options['search']['value'] . '%"';
    }

    if (isset($options['order']) && !empty($options['order'])) {
      $sql .= ' ORDER BY ' . $columns[$options['order'][0]['column']] . ' ' . strtoupper($options['order'][0]['dir']);
    } else {
      $sql .= ' ORDER BY ' . $columns[0] . ' ASC';
    }

    if (!empty($limit) && !empty($page)) {
      $sql .= ' LIMIT ' . $options['start'] * $options['length'] . ', ' . $options['length'];
    }

    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function getCount($search = '')
  {
    $arr = [];

    $sql = 'SELECT COUNT(id) AS qtd_team FROM team';

    if (!empty($search)) {
      $sql .= ' WHERE name LIKE "%' . $search . '%"';
      $sql .= ' OR profession LIKE "%' . $search . '%"';
    }

    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function getAllNoneFilters()
  {
    $arr = [];

    $sql = 'SELECT * FROM team';
    $sql = $this->db->query($sql);
    
    if ($sql->rowCount() > 0) {
      $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function get($id)
  {
    $arr = [];

    $sql = 'SELECT * FROM team WHERE MD5(id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function set($photo, $name, $profession,)
  {
    $sql = 'INSERT INTO team SET photo = :photo, name = :name, profession = :profession';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':photo', $photo);
    $sql->bindValue(':name', $name);
    $sql->bindValue(':profession', $profession);
    $sql->execute();
  }

  public function up($id, $keys_body, $body)
  {
    $team = $this->get($id);
    $edit_params = [];

    if ($team !== []) {
      $sql = 'UPDATE team SET ';

      foreach($keys_body as $key_body) {
        $value = $body[$key_body];

        array_push($edit_params, $key_body . ' = "' . $value . '"');
      }

      $sql .= implode(', ', $edit_params) . ' WHERE MD5(id) = "' . md5($id) . '"';
      $this->db->query($sql);
    }
  }

  public function delete($id)
  {
    $person_team = $this->get($id);

    if ($person_team !== []) {
      $sql = 'DELETE FROM team WHERE MD5(id) = :id';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', md5($id));
      $sql->execute();
    }

    return $person_team;
  }
}
