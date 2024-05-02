<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engenharia Daniel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="stylesheet" href="<?= BASE ?>assets/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE; ?>assets/css/style.css">
    <style>
      body {
        height: 100vh;
        overflow: hidden;
      }
    </style>
  </head>
  <body>

    <div class="AdminTemplate">
      <div class="AdminTemplate__header">
        <?php include 'components/admin/header.php' ?>
      </div>

      <div class="AdminTemplate__body container-md row mx-auto">
        <div class="AdminTemplate__body_menu-bar col-4">
          <?php include 'components/admin/menu-bar.php' ?>
        </div>

        <div class="AdminTemplate__body_content col-8">

        </div>
      </div>
    </div>

    <!-- Conteudos -->
    <?php $this->loadViewInTemplateAdmin($viewName, $viewData); ?>
    
    <script>
      var BASE_URL = "<?= BASE ?>";
    </script>

    <script src="<?= BASE ?>assets/js/libs/jquery.min.js"></script>
    <script src="<?= BASE ?>assets/js/libs/slick.min.js"></script>
    <script src="<?= BASE ?>assets/js/libs/bootstrap.bundle.min.js"></script>
    <!-- <script src="<?= BASE ?>assets/js/libs/popper.min.js"></script> -->
    <!-- <script src="<?= BASE ?>assets/js/libs/bootstrap.min.js"></script> -->
    <script src="<?= BASE ?>assets/js/main.min.js"></script>

  </body>
</html>