<?php

class Feedbacks extends model {
  public function getAll($options)
  {
    $arr = [];
    $columns = ['cover', 'name', 'assessment', 'id'];

    $sql = 'SELECT * FROM feedbacks';

    if (!empty($options['search']['value'])) {
      $sql .= ' WHERE name LIKE "%' . $options['search']['value'] . '%"';
      $sql .= ' OR assessment LIKE "%' . $options['search']['value'] . '%"';
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

    $sql = 'SELECT COUNT(id) AS qtd_feedbacks FROM feedbacks';

    if (!empty($search)) {
      $sql .= ' WHERE name LIKE "%' . $search . '%"';
      $sql .= ' OR assessment LIKE "%' . $search . '%"';
    }

    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function get($id)
  {
    $arr = [];

    $sql = 'SELECT * FROM feedbacks WHERE MD5(id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function set($cover, $name, $assessment, $short_description)
  {
    $sql = 'INSERT INTO feedbacks SET cover = :cover, name = :name, assessment = :assessment, short_description = :short_description';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':cover', $cover);
    $sql->bindValue(':name', $name);
    $sql->bindValue(':assessment', $assessment);
    $sql->bindValue(':short_description', $short_description);
    $sql->execute();
  }

  public function up($id, $keys_body, $body)
  {
    $feedback = $this->get($id);
    $edit_params = [];

    if ($feedback !== []) {
      $sql = 'UPDATE feedbacks SET ';

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
    $feedback = $this->get($id);

    if ($feedback !== []) {
      $sql = 'DELETE FROM feedbacks WHERE MD5(id) = :id';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', md5($id));
      $sql->execute();
    }

    return $feedback;
  }
}
