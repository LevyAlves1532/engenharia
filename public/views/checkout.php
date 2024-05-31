<main class="WrapperCheckout">
  <div class="WrapperCheckout__container">
    <div class="CheckoutTitle">
      <h1>Escolha a Forma de Pagamento</h1>
    </div>

    <div class="CheckoutMethods">
      <div class="Toggle">
        <div class="Toggle__header">
          <p>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"/></svg>
            Cartão de Debito/Credito
          </p>

          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
        </div>

        <div class="Toggle__body">
          <div class="Toggle__body_content">
            <form id="form-checkout">
              <label class="Input">
                <span class="Input__label">Nº do Cartão</span>
                <div class="Input__content">
                  <div class="Input__content_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"/></svg>
                  </div>
                  <div class="Input__content_input">
                    <input type="text" name="cardNumber" id="form-checkout__cardNumber" placeholder="Digite o numero do cartão...">
                  </div>
                </div>
                <div class="Input__error error-checkout-card-number"></div>
              </label>

              <div class="InputDouble">
                <label class="Input">
                  <span class="Input__label">Data de Vencimento</span>
                  <div class="Input__content">
                    <div class="Input__content_icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z"/></svg>
                    </div>
                    <div class="Input__content_input">
                      <input type="text" name="cardExpirationYear"  id="form-checkout__expirationDate" placeholder="MM/YY" value="<?= $card['expirationYear'] ?>">
                    </div>
                  </div>
                  <div class="Input__error error-checkout-expiration-code"></div>
                </label>

                <label class="Input">
                  <span class="Input__label">Código de segurança</span>
                  <div class="Input__content">
                    <div class="Input__content_icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M192 32c17.7 0 32 14.3 32 32V199.5l111.5-66.9c15.2-9.1 34.8-4.2 43.9 11s4.2 34.8-11 43.9L254.2 256l114.3 68.6c15.2 9.1 20.1 28.7 11 43.9s-28.7 20.1-43.9 11L224 312.5V448c0 17.7-14.3 32-32 32s-32-14.3-32-32V312.5L48.5 379.4c-15.2 9.1-34.8 4.2-43.9-11s-4.2-34.8 11-43.9L129.8 256 15.5 187.4c-15.2-9.1-20.1-28.7-11-43.9s28.7-20.1 43.9-11L160 199.5V64c0-17.7 14.3-32 32-32z"/></svg>
                    </div>
                    <div class="Input__content_input">
                      <input type="text" name="cardSecurityCode"  id="form-checkout__securityCode" placeholder="Digite o código de segurança..." value="<?= $card['securityCode'] ?>">
                    </div>
                  </div>
                  <div class="Input__error error-checkout-security-code"></div>
                </label>
              </div>
              
              <label class="Input">
                <span class="Input__label">Titular do Cartão</span>
                <div class="Input__content">
                  <div class="Input__content_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
                  </div>
                  <div class="Input__content_input">
                    <input type="text" name="cardholderName"  id="form-checkout__cardholderName" placeholder="Digite o seu nome..." value="<?= $card['holderName'] ?>">
                  </div>
                </div>
                <div class="Input__error error-checkout-name"></div>
              </label>

              <div class="InputDouble">
                <label class="Select">
                  <span class="Select__label">Banco Emissor</span>
                  <div class="Select__content">
                    <div class="Select__content_select">
                      <select name="issuer" id="form-checkout__issuer"></select>
                    </div>
                    <div class="Select__content_checked">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                    </div>
                  </div>
                  <div class="Select__error error-checkout-issuer"></div>
                </label>

                <label class="Select">
                  <span class="Select__label">Parcelas</span>
                  <div class="Select__content">
                    <div class="Select__content_select">
                      <select name="installments" id="form-checkout__installments"></select>
                    </div>
                    <div class="Select__content_checked">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                    </div>
                  </div>
                  <div class="Select__error error-checkout-installments"></div>
                </label>
              </div>

              <label class="Select">
                <span class="Select__label">Tipo de Documento</span>
                <div class="Select__content">
                  <div class="Select__content_select">
                    <select name="identificationType" id="form-checkout__identificationType"></select>
                  </div>
                  <div class="Select__content_checked">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                  </div>
                </div>
                <div class="Select__error error-checkout-identification-type"></div>
              </label>

              <div class="InputDouble">
                <label class="Input">
                  <span class="Input__label">Número do documento</span>
                  <div class="Input__content">
                    <div class="Input__content_icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 256h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zm256-32H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                    </div>
                    <div class="Input__content_input">
                      <input type="text" name="identificationNumber" id="form-checkout__identificationNumber" placeholder="Digite seu CPF/CNPJ..." value="<?= $card['identificationNumber'] ?>" />
                    </div>
                  </div>
                  <div class="Input__error error-checkout-identification-number"></div>
                </label>
                
                <label class="Input">
                  <span class="Input__label">E-mail</span>
                  <div class="Input__content">
                    <div class="Input__content_icon">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg>
                    </div>
                    <div class="Input__content_input">
                      <input type="text" name="cardholderEmail" id="form-checkout__cardholderEmail" placeholder="Digite seu e-mail..." value="<?= $card['holderEmail'] ?>" />
                    </div>
                  </div>
                  <div class="Input__error error-checkout-cardholder-email"></div>
                </label>
              </div>

              <button type="submit" class="Button" id="form-checkout__submit">Finalizar Pagamento</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>