<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Benutzergruppe bearbeiten
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Bearbeiten einer Benutzergruppe
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a class="link-fx" href="<?php echo base_url('benutzergruppe')?>">Benutzergruppe</a>
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
    <form method="POST" action="<?php echo route_to('group.edit', $group->id)?>">
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Gruppeninfo</h3>
                    </div>
                    <div class="block-content">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="username">Name</label><input
                                class="form-control <?php if(session('errors.name')) : ?>is-invalid<?php endif ?>"
                                name="name" id="name" type="text" value="<?= $group->name ?>"
                                <?=(in_array($group->id, $defaultGroups) ? 'readonly' : '') ?>>
                            <div class="invalid-feedback"><?= session('errors.name') ?></div>
                        </div>
                        <div class="mb-4">
                            <label for="email">Beschreibung</label><input
                                class="form-control <?php if(session('errors.description')) : ?>is-invalid<?php endif ?>"
                                name="description" id="description" type="text" value="<?= $group->description ?>">
                            <div class="invalid-feedback"><?= session('errors.description') ?></div>
                        </div>
                        <div class="mb-4">
                            <label for="email">Systemmails</label>
                            <select name="systemmails" id="systemmails" class="form-select">
                                <option value="0" <?= (!$group->mails) ? 'selected' : ''?>>Nein</option>
                                <option value="1" <?= ($group->mails) ? 'selected' : ''?>>Ja</option>
                            </select>
                            <div class="form-text text-primary">Die Benutzer dieser Gruppe erhalten u.a
                                Benachrichtigungen über neue Anmeldungen wie auch über allfällige Fehlermeldungen.
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-alt-primary">
                                Speichern
                            </button>
                        </div>


                    </div>
                </div>
            </div>
            <?php if(service('settings')->read('auth.ownerGroup') != $group->name): ?>
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Berechtigung</h3>
                    </div>
                    <div class="block-content">
                        <div class="mb-3">
                            <div class="space-y-2">
                                <?php foreach ($permissions as $permission): ?>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="true"
                                        id="permission[<?=$permission['id'] ?>]"
                                        name="permission[<?=$permission['id'] ?>]"
                                        <?= (array_key_exists($permission['id'],$groupPermissions)) ? 'checked' : ''; ?>>
                                    <label class="form-check-label"
                                        for="permission[<?=$permission['id'] ?>]"><?=$permission['description'] ?></label>
                                </div>

                                <?php endforeach; ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <?php endif; ?>
        </div>
    </form>
</div>

<?= $this->endSection() ?>