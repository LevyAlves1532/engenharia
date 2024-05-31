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
              <div id="form-checkout__cardNumber" class="container"></div>
              <div id="form-checkout__expirationDate" class="container"></div>
              <div id="form-checkout__securityCode" class="container"></div>
              <input type="text" id="form-checkout__cardholderName" />
              <select id="form-checkout__issuer"></select>
              <select id="form-checkout__installments"></select>
              <select id="form-checkout__identificationType"></select>
              <input type="text" id="form-checkout__identificationNumber" />
              <input type="email" id="form-checkout__cardholderEmail" />

              <button type="submit" class="Button" id="form-checkout__submit">Finalizar Pagamento</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>