<main class="AdmProjectsForm">
  <div class="AdmBreadcrumbs mb-3">
    <a href="<?= BASE ?>admin/">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <a href="<?= BASE ?>admin/projects">Proejtos</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <p>Formulário</p>
  </div>

  <div class="AdmHeaderPage mb-5">
    <div class="AdmHeaderPage__title">
      <h1><?= isset($project) ? 'Editar' : 'Adicionar' ?></h1>
    </div>
  </div>

  <form class="row g-3">
    <div class="col-md-12">
      <label for="cover" class="form-label">Capa:</label>
      <input class="form-control" type="file" id="cover">
      <?= (isset($project) && !empty($project['cover'])) ? '<div class="form-text">' . $project['cover'] . '</div>' : '' ?>
    </div>
    <div class="col-md-12">
      <label for="cover" class="form-label">Carousel Imagens:</label>
      <input class="form-control" type="file" id="cover" multiple>
      <?php
        if (isset($project) && !empty($project['carousel'])):
          foreach ($project['carousel'] as $project_item):
            ?>
              <div class="form-text d-flex justify-content-between"><?= $project_item['image'] ?> <button>x</button></div>
            <?php
          endforeach;
        endif;
      ?>
    </div>
    <div class="col-md-12">
      <label for="title" class="form-label">Título:</label>
      <input type="text" class="form-control" id="title" value="<?= (isset($project) && !empty($project['title'])) ? $project['title'] : '' ?>">
    </div>
    <div class="col-md-4">
      <label for="price" class="form-label">Preço:</label>
      <input type="number" class="form-control" id="price" value="<?= (isset($project) && !empty($project['price'])) ? $project['price'] : '' ?>">
    </div>
    <div class="col-md-4">
      <label for="discount" class="form-label">Desconto (%):</label>
      <input type="number" class="form-control" id="discount" value="<?= (isset($project) && !empty($project['discount'])) ? $project['discount'] : '' ?>">
    </div>
    <div class="col-md-4 d-flex align-items-center pt-4">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="is_discount" <?= (isset($project) && !empty($project['is_discount'])) ? 'checked' : '' ?>>
        <label class="form-check-label" for="is_discount">
          Aplicar disconto?
        </label>
      </div>
    </div>
    <div class="col-md-12">
      <label for="short_description" class="form-label">Pequena descrição:</label>
      <textarea class="form-control" id="short_description" rows="5"><?= (isset($project) && !empty($project['short_description'])) ? $project['short_description'] : '' ?></textarea>
    </div>
    <div class="col-md-12">
      <label for="description" class="form-label">descrição:</label>
      <textarea class="form-control" id="description" rows="15"><?= (isset($project) && !empty($project['description'])) ? $project['description'] : '' ?></textarea>
    </div>
    <div class="col-md-3">
      <label for="square_meters" class="form-label">Metros Quadrado:</label>
      <input type="number" class="form-control" id="square_meters" value="<?= (isset($project) && !empty($project['square_meters'])) ? $project['square_meters'] : '' ?>">
    </div>
    <div class="col-md-3">
      <label for="bathrooms" class="form-label">Banheiros:</label>
      <input type="number" class="form-control" id="bathrooms" value="<?= (isset($project) && !empty($project['bathrooms'])) ? $project['bathrooms'] : '' ?>">
    </div>
    <div class="col-md-3">
      <label for="bedrooms" class="form-label">Quartos:</label>
      <input type="number" class="form-control" id="bedrooms" value="<?= (isset($project) && !empty($project['bedrooms'])) ? $project['bedrooms'] : '' ?>">
    </div>
    <div class="col-md-3">
      <label for="garages" class="form-label">Garagens:</label>
      <input type="number" class="form-control" id="garages" value="<?= (isset($project) && !empty($project['garages'])) ? $project['garages'] : '' ?>">
    </div>
    <div class="col-md-12">
      <label for="files_projects" class="form-label">Arquivos do Projeto:</label>
      <input class="form-control" type="file" id="files_projects" multiple>
      <?php
        if (isset($project) && !empty($project['files_projects'])):
          foreach ($project['files_projects'] as $project_item):
            ?>
              <div class="form-text d-flex justify-content-between"><?= $project_item['file'] ?> <button>x</button></div>
            <?php
          endforeach;
        endif;
      ?>
    </div>
    <div class="col-md-12 d-flex justify-content-end gap-3">
      <button type="button" class="btn btn-outline-success"><?= (isset($project)) ? 'Editar o Projeto' : 'Adicionar o Projeto +' ?></button>
      <?= (isset($project)) ? '<button type="button" class="btn btn-outline-danger">Deletar o Projeto</button>' : '' ?>
    </div>
  </form>
</main>
