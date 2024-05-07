<main class="AdmFeedbacksForm">
  <div class="AdmBreadcrumbs mb-3">
    <a href="<?= BASE ?>admin/">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <a href="<?= BASE ?>admin/feedbacks">Feedbacks</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <p>Formulário</p>
  </div>

  <div class="AdmHeaderPage mb-5">
    <div class="AdmHeaderPage__title">
      <h1><?= isset($feedback) ? 'Editar' : 'Adicionar' ?></h1>
    </div>
  </div>

  <form class="row g-3">
    <div class="col-md-12">
      <label for="cover" class="form-label">Capa</label>
      <input class="form-control" type="file" id="cover">
      <?= (isset($feedback) && !empty($feedback['cover'])) ? '<div class="form-text">' . $feedback['cover'] . '</div>' : '' ?>
    </div>
    <div class="col-md-8">
      <label for="name" class="form-label">Nome:</label>
      <input type="text" class="form-control" id="name" value="<?= (isset($feedback) && !empty($feedback['name'])) ? $feedback['name'] : '' ?>">
    </div>
    <div class="col-md-4">
      <label for="assessment" class="form-label">Avaliação:</label>
      <input type="number" class="form-control" id="assessment" value="<?= (isset($feedback) && !empty($feedback['assessment'])) ? $feedback['assessment'] : '' ?>">
      <div class="form-text">De 0 a 5.</div>
    </div>
    <div class="col-md-12">
      <label for="short_description" class="form-label">Pequena descrição:</label>
      <textarea class="form-control" id="short_description" rows="5"><?= (isset($feedback) && !empty($feedback['short_description'])) ? $feedback['short_description'] : '' ?></textarea>
    </div>
    <div class="col-md-12 d-flex justify-content-end gap-3">
      <button type="button" class="btn btn-outline-success"><?= (isset($feedback)) ? 'Editar o Feedback' : 'Adicionar o Feedback +' ?></button>
      <?= (isset($feedback)) ? '<button type="button" class="btn btn-outline-danger">Deletar o Feedback</button>' : '' ?>
    </div>
  </form>
</main>
