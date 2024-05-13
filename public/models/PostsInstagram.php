<?php

class PostsInstagram extends model {
  public function getAll($options)
  {
    $arr = [];
    $columns = ['cover', 'link', 'id'];

    $sql = 'SELECT * FROM posts_instagram';

    if (!empty($options['search']['value'])) {
      $sql .= ' WHERE cover LIKE "%' . $options['search']['value'] . '%"';
      $sql .= ' OR link LIKE "%' . $options['search']['value'] . '%"';
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

    $sql = 'SELECT COUNT(id) AS qtd_posts FROM posts_instagram';

    if (!empty($search)) {
      $sql .= ' WHERE cover LIKE "%' . $search . '%"';
      $sql .= ' OR link LIKE "%' . $search . '%"';
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

    $sql = 'SELECT * FROM posts_instagram WHERE MD5(id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function set($cover, $link)
  {
    $sql = 'INSERT INTO posts_instagram SET cover = :cover, link = :link';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':cover', $cover);
    $sql->bindValue(':link', $link);
    $sql->execute();
  }

  public function up($id, $keys_body, $body)
  {
    $team = $this->get($id);
    $edit_params = [];

    if ($team !== []) {
      $sql = 'UPDATE posts_instagram SET ';

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
      $sql = 'DELETE FROM posts_instagram WHERE MD5(id) = :id';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', md5($id));
      $sql->execute();
    }

    return $person_team;
  }
}
