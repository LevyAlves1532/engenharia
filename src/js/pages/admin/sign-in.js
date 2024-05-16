$(function() {
  if (window.location.href.indexOf('/admin/account/sign_in') > -1) {
    const inputsName = ['email', 'password'];
    const statusError = { error: false, label: ''  };

    const validateFunc = {
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

    $('#sign-in-form').on('submit', function(e) {
      e.preventDefault();

      if (!validateForm(this, inputsName, validateFunc)) return;

      const formData = new FormData(this);

      $.ajax({
        url: BASE_URL + `admin/account/login`,
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
          if (response.status) {
            window.location.href = BASE_URL + 'admin/';
          }
        },
      });
    });
  }
});
