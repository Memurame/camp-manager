<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Benutzer bearbeiten
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Bearbeiten eines Benutzer
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
                        Bearbeiten
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <form method="POST" action="<?php echo route_to('user.edit',$user->id)?>">
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Benutzerdaten</h3>
                    </div>
                    <div class="block-content">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="name">Anzeigename</label><input
                                class="form-control <?php if(session('errors.name')) : ?>is-invalid<?php endif ?>"
                                name="name" id="name" type="text" value="<?= $user->name ?>">
                            <div class="invalid-feedback"><?= session('errors.name') ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label><input
                                class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>"
                                name="username" id="username" type="text" value="<?= $user->username ?>">
                            <div class="invalid-feedback"><?= session('errors.username') ?></div>
                        </div>
                        <div class="mb-4">
                            <label for="email">Mail</label><input
                                class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                name="email" id="email" type="text" value="<?= $user->email ?>">
                            <div class="invalid-feedback"><?= session('errors.email') ?></div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="force_reset_password"
                                    name="force_reset_password">
                                <label class="form-check-label" for="force_reset_password">Erzwinge Password
                                    änderung</label>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3"><label for="access">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="active" <?=(!$user->status) ? 'selected' : ''?>>Aktiv</option>
                                <option value="banned" <?=($user->status == 'banned') ? 'selected' : ''?>>Gesperrt
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-alt-primary">
                                Speichern
                            </button>
                        </div>


                    </div>
                </div>
            </div>
            <?php if((has_permission('user.permissions') and (!array_key_exists($defaultGroups['owner'], $user->roles) OR (array_key_exists($defaultGroups['owner'], $user->roles) AND array_key_exists($defaultGroups['owner'], user()->roles))))): ?>
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Berechtigung</h3>
                    </div>
                    <div class="block-content">
                        <div class="mb-3"><label for="role">Gruppen</label>
                            <select
                                class="js-select2 form-select <?php if(session('errors.role')) : ?>is-invalid<?php endif ?>"
                                style="width: 100%;" data-placeholder="Choose many.." multiple name="role[]" id="role"
                                <?= ((array_key_exists($defaultGroups['owner'], $user->roles) AND !array_key_exists($defaultGroups['owner'], user()->roles))) ? 'disabled' : '' ?>>
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <?php foreach ($groups as $role): ?>
                                <?php if(($role->id == $defaultGroups['owner'] && array_key_exists($defaultGroups['owner'], user()->roles)) OR $role->id != $defaultGroups['owner']): ?>
                                <option value="<?= esc($role->id) ?>"
                                    <?=(array_key_exists($role->id,$user->roles)) ? 'selected' : ''?>>
                                    <?= esc($role->name) ?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.role') ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </form>
</div>

<?= $this->endSection() ?>