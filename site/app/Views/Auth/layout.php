<!doctype html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Easy Customer Management</title>

    <link rel="shortcut icon" href="<?php echo base_url()?>/assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192"
        href="<?php echo base_url()?>/assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180"
        href="<?php echo base_url()?>/assets/media/favicons/apple-touch-icon-180x180.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="<?php echo base_url()?>/assets/css/oneui.min.css">

</head>

<body>
    <input type="hidden" id="csrf_security" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <div id="page-container">

        <!-- Main Container -->
        <main id="main-container">
            <?= $this->renderSection('main') ?>
        </main>
        <!-- END Main Container -->
    </div>


    <script src="<?php echo base_url()?>/assets/js/oneui.app.min.js"></script>


    <script src="<?php echo base_url()?>/assets/js/lib/jquery.min.js"></script>


    <script src="<?php echo base_url()?>/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>


    <script src="<?php echo base_url()?>/assets/js/pages/op_auth_signin.min.js"></script>

    <script src="<?php echo base_url()?>/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

    <script>
    One.helpersOnLoad(['jq-notify']);
    </script>

    <?= view('templates/notifications.php') ?>

</body>

</html>