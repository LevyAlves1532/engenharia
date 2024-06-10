$(function() {
  const href = window.location.href;

  if (href.indexOf('projetos') > -1 && href.indexOf('admin') === -1) {
    const cart = new Cart();
    cart.init();

    const initialParams = localStorage.getItem(PARAMS_LISTEN_PROJECTS_STORAGE) ? JSON.parse(localStorage.getItem(PARAMS_LISTEN_PROJECTS_STORAGE)) : { current_page: 1 };

    let search = '';
    let params = { ...initialParams };

    listenProjects();

    /**
     * Form filter script - start
     */
    $('#button-filter-projects').on('click', function() {
      const projectsFilterArea = $('#projects-filter-area');
      const projectsFilterAreaClass = 'ProjectsContent__filter--active';
      const buttonClass = 'Button--active-filter';

      if (!projectsFilterArea.hasClass(projectsFilterAreaClass)) {
        projectsFilterArea.addClass(projectsFilterAreaClass);
        $(this).addClass(buttonClass);
      } else {
        projectsFilterArea.removeClass(projectsFilterAreaClass);
        $(this).removeClass(buttonClass);
      }
    });

    // Leave form
    $('#projects-filter-area').on('mouseleave', function() {
      $(this).removeClass('ProjectsContent__filter--active');
      $('#button-filter-projects').removeClass('Button--active-filter');
    })
    /**
     * Form filter script - end
     */

    const inputsName = ['square_meters', 'bathrooms', 'bedrooms', 'garages', 'min', 'max'];
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
      square_meters: (value = '') => validateCaracProjects(value, 'Metros Quadrados'),
      bathrooms: (value = '') => validateCaracProjects(value, 'Banheiros'),
      bedrooms: (value = '') => validateCaracProjects(value, 'Quartos'),
      garages: (value = '') => validateCaracProjects(value, 'Garagens'),
      min: (value = '') => validateCaracProjects(value, 'Preço Mínimo'),
      max: (value = '') => validateCaracProjects(value, 'Preoço Máximo'),
    };

    function getAllForm() {
      const formData = clearInputs($('#projects-filter')[0], inputsName, validateFunc);

      if (formData) {
        params = { ...initialParams };
        inputsName.forEach(inputName => {
          if (formData.get(inputName)) {
            params[inputName] = formData.get(inputName);
          }
        });

        const params_keys = Object.keys(params);

        if ((params_keys.length > 0 || search !== '') && $('.ProjectsContentFilter__inputs--clear').length === 0) {
          const button = document.createElement('button');
          button.classList.add('ProjectsContentFilter__inputs--clear');
          button.innerHTML = 'Limpar filtros';
          button.type = 'button';
          button.addEventListener('click', clearFilters);

          $('.ProjectsContentFilter__inputs')[0].appendChild(button);
        }
      }
    }

    function clearFilters() {
      search = '';
      params = { ...initialParams };
      listenProjects();
      clearValueInputs();
      $(this)[0].remove();
    }

    function clearValueInputs() {
      $('#search').val('');
      inputsName.forEach(inputName => $('input[name="' + inputName + '"]').val(''));
    }

    function setSearch() {
      search = $('#search').val();
    }

    $('#projects-filter').on('submit', function(e) {
      e.preventDefault();
      getAllForm();
      setSearch();
      listenProjects();
    });

    $('#search-button').on('click', function() {
      setSearch();
      getAllForm();
      listenProjects();
    });

    function listenProjects() {
      localStorage.setItem(PARAMS_LISTEN_PROJECTS_STORAGE, JSON.stringify(params));

      $.ajax({
        url: BASE_URL + `projetos/list?search=${search}`,
        data: { ...params },
        dataType: 'json',
        success: (json) => {
          if (json.error) {
            Swal.mixin({
              customClass: {
                confirmButton: "Button",
              },
              buttonsStyling: false,
            }).fire({
              text: json.error,
              confirmButtonText: "Fechar",
            });
            return;
          }

          if (json.data.length > 0) {
            renderProjects(json.data);
            renderPagination(json);
          }
        },
      });
    }

    function renderProjects(projects) {
      if ($('.ProjectsContent__products_list').length > 0) {
        $('.ProjectsContent__products_list').html('');

        projects.forEach(project => {
          let projectHTML = createProject(project);
          projectHTML = renderButton(projectHTML, project);
          $('.ProjectsContent__products_list')[0].appendChild(projectHTML);
        });
      }
    }

    function createProject(project) {
      const linkProject = document.createElement('a');

      linkProject.classList.add('Project');
      linkProject.href = `${BASE_URL}projetos/produto/${project.slug}`

      let price_discount = null;

      if (project.is_discount) {
        price_discount = (project.price * project.discount_percent) / 100;
        price_discount = project.price - price_discount;
      }

      linkProject.innerHTML = `
        <div class="Project__image">
          <img src="${project.cover}" alt="">

          ${project.is_discount === 1 && `
            <div class="Project__image_discount">
              <p>${project.discount_percent}% de desconto!</p>
            </div>
          `}

          <div class="Project__image_price">
            ${price_discount ? `
              <p><strike>R$ ${project.price.toFixed(2).replace('.', ',')}</strike> R$ ${price_discount.toFixed(2).replace('.', ',')}</p>
            ` : `
              <p>R$ ${project.price.toFixed(2).replace('.', ',')}</p>
            `}
          </div>
        </div>

        <div class="Project__info">
          <div class="Project__info_title">
            <p>${project.title}</p>
          </div>

          <div class="Project__info_text">
            <p>${project.short_description}</p>
          </div>
          
          <div class="Project__info_data">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M32 32C14.3 32 0 46.3 0 64v96c0 17.7 14.3 32 32 32s32-14.3 32-32V96h64c17.7 0 32-14.3 32-32s-14.3-32-32-32H32zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7 14.3 32 32 32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H64V352zM320 32c-17.7 0-32 14.3-32 32s14.3 32 32 32h64v64c0 17.7 14.3 32 32 32s32-14.3 32-32V64c0-17.7-14.3-32-32-32H320zM448 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64H320c-17.7 0-32 14.3-32 32s14.3 32 32 32h96c17.7 0 32-14.3 32-32V352z"/></svg>
              <p>${project.square_meters.toString().replace('.', ',')}m²</p>
            </div>

            <div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 131.9C64 112.1 80.1 96 99.9 96c9.5 0 18.6 3.8 25.4 10.5l16.2 16.2c-21 38.9-17.4 87.5 10.9 123L151 247c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0L345 121c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-1.3 1.3c-35.5-28.3-84.2-31.9-123-10.9L170.5 61.3C151.8 42.5 126.4 32 99.9 32C44.7 32 0 76.7 0 131.9V448c0 17.7 14.3 32 32 32s32-14.3 32-32V131.9zM256 352a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm64 64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm0-128a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm64 64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm0-128a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm64 64a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm32-32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>
              <p>${project.bathrooms}</p>
            </div>

            <div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M32 32c17.7 0 32 14.3 32 32V320H288V160c0-17.7 14.3-32 32-32H544c53 0 96 43 96 96V448c0 17.7-14.3 32-32 32s-32-14.3-32-32V416H352 320 64v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V64C0 46.3 14.3 32 32 32zm144 96a80 80 0 1 1 0 160 80 80 0 1 1 0-160z"/></svg>
              <p>${project.bedrooms}</p>
            </div>

            <div>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 117.4L109.1 192H402.9l-26.1-74.6C372.3 104.6 360.2 96 346.6 96H165.4c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32H346.6c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2V400v48c0 17.7-14.3 32-32 32H448c-17.7 0-32-14.3-32-32V400H96v48c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V400 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/></svg>
              <p>${project.garages}</p>
            </div>
          </div>

          <div class="Project__info_button">
            
          </div>
        </div>
      `;

      return linkProject;
    }

    function renderPagination(json) {
      $('#pages-qtd').text(`+${json.qtd_projects}`);
      if ($('#list-pages').length > 0) {
        $('#list-pages').html('');

        for (let x=json.current_page;x<(json.current_page + 3);x++) {
          const real_pagination = x - 1;
          if (real_pagination === 0) continue;
          if (real_pagination > json.qtd_pages) continue;
          
          const li = document.createElement('li');
          li.innerHTML = `<p>${real_pagination < 10 ? `0${real_pagination}` : real_pagination}</p>`
          li.onclick = function() {
            params.current_page = real_pagination;
            listenProjects();
          }
          if (json.current_page === real_pagination) li.classList.add('active-dot');

          $('#list-pages')[0].appendChild(li);
        }
      }
    }

    function renderButton(projectHTML, project) {
      const button = document.createElement('button');
      button.classList.add('Button');

      if (project.is_buy === 1 || cart.cart.find(cart_project => cart_project.slug === project.slug)) {
        button.innerText = 'Ver Produto';
      } else {
        button.innerText = 'Adicionar Produto';

        if (project.is_logged === 1) {
          button.onclick = function(e) {
            e.preventDefault();
            cart.pushProject(project);
            window.location.href = BASE_URL + 'projetos/produto/' + project.slug;
          }
        } else {
          button.onclick = function(e) {
            e.preventDefault();
            window.location.href = BASE_URL + 'conta/';
          }
        }
      }

      projectHTML.querySelector('.Project__info_button').appendChild(button);
      return projectHTML;
    }
  }
})