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
      
      if (isAdd && !validateForm(this)) return;

      const formData = !isAdd ? clearInputs(this) : new FormData(this);

      if (formData) {
        console.log("ok");
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
            }
          },
        });
      }
    });

    function validateForm(form) {
      let isValid = true;

      const formData = new FormData(form);

      inputsName.forEach(inputName => {
        const validInput = validateFunc[inputName](formData.get(inputName));
        const element = document.querySelector(`input[name="${inputName}"]`) || document.querySelector(`select[name="${inputName}"]`);
        if (validInput.error) isValid = false;

        showError(element, validInput.label);
      });

      return isValid;
    }

    function showError(element, label) {
      const main = element.type === 'password' ? $(element).parent().parent() : $(element).parent();
      const errorDiv = main.find('.error');

      if (label) {
        errorDiv.html(`<p class="text-danger mt-2">${label}</p>`);
      } else {
        errorDiv.html('');
      }
    }

    function clearInputs(form) {
      const formData = new FormData(form);
      let isValid = true;
  
      inputsName.forEach(inputName => {
        if (formData.get(inputName).trim() === "" || formData.get(inputName).trim() === "null") {
          formData.delete(inputName);
        } else {
          const validInput = validateFunc[inputName](formData.get(inputName));
          const element = document.querySelector(`input[name="${inputName}"]`) || document.querySelector(`select[name="${inputName}"]`);
          if (validInput.error) isValid = false;

          showError(element, validInput.label);
        }
      });

      return isValid ? formData : null;
    }
  }
});