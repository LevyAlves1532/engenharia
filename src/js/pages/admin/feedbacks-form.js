$(function() {
  if (window.location.href.indexOf('/admin/feedbacks/form') > -1) {
    ClassicEditor.create($('#short_description')[0])
      .catch(error => {
        console.error(error);
      });

    const inputsName = ['cover', 'name', 'assessment', 'short_description'];
    const statusError = { error: false, label: ''  };

    const validateFunc = {
      cover: (value = '') => {
        const status = { ...statusError };
        const typeAcceptedFiles = ['image/png', 'image/jpg', 'image/jpeg'];

        if (value.size > 2500000) {
          status.error = true;
          status.label = 'A imagem tem que ser abaixo de 2,5mb!';
        }
        
        if (!typeAcceptedFiles.includes(value.type)) {
          status.error = true;
          status.label = 'O arquivo tem que ser uma imagem (png, jpg ou jpeg)!';
        }

        if (value.name === "") {
          status.error = true;
          status.label = 'Selecione um arquivo!'
        }

        return status;
      },
      name: (value = '') => {
        const status = { ...statusError };

        if (value.length < 3 || value.length > 100) {
          status.error = true;
          status.label = 'Nome precisa ter entre 3 a 100 caracteres!';
        }

        return status;
      },
      assessment: (value = '') => {
        const status = { ...statusError };
        value = value.replace(',', '.');

        if (!isNaN(value) && (parseInt(value) > 5 || parseInt(value) < 0)) {
          status.error = true;
          status.label = 'Avaliação precisa ser entre 0 e 5!';
        }

        if (isNaN(value)) {
          status.error = true;
          status.label = 'Avaliação precisa ser um número!';
        }

        if (value.trim() === '') {
          status.error = true;
          status.label = 'Avaliação precisa ser preenchido!';
        }

        return status;
      },
      short_description: (value = '') => {
        const status = { ...statusError };
        
        if (value.trim() === '') {
          status.error = true;
          status.label = 'Pequena descrição precisa ser preenchido!';
        }

        return status;
      },
    };

    $('#feedbacks-form').on('submit', function(e) {
      e.preventDefault();
      const isAdd = $('.AdmHeaderPage__title h1').html() === 'Adicionar';

      if (isAdd && !validateForm(this, inputsName, validateFunc)) return;

      const formData = !isAdd ? clearInputs(this, inputsName, validateFunc) : new FormData(this);

      if (formData) {
        $.ajax({
          url: BASE_URL + `admin/feedbacks/${isAdd ? 'add' : 'edit'}`,
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            console.log('ok');
            if (response.status && isAdd) {
              window.location.href = BASE_URL + 'admin/feedbacks';
            } else if (response.status && response.return.path) {
              $('#text-cover').html(response.return.path);
            }
          },
        });
      }
    });
  }
});
