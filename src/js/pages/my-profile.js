$(function() {
  const inputsName = ['name', 'email', 'password'];
  const errorClass = ['error-user-name', 'error-user-email', 'error-user-password'];
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

  $('#tab-box-my-profile .MyProfileTabBox__tabs button').on('click', function() {
    const tab = $(this).attr('data-tab');
    const tabActiveClass = 'active-tab';

    $('#tab-box-my-profile .MyProfileTabBox__tabs button').removeClass(tabActiveClass);
    $('#tab-box-my-profile .MyProfileTabBox__content_item').removeClass(tabActiveClass);
    $(`#tab-box-my-profile div[data-tab-name="${tab}"]`).addClass(tabActiveClass);
    $(this).addClass(tabActiveClass);
  });

  $('#profile-form').on('submit', function(e) {
    e.preventDefault();

    const formData = clearInputs(this, inputsName, validateFunc, errorClass);

    if (formData) {
      $.ajax({
        url: BASE_URL + `meu_perfil/editar_perfil`,
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(json) {
          if (json.error) return;

          window.location.href = BASE_URL + 'meu_perfil';
        },
      });
    }
  });
});