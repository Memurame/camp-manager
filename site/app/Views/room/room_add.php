<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Neues Zimmer
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Erstellen eines neuen Zimmers
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a class="link-fx" href="<?php echo route_to('zimmer')?>">Zimmer</a>
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
    <form method="POST" action="<?php echo route_to('zimmer.create')?>">
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">

                        <?= csrf_field() ?>
                        <div class="mb-2">
                            <label for="name">Name <span class="text-red">*</span></label>
                            <input class="form-control <?php if(session('errors.name')) : ?>is-invalid<?php endif ?>" name="name" id="name" type="text" value="<?= old('name') ?>">
                            <div class="invalid-feedback"><?= session('errors.name') ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="capacity">Kapazität <span class="text-red">*</span></label>
                            <input class="form-control <?php if(session('errors.capacity')) : ?>is-invalid<?php endif ?>" name="capacity" id="capacity" type="text" value="<?= old('capacity') ?>">
                            <div class="invalid-feedback"><?= session('errors.capacity') ?></div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-primary">
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



