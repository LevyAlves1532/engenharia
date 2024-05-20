<main class="AdmFAQForm">
  <div class="AdmBreadcrumbs mb-3">
    <a href="<?= BASE ?>admin/">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <a href="<?= BASE ?>admin/faq">FAQ</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <p>Formulário</p>
  </div>

  <div class="AdmHeaderPage mb-3">
    <div class="AdmHeaderPage__title">
      <h1><?= isset($faq) ? 'Editar' : 'Adicionar' ?></h1>
    </div>
  </div>

  <form class="row g-3" id="faq-form">
    <?= (isset($faq)) ? '<input type="hidden" name="if" value="' . base64_encode($faq['id']) . '" />' : '' ?>
    <div class="col-md-12">
      <label for="question" class="form-label">Pergunta:</label>
      <input type="text" class="form-control" name="question" id="question" value="<?= (isset($faq) && !empty($faq['question'])) ? $faq['question'] : '' ?>">
      <div class="error"></div>
    </div>
    <div class="col-md-12">
      <label for="response" class="form-label">Resposta:</label>
      <textarea name="response" id="response"><?= (isset($faq) && !empty($faq['response'])) ? $faq['response'] : '' ?></textarea>
      <div class="error"></div>
    </div>
    <div class="col-md-12 d-flex justify-content-end gap-3">
      <button type="submit" class="btn btn-outline-success"><?= (isset($faq)) ? 'Editar o Pergunta' : 'Adicionar o Pergunta +' ?></button>
      <?= (isset($faq)) ? '<a href="' . BASE . 'admin/faq/delete/' . base64_encode($faq['id']) . '" class="btn btn-outline-danger">Deletar o Feedback</a>' : '' ?>
    </div>
  </form>
</main>
