<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Material bearbeiten
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Erstellen eines neuen Materials
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a class="link-fx" href="<?php echo base_url('materialliste')?>">Materialliste</a>
                    </li>
                    <li class="breadcrumb-item active">
                        bearbeiten
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <form method="POST" action="<?php echo route_to('material.edit', $material->id) ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="mb-2 col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select">
                                    <option value="0" <?= ($material->status == 0) ? 'selected' : '' ?>>Offen</option>
                                    <option value="1" <?= ($material->status == 1) ? 'selected' : '' ?>>Organisiert</option>
                                    <option value="2" <?= ($material->status == 2) ? 'selected' : '' ?>>Verladen</option>
                                    <option value="3" <?= ($material->status == 3) ? 'selected' : '' ?>>Erledigt</option>
                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-2 col-md-12">
                                <label for="name" class="form-label">Material <span class="text-danger">*</span></label>
                                <input class="form-control <?php if(session('errors.name')) : ?>is-invalid<?php endif ?>" name="name" id="name" type="text" value="<?= $material->name ?>">
                                <div class="invalid-feedback"><?= session('errors.name') ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-2 col-md-6">
                                <label for="count" class="form-label">Anzahl <span class="text-danger">*</span></label>
                                <input class="form-control <?php if(session('errors.count')) : ?>is-invalid<?php endif ?>" name="count" id="count" type="text" value="<?= $material->count ?>">
                                <div class="invalid-feedback"><?= session('errors.count') ?></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="mb-2 col-md-6">
                                <label for="assign" class="form-label">Verantwortlich</label>
                                <select class="form-select" name="assign" id="assign">
                                    <option value="0">--- Keine Zuweissung ---</option>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user->id ?>" <?php echo ($material->assigned_uid == $user->id) ? 'selected' : '' ?>><?= $user->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="mb-2 col-md-6">
                                <label for="category" class="form-label">Kategorie <span class="text-danger">*</span></label>
                                <select class="form-select" name="category" id="category">
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat->id ?>" <?php echo ($material->cat == $cat->id) ? 'selected' : '' ?>><?= $cat->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="mb-2 col-12">
                                <label for="description" class="form-label">Bemerkung</label>
                                <textarea rows="4" name="description" id="description" class="form-control"><?= $material->description ?></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-alt-success">
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




