$(function() {
  const inputsNameSignUp = ['name', 'email', 'password'];
  const inputsNameSignIn = ['email', 'password'];
  const errorClassSignUp = ['error-sign-up-name', 'error-sign-up-email', 'error-sign-up-password'];
  const errorClassSignIn = ['error-sign-in-email', 'error-sign-in-password'];
  const statusError = { error: false, label: ''  };

  const validateFunc = {
    name: (value = '') => {
      const status = { ...statusError };

      if (value.length < 3 || value.length > 100) {
        status.error = true;
        status.label = 'Nome precisa ter entre 3 a 100 caracteres!';
      }

      return status;
    },
    email: (value = '') => {
      const status = { ...statusError };

      if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value)) {
        status.error = true;
        status.label = 'E-mail inválido!';
      }

      if (value.trim().length === 0) {
        status.error = true;
        status.label = 'Preencha o campo de email!';
      }

      return status;
    },
    password: (value = '') => {
      const status = { ...statusError };

      if (value.length < 8 || value.length > 12) {
        status.error = true;
        status.label = 'Senha precisa ter entre 8 a 12 caracteres!';
      }

      return status;
    },
  };

  $('#sign-up-form').on('submit', function(e) {
    e.preventDefault();

    if (!validateForm(this, inputsNameSignUp, validateFunc, errorClassSignUp)) return;
    const formData = new FormData(this);

    $.ajax({
      url: BASE_URL + 'conta/criar_conta',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: (json) => {
        if (json.error) {
          console.error(json.error);
          return;
        }

        logged(formData.get('email'), formData.get('password'));
      }
    });
  });

  $('#sign-in-form').on('submit', function(e) {
    e.preventDefault();

    if (!validateForm(this, inputsNameSignIn, validateFunc, errorClassSignIn)) return;

    logged($('#sign-in-email').val(), $('#sign-in-password').val());
  });

  function logged(email, password) {
    const formData = new FormData();

    formData.append('email', email);
    formData.append('password', password);

    $.ajax({
      url: BASE_URL + 'conta/logar',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: (json) => {
        const goCheckoutStorage = localStorage.getItem(GO_CHECKOUT_STORAGE);

        if (json.error) {
          console.error(json.error);
          return;
        }

        localStorage.removeItem(GO_CHECKOUT_STORAGE);

        window.location.href = BASE_URL + (goCheckoutStorage ? 'carrinho' : '');
      }
    });
  }
});
