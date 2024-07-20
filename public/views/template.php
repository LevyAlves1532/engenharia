<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engenharia</title>
    <meta name="description" content="Nossa empresa de engenharia oferece soluções inovadoras e personalizadas em engenharia civil, estrutural e de projetos. Com uma equipe altamente qualificada, garantimos excelência, eficiência e qualidade em cada etapa do seu projeto. Entre em contato para transformar suas ideias em realidade.">
    <meta name="keywords" content="engenharia, engenharia civil, engenharia estrutural, projetos de engenharia, consultoria em engenharia, gerenciamento de projetos, análise de viabilidade, inspeção de obras, supervisão de obras, soluções de engenharia, construção civil, planejamento de projetos, engenharia de construção, empresa de engenharia">
    <meta name="author" content="Pedro Alvarez">
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

    <?php include "components/button-whatsapp.php"; ?>

    <?php include "components/footer.php"; ?>

    <script>
      var BASE_URL = "<?= BASE ?>";
    </script>

    <script src="<?= BASE ?>assets/js/libs/jquery.min.js"></script>
    <script src="<?= BASE ?>assets/js/libs/slick.min.js"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script src="<?= BASE ?>assets/js/libs/sweetalert2.min.js"></script>
    <script src="<?= BASE ?>assets/js/libs/jquery.mask.min.js"></script>
    <script src="<?= BASE ?>assets/js/main.min.js"></script>

  </body>
</html>