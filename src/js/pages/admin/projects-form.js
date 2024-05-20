$(function() {
  if (window.location.href.indexOf('/admin/projects/form') > -1) {
    ClassicEditor.create($('#description')[0])
      .catch(error => {
        console.error(error);
      });

    const inputsName = ['cover', 'carousel[]', 'title', 'slug', 'price', 'discount_percent', 'short_description', 'description', 'square_meters', 'bathrooms', 'bedrooms', 'garages', 'files_projects[]'];
    const statusError = { error: false, label: ''  };

    const validateCaracProjects = (value = '', label) => {
      const status = { ...statusError };

      if (!isNaN(value.replace(',', '.')) && parseInt(value.replace(',', '.')) === 0) {
        status.error = true;
        status.label = label + ' precisa ser maior que 0!';
      }

      if (isNaN(value.replace(',', '.'))) {
        status.error = true;
        status.label = label + ' precisa ser um número!';
      }

      if (value.trim() === '') {
        status.error = true;
        status.label = label + ' precisa ser preenchido!';
      }

      return status;
    };

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
      'carousel[]': (value = '', element) => {
        const status = { ...statusError };
        const typeAcceptedFiles = ['image/png', 'image/jpg', 'image/jpeg'];

        for (let x=0;x<element.files.length;x++) {
          const file = element.files[x];

          if (file.size > 2500000) {
            status.error = true;
            status.label = 'As imagens tem que ser abaixo de 2,5mb!';
          }
          
          if (!typeAcceptedFiles.includes(file.type)) {
            status.error = true;
            status.label = 'Uma das imagens é inválido (png, jpg ou jpeg)!';
          }
        }

        if (value.name === "") {
          status.error = true;
          status.label = 'Selecione um arquivo!'
        }

        return status;
      },
      title: (value = '') => {
        const status = { ...statusError };

        if (value.length < 3 || value.length > 100) {
          status.error = true;
          status.label = 'Título precisa ter entre 3 a 100 caracteres!';
        }

        return status;
      },
      slug: (value = '') => {
        const status = { ...statusError };

        return status;
      },
      price: (value = '') => {
        const status = { ...statusError };

        if (isNaN(value.replace(',', '.'))) {
          status.error = true;
          status.label = 'Preço precisa ser um número!';
        }

        if (value.trim() === '') {
          status.error = true;
          status.label = 'Preço precisa ser preenchido!';
        }

        return status;
      },
      discount_percent: (value = '') => {
        const status = { ...statusError };

        if (!isNaN(value.replace(',', '.')) && (parseInt(value.replace(',', '.')) < 0 || parseInt(value.replace(',', '.')) > 100)) {
          status.error = true;
          status.label = 'Desconto precisa estar entre 0 e 100!';
        }

        if (isNaN(value.replace(',', '.'))) {
          status.error = true;
          status.label = 'Desconto precisa ser um número!';
        }

        if (value.trim() === '') {
          status.error = true;
          status.label = 'Desconto precisa ser preenchido!';
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
      description: (value = '') => {
        const status = { ...statusError };

        if (value.trim() === '') {
          status.error = true;
          status.label = 'Descrição precisa ser preenchido!';
        }

        return status;
      },
      square_meters: (value = '') => validateCaracProjects(value, 'Metros Quadrados'),
      bathrooms: (value = '') => validateCaracProjects(value, 'Banheiros'),
      bedrooms: (value = '') => validateCaracProjects(value, 'Quartos'),
      garages: (value = '') => validateCaracProjects(value, 'Garagens'),
      'files_projects[]': (value = '', element) => {
        const status = { ...statusError };
        const typeAcceptedFiles = ['image/png', 'image/jpg', 'image/jpeg', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf', 'application/x-zip-compressed'];

        for (let x=0;x<element.files.length;x++) {
          const file = element.files[x];

          if (file.size > 5000000) {
            status.error = true;
            status.label = 'As imagens tem que ser abaixo de 5mb!';
          }
          
          if (!typeAcceptedFiles.includes(file.type)) {
            status.error = true;
            status.label = 'Uma das imagens é inválido (png, jpg, jpeg, pdf, document office ou zip)!';
          }
        }

        if (value.name === "") {
          status.error = true;
          status.label = 'Selecione um arquivo!'
        }

        return status;
      },
    };

    $('#projects-form').on('submit', function(e) {
      e.preventDefault();
      const isAdd = $('.AdmHeaderPage__title h1').html() === 'Adicionar';

      if (isAdd && !validateForm(this, inputsName, validateFunc)) return;

      const formData = !isAdd ? clearInputs(this, inputsName, validateFunc) : new FormData(this);

      if (formData) {
        $.ajax({
          url: BASE_URL + `admin/projects/${isAdd ? 'add' : 'edit'}`,
          type: 'post',
          data: formData,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status && isAdd) {
              window.location.href = BASE_URL + 'admin/projects';
            } else if (response.status && !isAdd) {
              if (response.return.project.carousel) {
                response.return.project.carousel.forEach(carousel_item => {
                  const button = createButtonDeleteFile(carousel_item.file, formData.get('ip'), carousel_item.id);
                  $('#files-carousel')[0].appendChild(button);
                });
              }

              if (response.return.project.files) {
                response.return.project.files.forEach(project_item => {
                  const button = createButtonDeleteFile(project_item.file, formData.get('ip'), project_item.id);
                  $('#files-projects')[0].appendChild(button);
                });
              }
            }
          },
        });
      }
    });

    $('#price').on('blur', discount);
    $('#discount_percent').on('blur', discount);
    $('#is_discount').on('blur', discount);

    function discount() {
      const is_discount = $('#is_discount')[0].checked;
      const price = parseInt($('#price').val().replace(',', '.'));
      const value = parseInt($('#discount_percent').val().replace(',', '.'));
      
      if (!price || !value || !is_discount) {
        $('.total-value-show').text(`Valor total R$0,00`);
        $('.discount-show').text(`Total do desconto R$0,00`);
        return
      }

      const discount = (price * value) / 100;
      const total_value = price - discount;

      $('.discount-show').text(`Total do desconto R$${convertInBRL(discount)}`);
      $('.total-value-show').text(`Valor total R$${convertInBRL(total_value)}`);
    }

    function createButtonDeleteFile(label, idProject, id) {
      const div = document.createElement('div');
      div.classList.add('form-text', 'd-flex', 'justify-content-between');

      div.innerHTML = `
        ${label}
        <a href="${BASE_URL}admin/projects/delete_carousel/${btoa(id)}?ip=${idProject}" class="text-danger">x</a>
      `;

      return div;
    }

    $('#title').on('keyup', function(e) {
      let value = e.target.value;

      // Substitui espaços por '-'
      value = value.replace(/\s+/g, '-');

      // Remove acentuações
      value = value.normalize('NFD').replace(/[\u0300-\u036f]/g, '');

      // Remove caracteres especiais (mantém apenas letras, números e '-')
      value = value.replace(/[^a-zA-Z0-9-]/g, '');

      // Converte todas as letras para minúsculas
      value = value.toLowerCase();

      $('#slug').val(value);
    });
  }
});
