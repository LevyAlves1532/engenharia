<?php

class Payments extends model {
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
}
