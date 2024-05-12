<?php

class Users extends model {
  public function getAll($options)
  {
    $arr = [];
    $columns = ['users.name', 'users.email', 'type', 'users.id'];

    $sql = 'SELECT users.*, user_types.name as type FROM users INNER JOIN user_types ON user_types.id = users.id_user_type';

    if (!empty($options['search']['value'])) {
      $sql .= ' WHERE users.name LIKE "%' . $options['search']['value'] . '%"';
      $sql .= ' OR users.email LIKE "%' . $options['search']['value'] . '%"';
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

    $sql = 'SELECT COUNT(id) AS qtd_users FROM users';

    if (!empty($search)) {
      $sql .= ' WHERE name LIKE "%' . $search . '%"';
      $sql .= ' OR email LIKE "%' . $search . '%"';
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

    $sql = 'SELECT users.*, user_types.name AS type FROM users INNER JOIN user_types ON user_types.id = users.id_user_type WHERE MD5(users.id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function set($name, $email, $password, $id_user_type, $is_confirm)
  {
    $user_types = new UserTypes();
    $user_type_data = $user_types->get($id_user_type);

    if (!$this->is_email($email) && $user_type_data !== []) {
      $sql = 'INSERT INTO users SET name = :name, email = :email, password = :password, id_user_type = :id_user_type, is_confirm = :is_confirm';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':name', $name);
      $sql->bindValue(':email', $email);
      $sql->bindValue(':password', md5($password));
      $sql->bindValue(':id_user_type', $user_type_data['id']);
      $sql->bindValue(':is_confirm', $is_confirm);
      $sql->execute();
    }
  }

  public function up($id, $keys_body, $body)
  {
    $user = $this->get($id);
    $edit_params = [];

    if ($user !== []) {
      $sql = 'UPDATE users SET ';

      foreach($keys_body as $key_body) {
        $value = $body[$key_body];

        if ($key_body === 'user_type') {
          $value = addslashes(base64_decode($body[$key_body]));
        } 

        array_push($edit_params, $key_body . ' = "' . $value . '"');
      }

      $sql .= implode(', ', $edit_params) . ' WHERE MD5(id) = "' . md5($id) . '"';
      $this->db->query($sql);
    }
  }

  public function delete($id)
  {
    $user = $this->get($id);

    if ($user !== []) {
      $sql = 'DELETE FROM users WHERE MD5(id) = :id';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', md5($id));
      $sql->execute();
    }
  }

  public function is_email($email)
  {
    $is = false;

    $sql = 'SELECT * FROM users WHERE email = :email';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':email', $email);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $is = true;
    }

    return $is;
  }
}
