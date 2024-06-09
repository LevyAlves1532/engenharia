<main class="WrapperReimbursement">
  <div class="WrapperReimbursement__container">
    <div class="ReimbursementTitle">
      <h1>Reembolso</h1>
    </div>

    <div class="Toggle ReimbursementToggle">
      <div class="Toggle__header">
        <p>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
          Formulário de Reembolso
        </p>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
      </div>

      <div class="Toggle__body">
        <div class="Toggle__body_content">
          <form id="form-reimbursement">
            <input type="hidden" name="ip" id="ip" value="<?= $id_project ?>" />
            <label class="Input">
              <span class="Input__label">Telefone:</span>
              <div class="Input__content">
                <div class="Input__content_icon">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                </div>
                <div class="Input__content_input">
                  <input type="text" name="phone" id="reimbursement-phone" placeholder="Digite seu telefone..." />
                </div>
              </div>
              <div class="Input__error error-reimbursement-phone"></div>
            </label>
            <label class="Textarea">
              <span class="Textarea__label">Motivo:</span>
              <div class="Textarea__content">
                <textarea name="motive" id="reimbursement-motive" placeholder="Informe o motivo do reembolso..."></textarea>
              </div>
              <div class="Textarea__error error-reimbursement-motive"></div>
            </label>

            <button class="Button">Solicitar Reembolso</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>