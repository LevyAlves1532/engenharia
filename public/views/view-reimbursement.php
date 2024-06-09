<main class="WrapperViewReimbursement">
  <div class="WrapperViewReimbursement__container">
    <div class="ViewReimbursementTitle">
      <h1>Solicitação de Reembolso</h1>
    </div>

    <div class="ViewReimbursementBody">
      <div class="ViewReimbursementBody__box">
        <div class="ViewReimbursementBody__box_status">
          <p>
            <?php if ($reimbursement['status'] === 'Aprovado'): ?>
              <span class="approved"></span>
            <?php else: ?>
              <span class="reproved"></span>
            <?php endif; ?>
            <?= $reimbursement['status'] ?>
          </p>
        </div>

        <div class="ViewReimbursementBody__box_response">
          <?php if (!empty($reimbursement['response'])): ?>
            <p><?= $reimbursement['response'] ?></p>
          <?php else: ?>
            <p>Não há nenhuma resposta!</p>
          <?php endif; ?>
        </div>
      </div>
      <p class="ViewReimbursementBody__text">Qualquer dúvida <a href="https://wa.me/47991966719" target="_blank">entre em contato, conosco!</a></p>
    </div>
  </div>
</main>