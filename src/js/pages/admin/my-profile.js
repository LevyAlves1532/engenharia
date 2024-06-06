$(function() {
  const href = window.location.href;
  if (href.indexOf('admin/account') > -1 && href.indexOf('admin/account/sign_in') === -1) {
    const inputsName = ['name', 'email', 'password'];
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
    
    $('#my-profile-form').on('submit', function(e) {
      e.preventDefault();

      const formData = clearInputs(this, inputsName, validateFunc);

      if (formData) {
        $.ajax({
          url: BASE_URL + 'admin/users/edit',
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: (response) => {
            if (response.status) {
              alertLib('Conta editada com sucesso!');
            }
          },
        });
      }
    });
  }
});
