<?php

class ProjectFiles extends model {
  public function getAllFromIdProject($id_project)
  {
    $arr = [];

    $sql = 'SELECT * FROM project_files WHERE MD5(id_project) = :id_project';
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

    $sql = 'SELECT * FROM project_files WHERE MD5(id) = :id AND MD5(id_project) = :id_project';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->bindValue(':id_project', md5($id_project));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function set($id_project, $path_file)
  {
    $sql = 'INSERT INTO project_files SET id_project = :id_project, file = :path_file';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id_project', $id_project);
    $sql->bindValue(':path_file', $path_file);
    $sql->execute();

    return $this->db->lastInsertId();
  }

  public function delete($id, $id_project)
  {
    $project_file = $this->get($id, $id_project);

    if ($project_file !== []) {
      $sql = 'DELETE FROM project_files WHERE MD5(id) = :id AND MD5(id_project) = :id_project';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id', md5($id));
      $sql->bindValue(':id_project', md5($id_project));
      $sql->execute();
    }

    return $project_file;
  }

  public function deleteAll($id_project)
  {
    $project_files = $this->getAllFromIdProject($id_project);

    if ($project_files !== []) {
      $sql = 'DELETE FROM project_files WHERE MD5(id_project) = :id_project';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':id_project', md5($id_project));
      $sql->execute();
    }

    return $project_files;
  }
}
