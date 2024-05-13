<main class="AdmUsersList">
  <div class="AdmBreadcrumbs mb-3">
    <a href="<?= BASE ?>admin/">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <p>Usuários</p>
  </div>

  <div class="AdmHeaderPage mb-3">
    <div class="AdmHeaderPage__title">
      <h1>Usuários</h1>
    </div>

    <div class="AdmHeaderPage__button">
      <a href="<?= BASE ?>admin/users/form" class="btn btn-outline-primary">Adicionar usuário +</a>
    </div>
  </div>

  <div class="AdmUsersTable">
    <table id="users-table" class="table table-dark table-hover table-striped display">
      <thead>
          <tr>
              <th>Name</th>
              <th>E-mail</th>
              <th>Tipo</th>
              <th>Ação</th>
          </tr>
      </thead>
      <tfoot>
          <tr>
              <th>Name</th>
              <th>E-mail</th>
              <th>Tipo</th>
              <th>Ação</th>
          </tr>
      </tfoot>
    </table>
  </div>
</main>
