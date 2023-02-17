<!doctype html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="url" href="<?php echo base_url()?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title><?=settings()->read('site.title') ?></title>

    <link rel="shortcut icon" href="<?php echo base_url()?>/assets/media/favicons/favicon.png?v=3">
    <link rel="icon" type="image/png" sizes="192x192"
        href="<?php echo base_url()?>/assets/media/favicons/favicon-192x192.png?v=3">
    <link rel="apple-touch-icon" sizes="180x180"
        href="<?php echo base_url()?>/assets/media/favicons/apple-touch-icon-180x180.png?v=3">

    <link rel="stylesheet"
        href="<?php echo base_url()?>/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url()?>/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url()?>/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">

    <link rel="stylesheet" href="<?php echo base_url()?>/assets/js/plugins/simplemde/simplemde.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/js/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url()?>/assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="<?php echo base_url()?>/assets/css/oneui.min.css">

</head>

<body>
    <input type="hidden" id="csrf_security" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <div id="page-container"
        class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-boxed">

        <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header -->
            <div class="content-header">
                <!-- Logo -->
                <a class="fw-semibold text-dual" href="<?php echo base_url()?>">
                    <span class="fs-5 tracking-wider">Camp<span class="fw-normal">Manager</span></span>
                </a>
                <!-- Options -->
                <div>

                    <!-- Options -->

                    <!-- END Options -->

                    <!-- Close Sidebar, Visible only on mobile screens -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout"
                        data-action="sidebar_close" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times"></i>
                    </a>
                    <!-- END Close Sidebar -->
                </div>

            </div>
            <!-- END Side Header -->

            <!-- Sidebar Scrolling -->
            <div class="js-sidebar-scroll">
                <!-- Side Navigation -->
                <div class="content-side">
                    <ul class="nav-main">
                        <?php if(has_permission('page.dashboard')): ?>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?= (current_page(route_to('dashboard'))) ? 'active' : ''?>"
                                href="<?= route_to('dashboard')?>">
                                <i class="nav-main-link-icon si si-speedometer"></i>
                                <span class="nav-main-link-name">Übersicht</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(has_permission('anmeldungen.show')): ?>
                        <li class="nav-main-heading">Verwaltung</li>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?= (current_page(route_to('anmeldungen'))) ? 'active' : ''?>"
                                href="<?php echo route_to('anmeldungen')?>">
                                <i class="nav-main-link-icon si si-people"></i>
                                <span class="nav-main-link-name">Anmeldungen</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(has_permission('zimmer.show')): ?>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?= (current_page(route_to('zimmer'))) ? 'active' : ''?>"
                                href="<?php echo route_to('zimmer')?>">
                                <i class="nav-main-link-icon fa-solid fa-bed"></i>
                                <span class="nav-main-link-name">Zimmer</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(has_permission('matlist.show')): ?>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?= (current_page(route_to('material'))) ? 'active' : ''?>"
                                href="<?php echo route_to('material')?>">
                                <i class="nav-main-link-icon fa-solid fa-list-check"></i>
                                <span class="nav-main-link-name">Materialliste</span>
                            </a>
                        </li>

                        <?php endif; ?>
                        <?php if(has_permission('admin.mail')): ?>
                        <li class="nav-main-item  <?= (current_page(route_to('mail'))) ? 'open' : ''?>">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="true" href="#">
                                <i class="nav-main-link-icon fa-solid fa-envelope"></i>
                                <span class="nav-main-link-name">Mail Versand</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link  <?= (current_page(route_to('mail'), true) OR current_page('app/mail/:num')) ? 'active' : ''?>"
                                        href="<?php echo route_to('mail')?>">
                                        <span class="nav-main-link-name">Neue E-Mail</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link   <?= (current_page(route_to('mail.sent'))) ? 'active' : ''?>"
                                        href="<?php echo route_to('mail.sent')?>">
                                        <span class="nav-main-link-name">Gesendet</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link   <?= (current_page(route_to('mail.saved'))) ? 'active' : ''?>"
                                        href="<?php echo route_to('mail.saved')?>">
                                        <span class="nav-main-link-name">Entwürfe</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        </li>
                        <?php endif; ?>
                        <?php if(has_permission('user.show') OR has_permission('group.show') OR has_permission('admin.settings') OR has_permission('admin.log')): ?>
                        <li class="nav-main-heading">Administration</li>
                        <?php if(has_permission('user.show')): ?>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?= (current_page(route_to('user'))) ? 'active' : ''?>"
                                href="<?php echo route_to('user')?>">
                                <i class="nav-main-link-icon fa-solid fa-user"></i>
                                <span class="nav-main-link-name">Benutzer</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(has_permission('group.show')): ?>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?= (current_page(route_to('group'))) ? 'active' : ''?>"
                                href="<?php echo route_to('group')?>">
                                <i class="nav-main-link-icon fa-solid fa-user"></i>
                                <span class="nav-main-link-name">Benutzergruppen</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(has_permission('form.show')): ?>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?= (current_page(route_to('form'))) ? 'active' : ''?>"
                                href="<?php echo route_to('form')?>">
                                <i class="nav-main-link-icon fa-solid fa-align-left"></i>
                                <span class="nav-main-link-name">Formulare</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(has_permission('admin.settings')): ?>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?= (current_page(route_to('settings'))) ? 'active' : ''?>"
                                href="<?php echo route_to('settings')?>">
                                <i class="nav-main-link-icon fa-solid fa-gear"></i>
                                <span class="nav-main-link-name">Einstellungen</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(has_permission('admin.log')): ?>
                        <li class="nav-main-item">
                            <a class="nav-main-link <?= (current_page(route_to('log'))) ? 'active' : ''?>"
                                href="<?php echo route_to('log')?>">
                                <i class="nav-main-link-icon fa-solid fa-list"></i>
                                <span class="nav-main-link-name">Log</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- END Sidebar Scrolling -->
        </nav>
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                    <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout"
                        data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- END Toggle Sidebar -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="d-flex align-items-center">
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle" src="<?php echo base_url()?>/assets/media/avatars/avatar10.jpg"
                                alt="Header Avatar" style="width: 21px;">
                            <span class="d-none d-sm-inline-block ms-1"><?= user()->toArray()['username'] ?></span>
                            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                            aria-labelledby="page-header-user-dropdown">
                            <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                                <img class="img-avatar img-avatar48 img-avatar-thumb"
                                    src="<?php echo base_url()?>/assets/media/avatars/avatar10.jpg" alt="">
                                <p class="mt-2 mb-0 fw-medium"><?= user()->toArray()['username'] ?></p>
                                <p class="mb-0 text-muted fs-sm fw-medium">
                                    <?php
                                foreach(user()->getRoles() as $val){
                                    echo '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">'.$val.'</span>';
                                }
                                ?>
                                </p>
                            </div>
                            <div role="separator" class="dropdown-divider m-0"></div>
                            <?php if(has_permission('page.profile')): ?>
                            <div class="p-2">
                                <a class="dropdown-item d-flex align-items-center justify-content-between"
                                    href="<?= route_to('profile') ?>">
                                    <span class="fs-sm fw-medium">Profile bearbeiten</span>
                                </a>
                            </div>
                            <?php endif; ?>
                            <div class="p-2">
                                <a class="dropdown-item d-flex align-items-center justify-content-between"
                                    href="<?php echo route_to('logout')?>">
                                    <span class="fs-sm fw-medium">Abmelden</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END User Dropdown -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header bg-body-extra-light">
                <div class="content-header">
                    <form class="w-100" method="POST">
                        <div class="input-group input-group-sm">
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-danger" data-toggle="layout"
                                data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                            <input type="text" class="form-control" placeholder="Search or hit ESC.."
                                id="page-header-search-input" name="page-header-search-input">
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->
        </header>
        <main id="main-container">

            <?= $this->renderSection('main') ?>


        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="bg-body-extra-light">
            <div class="content py-3">
                <div class="row fs-sm">
                    <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                        created by <a class="fw-semibold" href="https://github.com/Memurame/camp-manager"
                            target="_blank">Memurame</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <script src="<?php echo base_url()?>/assets/js/oneui.app.min.js?v=<?=asset_version()?>"></script>

    <script src="<?php echo base_url()?>/assets/js/lib/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" async></script>

    <script src="<?php echo base_url()?>/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?php echo base_url()?>/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="<?php echo base_url()?>/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js">
    </script>
    <script src="<?php echo base_url()?>/assets/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()?>/assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js">
    </script>
    <script src="<?php echo base_url()?>/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="<?php echo base_url()?>/assets/js/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?php echo base_url()?>/assets/js/plugins/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url()?>/assets/js/plugins/simplemde/simplemde.min.js"></script>
    <script src="<?php echo base_url()?>/assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="<?php echo base_url()?>/assets/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?php echo base_url()?>/assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js">
    </script>

    <script src="<?php echo base_url()?>/assets/js/pages/be_tables_datatables.min.js?v=<?=asset_version()?>"></script>

    <script>
    One.helpersOnLoad(['jq-notify', 'jq-maxlength', 'jq-select2', 'js-simplemde', 'jq-colorpicker']);
    </script>

    <script src="<?php echo base_url()?>/assets/js/custom.js?v=<?=asset_version()?>"></script>

    <?= view('templates/notifications.php') ?>
</body>

</html>