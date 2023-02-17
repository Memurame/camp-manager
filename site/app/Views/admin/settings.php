<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Einstellungen
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Seiten Einstellungen festlegen
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Einstellungen
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Content -->
<div class="content">
    <form action="<?= route_to('settings') ?>" method="POST">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Allgemeine Einstellungen</h3>
            </div>
            <div class="block-content">
                <?= csrf_field() ?>
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Hier sind alle Allgemeinen Seiten Einstellungen, die geändert werden können.
                            <br><br>
                            <strong class="text-danger">Aktives Formular: </strong> Änderungen können zur folge haben
                            das die Anmeldungen nicht mehr korrekt funktionieren.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="mb-4">
                            <label class="form-label" for="site_title">Titel</label>
                            <input type="text"
                                class="form-control <?php if(session('errors.site_title')) : ?>is-invalid<?php endif ?>"
                                id="site_title" name="site_title" value="<?= settings()->read('site.title') ?>">
                            <div class="invalid-feedback"><?= session('errors.site_title') ?></div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="registration_form">Aktives Formular</label>
                            <select name="registration_form" id="registration_form" class="form-select">
                                <?php
                                    foreach($forms as $form){
                                        $active = (settings()->read('registration.form') == $form->name) ? 'selected' : '';
                                        echo'<option value="'. $form->name .'" '. $active .'>' . $form->title . '</option>';
                                    }
                                    ?>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.auth_allowRemember') ?></div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="registration_allowRegistration">Formularanmeldungen</label>
                            <select name="registration_allowRegistration" id="registration_allowRegistration"
                                class="form-select">
                                <option value="0"
                                    <?= (!settings()->read('registration.allowRegistration')) ? 'selected' : '' ?>>Nicht
                                    erlauben</option>
                                <option value="1"
                                    <?= (settings()->read('registration.allowRegistration')) ? 'selected' : '' ?>>
                                    Erlauben</option>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.auth_allowRegister') ?></div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-alt-success">
                                Speichern
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">E-Mail Einstellungen</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Diverse Mail Einstellungen
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="mb-4">
                            <label class="form-label" for="email_fromMail">Absender Adresse</label>
                            <input type="text"
                                class="form-control <?php if(session('errors.email_fromMail')) : ?>is-invalid<?php endif ?>"
                                id="email_fromMail" name="email_fromMail"
                                value="<?= settings()->read('email.fromMail') ?>">
                            <div class="invalid-feedback"><?= session('errors.email_fromMail') ?></div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="email_fromName">Absender Name</label>
                            <input type="text"
                                class="form-control <?php if(session('errors.email_fromName')) : ?>is-invalid<?php endif ?>"
                                id="email_fromName" name="email_fromName"
                                value="<?= settings()->read('email.fromName') ?>">
                            <div class="invalid-feedback"><?= session('errors.email_fromName') ?></div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-alt-success">
                                Speichern
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Authorization</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Einstellungen zum Login und der ganzen Authorization<br><br>
                            <strong class="text-danger">Änderungen nur für fortgeschritene. Einige Änderungen können zur
                                Folge haben das die Seite nicht mehr funktioniert oder du dich aussperrst!!</strong>
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="mb-4">
                            <label class="form-label" for="auth_groupOwner">Standartgruppe für Owner</label>
                            <input type="text"
                                class="form-control <?php if(session('errors.email_fromMail')) : ?>is-invalid<?php endif ?>"
                                id="auth_groupOwner" name="auth_groupOwner"
                                value="<?= settings()->read('auth.ownerGroup') ?>">
                            <div class="invalid-feedback"><?= session('errors.auth_groupOwner') ?></div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="auth_groupUser">Standartgruppe für User</label>
                            <input type="text"
                                class="form-control <?php if(session('errors.auth_groupUser')) : ?>is-invalid<?php endif ?>"
                                id="auth_groupUser" name="auth_groupUser"
                                value="<?= settings()->read('auth.defaultUserGroup') ?>">
                            <div class="invalid-feedback"><?= session('errors.auth_groupUser') ?></div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="auth_allowRegister">Registrierung</label>
                            <select name="auth_allowRegistration" id="auth_allowRegistration" class="form-select">
                                <option value="0"
                                    <?= (!settings()->read('auth.allowRegistration')) ? 'selected' : '' ?>>Nicht
                                    erlauben</option>
                                <option value="1" <?= (settings()->read('auth.allowRegistration')) ? 'selected' : '' ?>>
                                    Erlauben</option>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.auth_allowRegister') ?></div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="auth_allowRemember">Angemeldet bleiben</label>
                            <select name="auth_allowRemember" id="auth_allowRemember" class="form-select">
                                <option value="0" <?= (!settings()->read('auth.allowRemembering')) ? 'selected' : '' ?>>
                                    Nicht erlauben</option>
                                <option value="1" <?= (settings()->read('auth.allowRemembering')) ? 'selected' : '' ?>>
                                    Erlauben</option>
                            </select>
                            <div class="invalid-feedback"><?= session('errors.auth_allowRemember') ?></div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="auth_minLengthPasswords">Mindestlänge für Passwörter</label>
                            <input type="number"
                                class="form-control <?php if(session('errors.auth_minLengthPasswords')) : ?>is-invalid<?php endif ?>"
                                id="auth_minLengthPasswords" name="auth_minLengthPasswords"
                                value="<?= settings()->read('auth.minimumPasswordLength') ?>">
                            <div class="invalid-feedback"><?= session('errors.auth_minLengthPasswords') ?></div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-alt-success">
                                Speichern
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="<?= route_to('settings.delete') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Daten löschen</h3>
            </div>
            <div class="block-content">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="fs-sm text-muted">
                            Seite komplet zurücksetzen, dabei werden alle Daten gelöscht, inkl. Benutzer und
                            Gruppen.<br><br>
                            <strong class="text-danger">Die Löschung kann nicht rückgängig gemacht werden, die Daten
                                sind entgültig gelöscht.</strong>
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-check pb-4">
                            <input class="form-check-input" type="checkbox" value="1" id="delete_confirm"
                                name="delete_confirm">
                            <label class="form-check-label" for="delete_confirm">Löschung bestätigen</label>
                        </div>
                        <button class="btn btn-alt-danger">Daten jetzt Löschen</button>
                    </div>
                </div>
            </div>
    </form>

</div>
<?= $this->endSection() ?>