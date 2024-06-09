<?php

class Reimbursement extends model {
  protected $status = [
    'Em Processo',
    'Aprovado',
    'Rejeitado',
  ];

  public function getAllStatus()
  {
    return $this->status;
  }

  public function getStatus($status)
  {
    return $this->status[$status];
  }

  public function getAll($options)
  {
    $arr = [];
    $columns = ['users.name', 'reimbursement.phone', 'reimbursement.status', 'reimbursement.id'];

    $sql = 'SELECT reimbursement.*, users.name FROM reimbursement INNER JOIN users ON users.id = reimbursement.id_user';

    if (!empty($options['search']['value'])) {
      $sql .= ' WHERE users.name LIKE "%' . $options['search']['value'] . '%"';
      $sql .= ' OR reimbursement.phone LIKE "%' . $options['search']['value'] . '%"';
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

    $sql = 'SELECT COUNT(reimbursement.id) AS qtd_reimbursement FROM reimbursement INNER JOIN users ON users.id = reimbursement.id_user';

    if (!empty($search)) {
      $sql .= ' WHERE users.name LIKE "%' . $search . '%"';
      $sql .= ' OR reimbursement.phone LIKE "%' . $search . '%"';
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

    $users = new Users();
    $payments = new Payments();

    $sql = 'SELECT * FROM reimbursement WHERE MD5(id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);

      $arr['status'] = $this->getStatus($arr['status']);
      $arr['user'] = $users->get($arr['id_user']);
      $arr['payment'] = $payments->get($arr['id_payment']);
    }

    return $arr;
  }

  public function getFromIdUserAndIdPayment($id_user, $id_payment)
  {
    $arr = [];

    $sql = 'SELECT * FROM reimbursement WHERE MD5(id_user) = :id_user AND MD5(id_payment) = :id_payment';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_user', md5($id_user));
    $sql->bindValue(':id_payment', md5($id_payment));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);

      $arr['status'] = $this->getStatus($arr['status']);
    }

    return $arr;
  }

  public function set($id_user, $id_payment, $phone, $motive)
  {
    $sql = 'INSERT INTO reimbursement SET id_user = :id_user, id_payment = :id_payment, phone = :phone, motive = :motive';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_user', $id_user);
    $sql->bindValue(':id_payment', $id_payment);
    $sql->bindValue(':phone', $phone);
    $sql->bindValue(':motive', $motive);
    $sql->execute();
  }

  public function up($response, $status, $id)
  {
    $sql = 'UPDATE reimbursement SET response = :response, status = :status WHERE MD5(id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':response', $response);
    $sql->bindValue(':status', $status);
    $sql->bindValue(':id', md5($id));
    $sql->execute();
  }

  public function is_request($id_user, $id_payment)
  {
    $is = false;

    $sql = 'SELECT * FROM reimbursement WHERE MD5(id_user) = :id_user AND MD5(id_payment) = :id_payment';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_user', md5($id_user));
    $sql->bindValue(':id_payment', md5($id_payment));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $is = true;
    }

    return $is;
  }
}
