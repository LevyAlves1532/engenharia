$(function() {
  if (window.location.href.indexOf('/admin/posts_instagram/form') > -1) {
    const inputsName = ['cover', 'link'];
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
      link: (value = '') => {
        const status = { ...statusError };

        if (value.length < 3 || value.length > 255) {
          status.error = true;
          status.label = 'Nome precisa ter entre 3 a 255 caracteres!';
        }

        return status;
      },
    };

    $('#posts-instagram-form').on('submit', function(e) {
      e.preventDefault();
      const isAdd = $('.AdmHeaderPage__title h1').html() === 'Adicionar';

      if (isAdd && !validateForm(this, inputsName, validateFunc)) return;

      const formData = !isAdd ? clearInputs(this, inputsName, validateFunc) : new FormData(this);

      if (formData) {
        $.ajax({
          url: BASE_URL + `admin/posts_instagram/${isAdd ? 'add' : 'edit'}`,
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status && isAdd) {
              window.location.href = BASE_URL + 'admin/posts_instagram';
            } else if (response.status && response.return && response.return.path) {
              $('.form-text').html(response.return.path);
              alertLib('Post editado com sucesso!');
            } else if (response.status && !isAdd) {
              alertLib('Post editado com sucesso!');
            } else if (!response.status && response.return.error && isAdd) {
              alertLib(response.return.error);
            }
          },
        });
      }
    });
  }
});
