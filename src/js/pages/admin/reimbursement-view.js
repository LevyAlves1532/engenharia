$(function() {
  if (window.location.href.indexOf('/admin/reimbursement/view') > -1) {
    const inputsName = ['response'];
    const statusError = { error: false, label: ''  };

    const validateFunc = {
      response: (value = '') => {
        const status = { ...statusError };
        
        if (value.trim() === '') {
          status.error = true;
          status.label = 'Resposta precisa ser preenchida!';
        }

        return status;
      },
    };

    $('#reimbursement-form').on('submit', function(e) {
      e.preventDefault();

      if (!validateForm(this, inputsName, validateFunc)) return;

      const formData = new FormData(this);

      $.ajax({
        url: BASE_URL + `admin/reimbursement/edit`,
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
          if (response.status) {
            alertLib('Solicitação editada com sucesso!');
          } else if (!response.status && response.return.error && isAdd) {
            alertLib(response.return.error);
          }
        },
      });
    });
  }
})