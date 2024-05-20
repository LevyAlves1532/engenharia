<?php

class Faq extends model {
  public function getAll($options)
  {
    $arr = [];
    $columns = ['question', 'id'];

    $sql = 'SELECT * FROM faq';

    if (!empty($options['search']['value'])) {
      $sql .= ' WHERE question LIKE "%' . $options['search']['value'] . '%"';
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

    $sql = 'SELECT COUNT(id) AS qtd_faq FROM faq';

    if (!empty($search)) {
      $sql .= ' WHERE question LIKE "%' . $search . '%"';
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

    $sql = 'SELECT * FROM faq ORDER BY created_at DESC';
    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function getTwo()
  {
    $arr = [];

    $sql = 'SELECT * FROM feedbacks ORDER BY created_at DESC LIMIT 2';
    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function get($id)
  {
    $arr = [];

    $sql = 'SELECT * FROM faq WHERE MD5(id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function set($question, $response)
  {
    $sql = 'INSERT INTO faq SET question = :question, response = :response';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':question', $question);
    $sql->bindValue(':response', $response);
    $sql->execute();
  }

  public function up($id, $keys_body, $body)
  {
    $faq = $this->get($id);
    $edit_params = [];

    if ($faq !== []) {
      $sql = 'UPDATE faq SET ';

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
      $sql = 'DELETE FROM faq WHERE MD5(id) = :id';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', md5($id));
      $sql->execute();
    }

    return $feedback;
  }
}
