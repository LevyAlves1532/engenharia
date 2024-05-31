<?php

class PaymentProjects extends model {
  public function getAllFromPayment($id_payment)
  {
    $arr = [];

    $sql = 'SELECT projects.cover, projects.title, projects.slug, payment_projects.* FROM payment_projects INNER JOIN projects ON projects.id = payment_projects.id_project WHERE MD5(payment_projects.id_payment) = :id_payment';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_payment', md5($id_payment));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function set($id_payment, $id_project, $is_discount, $price, $discount_percent)
  {
    $sql = 'INSERT INTO payment_projects SET id_payment = :id_payment, id_project = :id_project, is_discount = :is_discount, price = :price, discount_percent = :discount_percent';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_payment', $id_payment);
    $sql->bindValue(':id_project', $id_project);
    $sql->bindValue(':is_discount', $is_discount);
    $sql->bindValue(':price', $price);
    $sql->bindValue(':discount_percent', $discount_percent);
    $sql->execute();
  }
}
