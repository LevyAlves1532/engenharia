$(function() {
  if (window.location.href.indexOf('/admin/faq/form') > -1) {
    ClassicEditor.create($('#response')[0])
      .catch(error => {
        console.error(error);
      });

    const inputsName = ['question', 'response'];
    const statusError = { error: false, label: ''  };

    const validateFunc = {
      question: (value = '') => {
        const status = { ...statusError };

        if (value.length < 3 || value.length > 255) {
          status.error = true;
          status.label = 'Nome precisa ter entre 3 a 255 caracteres!';
        }

        return status;
      },
      response: (value = '') => {
        const status = { ...statusError };
        
        if (value.trim() === '') {
          status.error = true;
          status.label = 'Pequena descrição precisa ser preenchido!';
        }

        return status;
      },
    };

    $('#faq-form').on('submit', function(e) {
      e.preventDefault();
      const isAdd = $('.AdmHeaderPage__title h1').html() === 'Adicionar';

      if (isAdd && !validateForm(this, inputsName, validateFunc)) return;

      const formData = !isAdd ? clearInputs(this, inputsName, validateFunc) : new FormData(this);

      if (formData) {
        $.ajax({
          url: BASE_URL + `admin/faq/${isAdd ? 'add' : 'edit'}`,
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status && isAdd) {
              window.location.href = BASE_URL + 'admin/faq';
            } else if (response.status && response.return.path) {
              $('#text-cover').html(response.return.path);
            }
          },
        });
      }
    });
  }
});
