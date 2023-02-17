<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Neuer Benutzer
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Erstellen eines neuen Benutzer
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a class="link-fx" href="<?php echo route_to('user')?>">Benutzer</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Neu
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <form method="POST" action="<?php echo route_to('user.create')?>">
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Benutzerdaten</h3>
                    </div>
                    <div class="block-content">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="name">Anzeigename</label><input class="form-control <?php if(session('errors.name')) : ?>is-invalid<?php endif ?>" name="name" id="name" type="text" value="<?= old('name') ?>">
                            <div class="invalid-feedback"><?= session('errors.name') ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label><input class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" id="username" type="text" value="<?= old('username') ?>">
                            <div class="invalid-feedback"><?= session('errors.username') ?></div>
                        </div>
                        <div class="mb-4">
                            <label for="email">Mail</label><input class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" id="email" type="text" value="<?= old('email') ?>">
                            <div class="invalid-feedback"><?= session('errors.email') ?></div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-alt-primary">
                                Speichern
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
