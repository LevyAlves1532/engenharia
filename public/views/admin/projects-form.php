<?php

  if (!empty($project)) {
    $price = floatval(str_replace(',', '.', $project['price']));
    $discount_percent = intval(str_replace(',', '.', $project['discount_percent']));

    $discount = ($price * $discount_percent) / 100;
    $total_price = $price - $discount;
  }

?>

<main class="AdmProjectsForm">
  <div class="AdmBreadcrumbs mb-3">
    <a href="<?= BASE ?>admin/">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <a href="<?= BASE ?>admin/projects">Projetos</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <p>Formulário</p>
  </div>

  <div class="AdmHeaderPage mb-5">
    <div class="AdmHeaderPage__title">
      <h1><?= isset($project) ? 'Editar' : 'Adicionar' ?></h1>
    </div>
  </div>

  <form class="row g-3" id="projects-form">
  <?= (isset($project)) ? '<input type="hidden" name="ip" value="' . base64_encode($project['id']) . '" />' : '' ?>
    <div class="col-md-12">
      <label for="cover" class="form-label">Capa:</label>
      <input class="form-control" type="file" name="cover" id="cover">
      <div class="error"></div>
      <?= (isset($project) && !empty($project['cover'])) ? '<div class="form-text">' . $project['cover'] . '</div>' : '' ?>
    </div>
    <div class="col-md-12">
      <label for="cover" class="form-label">Carousel Imagens:</label>
      <input class="form-control" type="file" name="carousel[]" id="carousel" multiple>
      <div class="error"></div>
      <div class="files" id="files-carousel">
        <?php
          if (isset($project) && !empty($project['carousel'])):
            foreach ($project['carousel'] as $project_item):
              ?>
                <div class="form-text d-flex justify-content-between"><?= $project_item['image'] ?> <a href="<?= BASE ?>admin/projects/delete_carousel/<?= base64_encode($project_item['id']) ?>?ip=<?= $id ?>" class="text-danger">x</a></div>
              <?php
            endforeach;
          endif;
        ?>
      </div>
    </div>
    <div class="col-md-12">
      <label for="title" class="form-label">Título:</label>
      <input type="text" class="form-control" name="title" id="title" value="<?= (isset($project) && !empty($project['title'])) ? $project['title'] : '' ?>">
      <div class="error"></div>
    </div>
    <div class="col-md-12">
      <label for="title" class="form-label">Slug:</label>
      <input type="text" class="form-control" readonly name="slug" id="slug" value="<?= (isset($project) && !empty($project['slug'])) ? $project['slug'] : '' ?>">
      <div class="error"></div>
    </div>
    <div class="col-md-4">
      <label for="price" class="form-label">Preço:</label>
      <input type="text" class="form-control" name="price" id="price" value="<?= (isset($project) && !empty($project['price'])) ? str_replace('.', ',', $project['price']) : '' ?>">
      <div class="form-text total-value-show">Valor total <?= (!empty($project) && $discount > 0) ? 'R$' . number_format($total_price, 2, ',', '.') : 'R$0,00' ?></div>
      <div class="error"></div>
    </div>
    <div class="col-md-4">
      <label for="discount_percent" class="form-label">Desconto (%):</label>
      <input type="text" class="form-control" name="discount_percent" id="discount_percent" value="<?= (isset($project) && !empty($project['discount_percent'])) ? $project['discount_percent'] : '' ?>">
      <div class="form-text discount-show">Valor do desconto <?= (!empty($project) && $discount > 0) ? 'R$' . number_format($discount, 2, ',', '.') : 'R$0,00' ?></div>
      <div class="error"></div>
    </div>
    <div class="col-md-4 d-flex align-items-center pt-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="is_discount" id="is_discount" <?= (isset($project) && !empty($project['is_discount'])) ? 'checked' : '' ?>>
        <label class="form-check-label" for="is_discount">
          Aplicar desconto?
        </label>
      </div>
    </div>
    <div class="col-md-12">
      <label for="short_description" class="form-label">Pequena descrição:</label>
      <textarea class="form-control" name="short_description" id="short_description" rows="5"><?= (isset($project) && !empty($project['short_description'])) ? $project['short_description'] : '' ?></textarea>
      <div class="error"></div>
    </div>
    <div class="col-md-12">
      <label for="description" class="form-label">descrição:</label>
      <textarea class="form-control" name="description" id="description" rows="15"><?= (isset($project) && !empty($project['description'])) ? $project['description'] : '' ?></textarea>
      <div class="error"></div>
    </div>
    <div class="col-md-3">
      <label for="square_meters" class="form-label">Metros Quadrado:</label>
      <input type="text" class="form-control" name="square_meters" id="square_meters" value="<?= (isset($project) && !empty($project['square_meters'])) ? str_replace('.', ',', $project['square_meters']) : '' ?>">
      <div class="error"></div>
    </div>
    <div class="col-md-3">
      <label for="bathrooms" class="form-label">Banheiros:</label>
      <input type="number" class="form-control" name="bathrooms" id="bathrooms" value="<?= (isset($project) && !empty($project['bathrooms'])) ? $project['bathrooms'] : '' ?>">
      <div class="error"></div>
    </div>
    <div class="col-md-3">
      <label for="bedrooms" class="form-label">Quartos:</label>
      <input type="number" class="form-control" name="bedrooms" id="bedrooms" value="<?= (isset($project) && !empty($project['bedrooms'])) ? $project['bedrooms'] : '' ?>">
      <div class="error"></div>
    </div>
    <div class="col-md-3">
      <label for="garages" class="form-label">Garagens:</label>
      <input type="number" class="form-control" name="garages" id="garages" value="<?= (isset($project) && !empty($project['garages'])) ? $project['garages'] : '' ?>">
      <div class="error"></div>
    </div>
    <div class="col-md-12">
      <label for="files_projects" class="form-label">Arquivos do Projeto:</label>
      <input class="form-control" type="file" name="files_projects[]" id="files_projects" multiple>
      <div class="error"></div>
      <div class="files" id="files-projects">
        <?php
          if (isset($project) && !empty($project['files_projects'])):
            foreach ($project['files_projects'] as $project_item):
              ?>
                <div class="form-text d-flex justify-content-between"><?= $project_item['file'] ?> <a href="<?= BASE ?>admin/projects/delete_file/<?= base64_encode($project_item['id']) ?>?ip=<?= $id ?>" class="text-danger">x</a></div>
              <?php
            endforeach;
          endif;
        ?>
      </div>
    </div>
    <div class="col-md-12 d-flex justify-content-end gap-3">
      <button type="submit" class="btn btn-outline-success"><?= (isset($project)) ? 'Editar o Projeto' : 'Adicionar o Projeto +' ?></button>
      <?= (isset($project)) ? '<a href="' . BASE . 'admin/projects/delete/' . $id . '" class="btn btn-outline-danger">Deletar o Projeto</a>' : '' ?>
    </div>
  </form>
</main>
