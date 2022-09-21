<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Benefitshop</title>

    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/favicon.png') ?>">

    <?= $this->include('parts/styles'); ?>

</head>
<body>
    <?= $this->include('parts/alerts'); ?>

    <?= $this->renderSection('content') ?>

    <!-- Notifications -->
    <div class="notifications-wrapper">
        <div class="notification-items">

        </div>
    </div>

    <?= $this->include('parts/loader'); ?>

    <?= $this->include('parts/scripts'); ?>
    <?= $this->renderSection('scripts') ?>

</body>
</html>