
<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Zimmer bearbeiten
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Bearbeiten eines Zimmer
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
                        Bearbeiten
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="<?php echo route_to('zimmer.edit', $room->id)?>">
                <div class="block">
                    <div class="block-content">

                        <?php if(isset($errors) && !empty($errors)): ?>
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?= csrf_field() ?>
                        <div class="mb-2">
                            <label for="name">Name <span class="text-red">*</span></label>
                            <input class="form-control <?php if(session('errors.name')) : ?>is-invalid<?php endif ?>" name="name" id="name" type="text"  value="<?= $room->name ?>" <?= (!has_permission('zimmer.edit'))? 'disabled' : ''; ?>>
                            <div class="invalid-feedback"><?= session('errors.name') ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="capacity">Kapazität <span class="text-red">*</span></label>
                            <input class="form-control <?php if(session('errors.capacity')) : ?>is-invalid<?php endif ?>" name="capacity" id="capacity" type="text" value="<?= $room->capacity ?>" <?= (!has_permission('zimmer.edit'))? 'disabled' : ''; ?>>
                            <div class="invalid-feedback"><?= session('errors.capacity') ?></div>
                        </div>
                        <?php if(has_permission('zimmer.edit')):?>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Speichern
                            </button>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card mb-3">
                <div class="card-body">
                    <?php if(has_permission('zimmer.assign')): ?>
                        <div class="input-group mb-3">
                            <select class="js-select2 form-select" id="room_add_member" >

                            </select>
                            <button class="btn btn-outline-secondary" data-room="<?= $room->id ?>" id="room_add_member_button" type="button">Hinzufügen</button>
                        </div>
                    <?php endif; ?>

                    <ul class="list-group" id="room_member_list" data-room="<?= $room->id ?>">

                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>






