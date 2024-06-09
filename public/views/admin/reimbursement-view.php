<?php

  $total_value = 0;
  $mp_json = json_decode($reimbursement['payment']['mp_json']);
  $reimbursement_class = new Reimbursement();
  
?>

<main class="AdmReimbursementView">
  <div class="AdmBreadcrumbs mb-3">
    <a href="<?= BASE ?>admin/">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <a href="<?= BASE ?>admin/reimbursement">Reembolsos</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <p>Visualizar</p>
  </div>

  <div class="AdmHeaderPage mb-5">
    <div class="AdmHeaderPage__title">
      <h1>Solicitação de Reembolso</h1>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Nome:</label>
    <input type="text" class="form-control" value="<?= $reimbursement['user']['name'] ?>" disabled>
  </div>
  <div class="mb-3">
    <label class="form-label">Telefone:</label>
    <input type="text" class="form-control" value="<?= $reimbursement['phone'] ?>" disabled>
  </div>
  <div class="mb-3">
    <label class="form-label">Motivo:</label>
    <textarea class="form-control" rows="10" disabled><?= $reimbursement['motive'] ?></textarea>
  </div>

  <hr>

  <div class="mb-3">
    <label class="form-label">Identificação da Compra (Mercado Pago):</label>
    <input type="text" class="form-control" value="<?= $mp_json->id ?>" disabled>
  </div>
  <div class="mb-3">
    <label class="form-label">Valor Total:</label>
    <input type="text" class="form-control" value="R$ <?= number_format($reimbursement['payment']['total_value'], 2, ',', '.') ?>" disabled>
  </div>
  <div class="mb-3">
    <table class="table table-dark table-hover table-striped display">
      <thead>
          <tr>
            <th>Projeto</th>
            <th>Valor Total</th>
            <th>Status</th>
          </tr>
      </thead>
      <tbody>
        <?php if (count($reimbursement['payment']['projects']) > 0): ?>
          <?php foreach ($reimbursement['payment']['projects'] as $project): ?>
            <tr>
              <td>
                <a href="<?= BASE ?>admin/projects/form/<?= base64_encode($project['id_project']) ?>"><?= $project['title'] ?></a>
              </td>
              <td>
                <?php
                  $price = 0;
                  
                  if ($project['is_discount'] === 1) {
                    $discount = ($project['price'] * $project['discount_percent']) / 100;
                    $price = $project['price'] - $discount;
                ?>
                  <p>R$ <?= number_format($price, 2, ',', '.') ?> - <strike><?= number_format($project['price'], 2, ',', '.') ?></strike></p>
                <?php 
                  } else { 
                    $price = $project['price'];
                ?>
                  <p>R$ <?= number_format($price, 2, ',', '.') ?></p>
                <?php 
                  } 

                  $total_value += $price;
                ?>
              </td>
              <td>
                <?= $project['is_download'] === 1 ? 'Fez download' : 'Não fez download' ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
      <tfoot>
          <tr>
            <th>Projeto</th>
            <th>Valor Total</th>
            <th>Status</th>
          </tr>
      </tfoot>
    </table>
    <p>Juros do Cartão:	R$ <?= number_format(($reimbursement['payment']['total_value'] - $total_value), 2, ',', '.') ?> - <?= number_format((($reimbursement['payment']['total_value'] - $total_value) * 100) / $total_value, 1, ',', '.') ?>%</p>
  </div>

  <hr>

  <form id="reimbursement-form">
    <input type="hidden" name="ir" value="<?= base64_encode($reimbursement['id']) ?>">
    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select class="form-select" name="status" id="status">
        <option disabled>Selecione um status...</option>
        <?php foreach ($reimbursement_class->getAllStatus() as $key => $status): ?>
          <option <?= $reimbursement['status'] === $status ? 'selected' : '' ?> value="<?= $key ?>"><?= $status ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="response" class="form-label">Resposta:</label>
      <textarea class="form-control" name="response" id="response" rows="10" placeholder="Responda a solicitação..."><?= !empty($reimbursement['response']) ? $reimbursement['response'] : '' ?></textarea>
      <div class="error"></div>
    </div>
    <div class="mb-3">
      <p>O processo de reembolso é feito em dentro do mercado pago, acesse sua conta e reembolse a partir da identificação da compra!</p>
    </div>
    <div class="d-flex justify-content-end gap-3">
      <button type="submit" class="btn btn-outline-success">Salvar</button>
    </div>
  </form>
</main>
