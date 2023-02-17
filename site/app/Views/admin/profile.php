<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Benutzer Profil
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Bearbeiten deiner Benutzerdaten
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Profile
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Content -->
<div class="content">
    <!-- Your Block -->
    <div class="content content-boxed">
        <!-- User Profile -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Benutzer Profil</h3>
            </div>
            <div class="block-content">
                <form action="<?= route_to('profile.update') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Deine Konto Daten.<br>
                                Diese Daten dienen der identifikation und werden für das Login benötigt.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                                <div class="mb-4">
                                    <label class="form-label" for="name">Anzeigename</label>
                                    <input type="text" class="form-control <?php if(session('errors.name')) : ?>is-invalid<?php endif ?>" id="name" name="name" value="<?=$user->name ?>">
                                    <div class="invalid-feedback"><?= session('errors.name') ?></div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" id="username" name="username" value="<?=$user->username ?>">
                                    <div class="invalid-feedback"><?= session('errors.username') ?></div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="email">E-Mail Addresse</label>
                                    <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" id="email" name="email" value="<?= $user->email ?>">
                                    <div class="invalid-feedback"><?= session('errors.email') ?></div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-alt-primary">
                                        Speichern
                                    </button>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Profile -->

        <!-- Change Password -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Passwort ändern</h3>
            </div>
            <div class="block-content" id="block-password">
                <form action="<?= route_to('profile.password') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Das Ändern deines Anmeldepasswort ist eine einfache Möglichkeit, dein Konto zu schützen.
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="password-old">Aktuelles Passwort</label>
                                <input type="password" class="form-control <?php if(session('errors.password-old')) : ?>is-invalid<?php endif ?>" id="password-old" name="password-old">
                                <div class="invalid-feedback"><?= session('errors.password-old') ?></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="password-new">Neues Passwort</label>
                                    <input type="password" class="form-control <?php if(session('errors.password-new')) : ?>is-invalid<?php endif ?>" id="password-new" name="password-new">
                                    <div class="invalid-feedback"><?= session('errors.password-new') ?></div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="password-new-confirm">Password wiederholen</label>
                                    <input type="password" class="form-control <?php if(session('errors.password-new-confirm')) : ?>is-invalid<?php endif ?>" id="password-new-confirm" name="password-new-confirm">
                                    <div class="invalid-feedback"><?= session('errors.password-new-confirm') ?></div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary">
                                    Passwort speichern
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Change Password -->

    </div>
</div>
<?= $this->endSection() ?>