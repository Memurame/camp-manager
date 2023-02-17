<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Neuer Teilnehmer
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Erstellen eines neuen Teilnehmer
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a class="link-fx" href="<?php echo route_to("anmeldungen")?>">Anmeldungen</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Neu
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Content -->
<div class="content">
    <!-- Your Block -->
    <form method="POST" action="<?php echo route_to('anmeldungen.add')?>">
        <div class="block block-rounded">

            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Personalien
                </h3>
                <div class="block-options">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-save"></i> Speichern
                    </button>
                </div>
            </div>

            <div class="block-content block-content-full">
                <div class="row g-3">
                    <?= csrf_field() ?>
                    <div class="col-md-6">
                        <label for="firstname">Vorname <span class="text-danger">*</span></label>
                        <input class="form-control <?php if(session('errors.firstname')) : ?>is-invalid<?php endif ?>"
                            name="firstname" id="firstname" type="text" value="<?=$person->firstname ?>">
                        <div class="invalid-feedback"><?= session('errors.firstname') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label for="lastname">Nachname <span class="text-danger">*</span></label>
                        <input class="form-control <?php if(session('errors.lastname')) : ?>is-invalid<?php endif ?>"
                            name="lastname" id="lastname" type="text" value="<?=$person->lastname ?>">
                        <div class="invalid-feedback"><?= session('errors.lastname') ?></div>
                    </div>
                    <div class="col-md-9">
                        <label for="street">Strasse <span class="text-danger">*</span></label>
                        <input class="form-control <?php if(session('errors.street')) : ?>is-invalid<?php endif ?>"
                            name="street" id="street" type="text" value="<?=$person->street ?>">
                        <div class="invalid-feedback"><?= session('errors.street') ?></div>
                    </div>
                    <div class="col-md-3">
                        <label for="street_nr">Hausnummer <span class="text-danger">*</span></label>
                        <input class="form-control <?php if(session('errors.street_nr')) : ?>is-invalid<?php endif ?>"
                            name="street_nr" id="street_nr" type="text" value="<?=$person->street_nr ?>">
                        <div class="invalid-feedback"><?= session('errors.street_nr') ?></div>
                    </div>
                    <div class="col-md-3">
                        <label for="postcode">PLZ <span class="text-danger">*</span></label>
                        <input class="form-control <?php if(session('errors.postcode')) : ?>is-invalid<?php endif ?>"
                            name="postcode" id="postcode" type="text" value="<?=$person->postcode ?>">
                        <div class="invalid-feedback"><?= session('errors.postcode') ?></div>
                    </div>
                    <div class="col-md-9">
                        <label for="location">Ort <span class="text-danger">*</span></label>
                        <input class="form-control <?php if(session('errors.location')) : ?>is-invalid<?php endif ?>"
                            name="location" id="location" type="text" value="<?=$person->location ?>">
                        <div class="invalid-feedback"><?= session('errors.location') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label for="phone">Telefon <span class="text-danger">*</span></label>
                        <input class="form-control <?php if(session('errors.phone')) : ?>is-invalid<?php endif ?>"
                            name="phone" id="phone" type="tel" value="<?=$person->phone ?>">
                        <div class="invalid-feedback"><?= session('errors.phone') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Mail <span class="text-danger">*</span></label>
                        <input class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                            name="email" id="email" type="email" value="<?=$person->email ?>">
                        <div class="invalid-feedback"><?= session('errors.email') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label for="birthday">Geburtstag <span class="text-danger">*</span></label>
                        <input class="form-control <?php if(session('errors.birthday')) : ?>is-invalid<?php endif ?>"
                            name="birthday" id="birthday" type="date" value="<?=$person->birthday ?>">
                        <div class="invalid-feedback"><?= session('errors.birthday') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label for="team">Team <span class="text-danger">*</span></label>
                        <select class="form-select<?php if(session('errors.team')) : ?>is-invalid<?php endif ?>"
                            name="team" id="team">
                            <option value="0" selected>-- Kein Team --</option>
                            <?php foreach ($teams as $team): ?>
                            <option value="<?= $team->id ?>" <?= ($person->team_id == $team->id) ? 'selected' : '' ?>>
                                <?= $team->name ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback"><?= session('errors.team') ?></div>
                    </div>
                </div>

            </div>

        </div>

        <?php foreach($formFields['sections'] as $section): ?>
        <div class="block block-rounded">

            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <?= $section['title'] ?>
                </h3>
                <div class="block-options">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-save"></i> Speichern
                    </button>
                </div>
            </div>

            <div class="block-content block-content-full">
                <div class="row g-3">
                    <?php foreach($section['fields'] as $fieldName => $field): ?>
                    <?php if($field['type'] == "text"): ?>
                    <div class="<?= (isset($field['outerClass'])) ? $field['outerClass'] : null ?>">
                        <label class="form-label" for="<?= $fieldName ?>"><?=$field['title'] ?>
                            <?php if(isset($field['required']) && $field['required']): ?><span
                                class="text-danger">*</span><?php endif; ?></label>
                        <input
                            class="form-control<?php if(session('errors.' .$fieldName)) : ?> is-invalid<?php endif ?> <?= (isset($field['inputClass'])) ? $field['inputClass'] : null ?>"
                            name="<?= $fieldName ?>" id="<?= $fieldName ?>" type="text"
                            value="<?=$person->data->{$fieldName} ?>">
                        <div class="invalid-feedback"><?= session('errors.' .$fieldName) ?></div>
                        <?php if(isset($field['desc'])): ?>
                        <div class="form-text text-primary"><?=$field['desc'] ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if($field['type'] == "select"): ?>
                    <div class="<?= (isset($field['outerClass'])) ? $field['outerClass'] : null ?>">
                        <label class="form-label" for="<?= $fieldName ?>"><?=$field['title'] ?>
                            <?php if(isset($field['required']) && $field['required']): ?><span
                                class="text-danger">*</span><?php endif; ?></label>
                        <select
                            class="form-select<?php if(session('errors.' .$fieldName)) : ?> is-invalid<?php endif ?> <?= (isset($field['inputClass'])) ? $field['inputClass'] : null ?>"
                            name="<?= $fieldName ?>" id="<?= $fieldName ?>">
                            <?php
                                            foreach($field['option'] as $value => $name){
                                                echo '<option value="'.$value.'" '.(($person->data->{$fieldName} == $value) ? 'selected' : null) .'>'.$name.'</option>';
                                            }
                                        ?>
                        </select>
                        <div class="invalid-feedback"><?= session('errors.' .$fieldName) ?></div>
                        <?php if(isset($field['desc'])): ?>
                        <div class="form-text text-primary"><?=$field['desc'] ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if($field['type'] == "textarea"): ?>
                    <div class="<?= (isset($field['outerClass'])) ? $field['outerClass'] : null ?>">
                        <label class="form-label" for="<?= $fieldName ?>"><?=$field['title'] ?>
                            <?php if(isset($field['required']) && $field['required']): ?><span
                                class="text-danger">*</span><?php endif; ?></label>
                        <textarea
                            class="form-control<?php if(session('errors.' .$fieldName)) : ?> is-invalid<?php endif ?> <?= (isset($field['inputClass'])) ? $field['inputClass'] : null ?>"
                            name="<?= $fieldName ?>" id="<?= $fieldName ?>"
                            rows="4"><?=$person->data->{$fieldName} ?></textarea>
                        <div class="invalid-feedback"><?= session('errors.' .$fieldName) ?></div>
                        <?php if(isset($field['desc'])): ?>
                        <div class="form-text text-primary"><?=$field['desc'] ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if($field['type'] == "checkbox"): ?>
                    <div class="<?= (isset($field['outerClass'])) ? $field['outerClass'] : null ?>">
                        <label class="form-label d-block"><?=$field['title'] ?>
                            <?php if(isset($field['required']) && $field['required']): ?><span
                                class="text-danger">*</span><?php endif; ?></label>
                        <?php foreach($field['option'] as $key => $value): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="<?= $key ?>"
                                id="<?= $fieldName ?>[<?= $key ?>]" name="<?= $fieldName ?>[]"
                                <?=($person->data->{$fieldName} != null && in_array($key, $person->data->{$fieldName})) ? 'checked' : null ?>>
                            <label class="form-check-label" for="<?= $fieldName ?>[<?= $key ?>]"><?= $value ?></label>
                        </div>
                        <?php endforeach; ?>
                        <div class="invalid-feedback"><?= session('errors.' .$fieldName) ?></div>
                        <?php if(isset($field['desc'])): ?>
                        <div class="form-text text-primary"><?=$field['desc'] ?></div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </form>
</div>



<?= $this->endSection() ?>