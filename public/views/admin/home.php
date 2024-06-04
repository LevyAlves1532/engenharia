<main class="AdmDashboard">
  <div class="row mb-3">
    <div class="col-md-3">
      <div class="alert alert-dark" role="alert">
        <h4 class="alert-heading" style="text-align: center;">Projetos</h4>
        <hr>
        <p><?= $qtd_projects ?></p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="alert alert-dark" role="alert">
        <h4 class="alert-heading" style="text-align: center;">Time</h4>
        <hr>
        <p><?= $qtd_person_team ?></p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="alert alert-dark" role="alert">
        <h4 class="alert-heading" style="text-align: center;">Feedbacks</h4>
        <hr>
        <p><?= $qtd_feedbacks ?></p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="alert alert-dark" role="alert">
        <h4 class="alert-heading" style="text-align: center;">Posts</h4>
        <hr>
        <p><?= $qtd_posts ?></p>
      </div>
    </div>
  </div>

  <div class="alert alert-light" role="alert">
    <canvas id="myChart"></canvas>
  </div>
</main>