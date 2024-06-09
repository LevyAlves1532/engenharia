<?php

  $total_value = 0;
  $mp_json = json_decode($payment['mp_json']);

?>

<main class="AdmPaymentsView">
  <div class="AdmBreadcrumbs mb-3">
    <a href="<?= BASE ?>admin/">Dashboard</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <a href="<?= BASE ?>admin/payments">Pagamentos</a>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
    <p>Visualizar</p>
  </div>

  <div class="AdmHeaderPage mb-5">
    <div class="AdmHeaderPage__title">
      <h1>Pagamento</h1>
      <h2>Nº do Pedido: <?= $mp_json->id ?></h2>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-<?= ($payment['installments'] !== 1) ? '4' : '6' ?>">
      <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">
          Valor Pago:
        </h4>
        <hr>
        <p>R$ <?= number_format($payment['total_value'], 2, ',', '.') ?></p>
      </div>
    </div>
    <div class="col-md-<?= ($payment['installments'] !== 1) ? '4' : '6' ?>">
      <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">
          Banco:
        </h4>
        <hr>
        <p><?= ucfirst($payment['card_bank']) ?></p>
      </div>
    </div>
    <?php if ($payment['installments'] !== 1): ?>
    <div class="col-md-<?= ($payment['installments'] !== 1) ? '4' : '6' ?>">
      <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">
          Parcelas:
        </h4>
        <hr>
        <p><?= $payment['installments'] ?>x (R$ <?= number_format($payment['installments_amount'], 2, ',', '.')  ?>)</p>
      </div>
    </div>
    <?php endif; ?>
  </div>

  <div>
  <table id="payments-table" class="table table-dark table-hover table-striped display">
    <thead>
        <tr>
          <th>Projeto</th>
          <th>Valor Total</th>
          <th>Status</th>
        </tr>
    </thead>
    <tbody>
      <?php if (count($payment['projects']) > 0): ?>
        <?php foreach ($payment['projects'] as $project): ?>
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
  </div>

  <p>Juros do Cartão:	R$ <?= number_format(($payment['total_value'] - $total_value), 2, ',', '.') ?> - <?= number_format((($payment['total_value'] - $total_value) * 100) / $total_value, 1, ',', '.') ?>%</p>

  <hr>

  <div class="AdmPaymentsInfoUser">
    <h2 class="mb-3">Informações do Usuário:</h2>
    
    <div class="row">
      <div class="col-md-6">
        <span>Nome:</span>
        <p><?= $payment['user']['name'] ?></p>
      </div>
      <div class="col-md-6">
        <span>E-mail:</span>
        <p><?= $payment['user']['email'] ?></p>
      </div>
    </div>
  </div>
</main>