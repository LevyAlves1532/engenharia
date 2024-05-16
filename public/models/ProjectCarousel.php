<?php

class ProjectCarousel extends model {
  public function getAllFromIdProject($id_project)
  {
    $arr = [];

    $sql = 'SELECT * FROM project_carousel WHERE MD5(id_project) = :id_project';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_project', md5($id_project));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function get($id, $id_project)
  {
    $arr = [];

    $sql = 'SELECT * FROM project_carousel WHERE MD5(id) = :id AND MD5(id_project) = :id_project';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->bindValue(':id_project', md5($id_project));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function set($id_project, $path_image)
  {
    $sql = 'INSERT INTO project_carousel SET id_project = :id_project, image = :path_image';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_project', $id_project);
    $sql->bindValue(':path_image', $path_image);
    $sql->execute();

    return $this->db->lastInsertId();
  }

  public function delete($id, $id_project)
  {
    $project_carousel_item = $this->get($id, $id_project);

    if ($project_carousel_item !== []) {
      $sql = 'DELETE FROM project_carousel WHERE MD5(id) = :id AND MD5(id_project) = :id_project';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', md5($id));
      $sql->bindValue(':id_project', md5($id_project));
      $sql->execute();
    }

    return $project_carousel_item;
  }

  public function deleteAll($id_project)
  {
    $project_carousel = $this->getAllFromIdProject($id_project);

    if ($project_carousel !== []) {
      $sql = 'DELETE FROM project_carousel WHERE MD5(id_project) = :id_project';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id_project', md5($id_project));
      $sql->execute();
    }

    return $project_carousel;
  }
}
