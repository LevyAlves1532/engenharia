<main class="AdmPostsInstagramForm">
  <div class="AdmBreadcrumbs mb-3">
    <a href="<?= BASE ?>admin/">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <a href="<?= BASE ?>admin/posts_instagram">Posts instagram</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <p>Formulário</p>
  </div>

  <div class="AdmHeaderPage mb-5">
    <div class="AdmHeaderPage__title">
      <h1><?= isset($post) ? 'Editar' : 'Adicionar' ?></h1>
    </div>
  </div>

  <form class="row g-3" id="posts-instagram-form">
    <?= (isset($post)) ? '<input type="hidden" name="ip" value="' . base64_encode($post['id']) . '" />' : '' ?>
    <div class="col-md-12">
      <label for="cover" class="form-label">Capa</label>
      <input class="form-control" type="file" name="cover" id="cover">
      <div class="error"></div>
      <?= (isset($post) && !empty($post['cover'])) ? '<div class="form-text">' . $post['cover'] . '</div>' : '' ?>
    </div>
    <div class="col-md-12">
      <label for="link" class="form-label">URL do Post:</label>
      <input type="text" class="form-control" name="link" id="link" value="<?= (isset($post) && !empty($post['link'])) ? $post['link'] : '' ?>">
      <div class="error"></div>
    </div>
    <div class="col-md-12 d-flex justify-content-end gap-3">
      <button type="submit" class="btn btn-outline-success"><?= (isset($post)) ? 'Editar o Post' : 'Adicionar o Post +' ?></button>
      <?= (isset($post)) ? '<a href="' . BASE . 'admin/posts_instagram/delete/' . base64_encode($post['id']) . '" class="btn btn-outline-danger">Deletar o Post</a>' : '' ?>
    </div>
  </form>
</main>
