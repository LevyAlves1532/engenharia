<?php

class Projects extends model {
  protected $is_active = [
    'Desativado',
    'Ativo',
  ];

  public function getIsActive($index)
  {
    return $this->is_active[$index];
  }

  public function getAll($options)
  {
    $arr = [];
    $columns = ['cover', 'title', 'price', 'is_active', 'id'];

    $sql = 'SELECT * FROM projects';

    if (!empty($options['search']['value'])) {
      $sql .= ' WHERE title LIKE "%' . $options['search']['value'] . '%"';
      $sql .= ' OR price LIKE "%' . $options['search']['value'] . '%"';
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

  public function getAllFilters($filters, $from_project, $limit)
  {
    $arr = [];

    $sql = 'SELECT * FROM projects';

    if (count($filters) > 0) {
      $sql .= ' WHERE ' . implode(' AND ', $filters);
    }
    $sql .= ' ORDER BY created_at DESC LIMIT ' . $from_project . ', ' . $limit;
    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function getCount($search = '')
  {
    $arr = [];

    $sql = 'SELECT COUNT(id) AS qtd_projects FROM projects';

    if (!empty($search)) {
      $sql .= ' WHERE title LIKE "%' . $search . '%"';
      $sql .= ' OR price LIKE "%' . $search . '%"';
    }

    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function getCountFilters($filters)
  {
    $arr = [];

    $sql = 'SELECT COUNT(id) AS qtd_projects FROM projects';

    if (count($filters) > 0) {
      $sql .= ' WHERE ' . implode(' AND ', $filters);
    }
    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr['qtd_projects'];
  }

  public function getThree()
  {
    $arr = [];

    $sql = 'SELECT * FROM projects ORDER BY created_at DESC LIMIT 3';
    $sql = $this->db->query($sql);
    
    if ($sql->rowCount() > 0) {
      $arr = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function get($id)
  {
    $arr = [];

    $sql = 'SELECT * FROM projects WHERE MD5(id) = :id';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', md5($id));
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);
    }

    return $arr;
  }

  public function getSlug($slug)
  {
    $arr = [];

    $project_carousel = new ProjectCarousel();

    $sql = 'SELECT * FROM projects  WHERE slug = :slug';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':slug', $slug);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $arr = $sql->fetch(PDO::FETCH_ASSOC);

      $arr['carousel'] = $project_carousel->getAllFromIdProject($arr['id']);
    }

    return $arr;
  }

  public function set($cover, $title, $slug, $price, $discount_percent, $short_description, $description, $square_meters, $bathrooms, $bedrooms, $garages, $is_discount = null)
  {
    $sql = 'INSERT INTO projects SET cover = :cover, title = :title, slug = :slug, price = :price, discount_percent = :discount_percent, short_description = :short_description, description = :description, square_meters = :square_meters, bathrooms = :bathrooms, bedrooms = :bedrooms, garages = :garages, is_discount = :is_discount';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':cover', $cover);
    $sql->bindValue(':title', $title);
    $sql->bindValue(':slug', $slug);
    $sql->bindValue(':price', $price);
    $sql->bindValue(':discount_percent', $discount_percent);
    $sql->bindValue(':short_description', $short_description);
    $sql->bindValue(':description', $description);
    $sql->bindValue(':square_meters', $square_meters);
    $sql->bindValue(':bathrooms', $bathrooms);
    $sql->bindValue(':bedrooms', $bedrooms);
    $sql->bindValue(':garages', $garages);
    $sql->bindValue(':is_discount', $is_discount ? 1 : 0);
    $sql->execute();

    return $this->db->lastInsertId();
  }

  public function up($id, $keys_body, $body)
  {
    $team = $this->get($id);
    $edit_params = [];

    if ($team !== []) {
      $sql = 'UPDATE projects SET ';

      foreach($keys_body as $key_body) {
        $value = $body[$key_body];

        array_push($edit_params, $key_body . ' = "' . $value . '"');
      }

      $sql .= implode(', ', $edit_params) . ' WHERE MD5(id) = "' . md5($id) . '"';

      $this->db->query($sql);
    }
  }

  public function toggle($id)
  {
    $project = $this->get($id);

    if ($project !== []) {
      $sql = 'UPDATE projects SET is_active = :is_active WHERE MD5(id) = :id';
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':is_active', $project['is_active'] === 1 ? 0 : 1);
      $sql->bindValue(':id', md5($id));
      $sql->execute();

      $project['is_active'] = $project['is_active'] === 1 ? 0 : 1;
    }

    return $project;
  }

  public function is_title($title)
  {
    $is = false;

    $sql = 'SELECT * FROM projects WHERE title = :title';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':title', $title);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $is = true;
    }

    return $is;
  }
}
