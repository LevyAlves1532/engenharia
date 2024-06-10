$(function() {
  if (window.location.href.indexOf('checkout') > -1) {
    const cart = new Cart();
    cart.init();

    const mp = new MercadoPago("TEST-06def6ed-a6ab-4458-8fc5-e85fc9561e8e");

    if (cart.cart.length === 0) window.location.href = BASE_URL + 'carrinho';

    const cardForm = mp.cardForm({
      amount: `${cart.total_value}`,
      iframe: false,
      form: {
        id: "form-checkout",
        cardNumber: {
          id: "form-checkout__cardNumber",
          placeholder: "Número do cartão",
        },
        expirationDate: {
          id: "form-checkout__expirationDate",
          placeholder: "MM/YY",
        },
        securityCode: {
          id: "form-checkout__securityCode",
          placeholder: "Código de segurança",
        },
        cardholderName: {
          id: "form-checkout__cardholderName",
          placeholder: "Titular do cartão",
        },
        issuer: {
          id: "form-checkout__issuer",
          placeholder: "Banco emissor",
        },
        installments: {
          id: "form-checkout__installments",
          placeholder: "Parcelas",
        },        
        identificationType: {
          id: "form-checkout__identificationType",
          placeholder: "Tipo de documento",
        },
        identificationNumber: {
          id: "form-checkout__identificationNumber",
          placeholder: "Número do documento",
        },
        cardholderEmail: {
          id: "form-checkout__cardholderEmail",
          placeholder: "E-mail",
        },
      },
      callbacks: {
        onFormMounted: error => {
          if (error) return console.warn("Form Mounted handling error: ", error);
          console.log("Form mounted");
        },
        onSubmit: event => {
          event.preventDefault();

          $('.FormButton__spinner').removeClass('FormButton__spinner--hidden');

          const {
            paymentMethodId: payment_method_id,
            issuerId: issuer_id,
            cardholderEmail: email,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
          } = cardForm.getCardFormData();

          const formData = new FormData();
          formData.append('token', token);
          formData.append('issuer_id', issuer_id);
          formData.append('payment_method_id', payment_method_id);
          formData.append('transaction_amount',  Number(amount).toFixed(2));
          formData.append('installments', Number(installments));
          formData.append('description', 'Compra de Projetos em Engenharia');
          formData.append('email', email);
          formData.append('type', identificationType);
          formData.append('number', identificationNumber);
          formData.append('cart', cart.getJSONCart());

          $.ajax({
            url: BASE_URL + 'checkout/process_payment',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (json) => {
              if (json.status) {
                cart.clearCart();
                window.location.href = BASE_URL + 'meu_perfil?tab=historic';
              }

              $('.FormButton__spinner').addClass('FormButton__spinner--hidden');
            }
          });
        },
        onFetching: (resource) => {
          console.log("Fetching resource: ", resource);

          // Animate progress bar
          // const progressBar = document.querySelector(".progress-bar");
          // progressBar.removeAttribute("value");

          return () => {
            // progressBar.setAttribute("value", "0");
          };
        }
      },
    });
  }
});
