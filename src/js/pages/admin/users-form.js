$(function(){
  if (window.location.href.indexOf('/admin/users/form') > -1) {
    const inputsName = ['name', 'email', 'password', 'user_type'];
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
      user_type: (value = '') => {
        const status = { ...statusError };

        if (value === 'null') {
          status.error = true;
          status.label = 'Informe o tipo de usuário!';
        }

        return status;
      },
    };

    $('#users-form').on('submit', function(e) {
      e.preventDefault();
      const isAdd = $('.AdmHeaderPage__title h1').html() === 'Adicionar';
      
      if (isAdd && !validateForm(this, inputsName, validateFunc)) return;

      const formData = !isAdd ? clearInputs(this, inputsName, validateFunc) : new FormData(this);

      if (formData) {
        $.ajax({
          url: BASE_URL + `admin/users/${isAdd ? 'add' : 'edit'}`,
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status && isAdd) {
              window.location.href = BASE_URL + 'admin/users';
            } else if (response.status && !isAdd) {
              alertLib('Usuário editado com sucesso!');
            } else if (!response.status && response.return.error && isAdd) {
              alertLib(response.return.error);
            }
          },
        });
      }
    });
  }
});