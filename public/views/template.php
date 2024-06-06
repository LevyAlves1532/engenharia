<!DOCTYPE html>
<html lang="pt_BR">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engenharia Daniel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="stylesheet" href="<?= BASE; ?>assets/css/libs/slick.css">
    <link rel="stylesheet" href="<?= BASE; ?>assets/css/libs/slick-theme.css">
    <link rel="stylesheet" href="<?= BASE; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE; ?>assets/css/libs/sweetalert2.min.css">
  </head>

  <body>

    <?php include "components/header.php"; ?>

    <!-- Conteudos -->
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>

    <?php include "components/footer.php"; ?>

    <script>
      var BASE_URL = "<?= BASE ?>";
    </script>

    <script src="<?= BASE ?>assets/js/libs/jquery.min.js"></script>
    <script src="<?= BASE ?>assets/js/libs/slick.min.js"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script src="<?= BASE ?>assets/js/libs/sweetalert2.min.js"></script>
    <script src="<?= BASE ?>assets/js/main.min.js"></script>

  </body>
</html>