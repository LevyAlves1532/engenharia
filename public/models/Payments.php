<?php

class Payments extends model {
  public function getAll($options)
  {
    $arr = [];
    $columns = ['users.name', 'payments.card_bank', 'payments.total_value', 'payments.id'];

    $sql = 'SELECT users.name, payments.* FROM payments INNER JOIN users ON users.id = payments.id_user';

    if (!empty($options['search']['value'])) {
      $sql .= ' WHERE users.name LIKE "%' . $options['search']['value'] . '%"';
      $sql .= ' OR payments.card_bank LIKE "%' . $options['search']['value'] . '%"';
      $sql .= ' OR payments.total_value >= ' . floatval(str_replace($options['search']['value'], ',', '.'));
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

    $sql = 'SELECT COUNT(payments.id) AS qtd_payments FROM payments INNER JOIN users ON users.id = payments.id_user';

    if (!empty($search)) {
      $sql .= ' WHERE users.name LIKE "%' . $options['search']['value'] . '%"';
      $sql .= ' OR payments.card_bank LIKE "%' . $options['search']['value'] . '%"';
      $sql .= ' OR payments.total_value >= ' . floatval(str_replace($options['search']['value'], ',', '.'));
    }

    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function getAllFromIdUser($id_user)
  {
    $payment_projects = new PaymentProjects();

    $arr = [];

    $sql = 'SELECT * FROM payments WHERE MD5(id_user) = :id_user ORDER BY created_at DESC';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_user', md5($id_user));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
      
      for ($x=0;$x<count($arr);$x++) {
        $arr[$x]['projects'] = $payment_projects->getAllFromPayment($arr[$x]['id']);
      }
    }

    return $arr;
  }

  public function get($id)
  {
    $arr = [];

    $users = new Users();
    $payment_projects = new PaymentProjects();

    $sql = 'SELECT users.name, users.email, payments.* FROM payments INNER JOIN users ON users.id = payments.id_user WHERE MD5(payments.id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);

      $arr['projects'] = $payment_projects->getAllFromPayment($arr['id']);
      $arr['user'] = $users->get($arr['id_user']);
    }

    return $arr;
  }

  public function getProfitMonth($month)
  {
    $arr = [];

    $reimbursement = new Reimbursement();

    $sql = 'SELECT SUM(payments.total_value) as profit_month FROM payments WHERE MONTH(payments.created_at) = :month AND payments.status = "approved"';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':month', $month);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function set($id_user, $card_number, $card_name, $card_bank, $email, $installments, $installments_amount, $total_value, $status, $mp_json)
  {
    $sql = 'INSERT INTO payments SET id_user = :id_user, card_number = :card_number, card_name = :card_name, card_bank = :card_bank, email = :email, installments = :installments, installments_amount = :installments_amount, total_value = :total_value, status = :status, mp_json = :mp_json';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_user', $id_user);
    $sql->bindValue(':card_number', $card_number);
    $sql->bindValue(':card_name', $card_name);
    $sql->bindValue(':card_bank', $card_bank);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':installments', $installments);
    $sql->bindValue(':installments_amount', $installments_amount);
    $sql->bindValue(':total_value', $total_value);
    $sql->bindValue(':status', $status);
    $sql->bindValue(':mp_json', $mp_json);
    $sql->execute();

    return $this->db->lastInsertId();
  }

  public function up($status, $id)
  {
    $sql = 'UPDATE payments SET status = :status WHERE MD5(id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':status', $status);
    $sql->bindValue(':id', md5($id));
    $sql->execute();
  }
}
