<main class="AdmTeamForm">
  <div class="AdmBreadcrumbs mb-3">
    <a href="<?= BASE ?>admin/">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <a href="<?= BASE ?>admin/team">Time</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <p>Formulário</p>
  </div>

  <div class="AdmHeaderPage mb-5">
    <div class="AdmHeaderPage__title">
      <h1>Adicionar</h1>
    </div>
  </div>

  <form class="row g-3">
    <div class="col-md-12">
      <label for="photo" class="form-label">Foto</label>
      <input class="form-control" type="file" id="photo">
    </div>
    <div class="col-md-6">
      <label for="name" class="form-label">Nome:</label>
      <input type="text" class="form-control" id="name">
    </div>
    <div class="col-md-6">
      <label for="profession" class="form-label">Profissão</label>
      <input type="text" class="form-control" id="profession">
    </div>
    <div class="col-md-12 d-flex justify-content-end">
      <button type="button" class="btn btn-outline-success">Adicionar ao Time +</button>
    </div>
  </form>
</main>