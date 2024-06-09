$(function() {
  const inputsNameReimbursement = ['phone', 'motive'];
  const errorClassReimbursement = ['error-reimbursement-phone', 'error-reimbursement-motive'];
  const statusError = { error: false, label: ''  };

  const validateFunc = {
    phone: (value = '') => {
      const status = { ...statusError };

      if (value.length !== 16) {
        status.error = true;
        status.label = 'Telefone inválido!';
      }

      if (value.length < 3 || value.length > 100) {
        status.error = true;
        status.label = 'Nome precisa ter entre 3 a 100 caracteres!';
      }

      return status;
    },
    motive: (value = '') => {
      const status = { ...statusError };

      if (value.trim().length === 0) {
        status.error = true;
        status.label = 'Precisamos que fale o motivo!';
      }

      return status;
    },
  };

  if ($('#reimbursement-phone').length > 0) {
    $('#reimbursement-phone').mask('(99) 9 9999-9999');
  }

  $('#form-reimbursement').on('submit', function(e) {
    e.preventDefault();

    if (!validateForm(this, inputsNameReimbursement, validateFunc, errorClassReimbursement)) return;

    const formData = new FormData(this);

    $.ajax({
      url: BASE_URL + 'meu_perfil/solicitar_reembolso',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: (json) => {
        if (json.error) {
          alertLib(json.error);
          return;
        }

        window.location.href = BASE_URL + 'meu_perfil?tab=historic';
      }
    });
  });
});