<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $page->get('title') ?></title>

  <!-- CSS START-->

  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />

  <link rel="stylesheet" href="<?= phpb_theme_asset('css/style.css') ?>" />

  <!-- CSS END-->
</head>

<body>

  <?= $body ?>

  <!-- go to Top : START -->
  <div class="container-fluid">
    <button onclick="topFunction()" id="gotoTop_Btn">
      <span class="fas fa-chevron-up fa-2x"></span>
    </button>
  </div>
  <!-- go to Top : END -->

  <!-- JS START-->

  <!-- font Awesome CDN -->
  <script src="https://kit.fontawesome.com/c645529b0c.js"></script>

  <!-- BootStrap CDN -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <!-- jQuery CDN-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Goto top Script-->
  <script src="<?= phpb_theme_asset('js/gotoTop.js') ?>"></script>

  <!-- JS END -->
</body>

</html>