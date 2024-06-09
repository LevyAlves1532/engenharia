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

  public function set($id_user, $id_payment, $id_project, $is_discount, $price, $discount_percent)
  {
    $sql = 'INSERT INTO payment_projects SET id_user = :id_user, id_payment = :id_payment, id_project = :id_project, is_discount = :is_discount, price = :price, discount_percent = :discount_percent';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_user', $id_user);
    $sql->bindValue(':id_payment', $id_payment);
    $sql->bindValue(':id_project', $id_project);
    $sql->bindValue(':is_discount', $is_discount);
    $sql->bindValue(':price', $price);
    $sql->bindValue(':discount_percent', $discount_percent);
    $sql->execute();
  }

  public function mark_download($id_user, $id_project)
  {
    $sql = 'UPDATE payment_projects SET is_download = :is_download WHERE MD5(id_user) = :id_user AND MD5(id_project) = :id_project';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':is_download', 1);
    $sql->bindValue(':id_user', md5($id_user));
    $sql->bindValue(':id_project', md5($id_project));
    $sql->execute();
  }

  public function is_buy($id_user, $id_project)
  {
    $is = false;

    $sql = 'SELECT * FROM payment_projects WHERE MD5(id_user) = :id_user AND MD5(id_project) = :id_project';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_user', md5($id_user));
    $sql->bindValue(':id_project', md5($id_project));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $is = true;
    }

    return $is;
  }
}
