<?= $this->extend('public/layout') ?>
<?= $this->section('main') ?>
<div>
    <div class="w-100 position-relative">
        <a class="fw-semibold text-dual" href="<?php echo base_url()?>">
            <span class="position-absolute fs-5 tracking-wider" style="left: 30px; top: 30px">Camp<span
                    class="fw-normal">Manager</span></span>
        </a>
        <div class="bg-body-extra-light pt-5">
            <div class="content content-full">
                <div class="row g-0 justify-content-center">
                    <div class="col-md-12 col-xl-8 py-4 px-4 px-lg-5">
                        <!-- Header -->
                        <div class="text-center">
                            <h1 class="h4  mb-1">
                                <?= $form->title ?>
                            </h1>
                            <?php if($form->description): ?>
                            <p class="text-muted mb-3">
                                <?= $form->description ?>
                            </p>
                            <?php endif ?>
                        </div>
                        <!-- END Header -->

                        <form method="POST">
                            <?= csrf_field() ?>
                            <div class="row py-3">
                                <div class="col-12 mb-4">
                                    <label class="form-label" for="firstname">Vorname</label>
                                    <input
                                        class="form-control form-control-lg form-control-alt <?php if(session('errors.firstname')) : ?>is-invalid<?php endif ?>"
                                        name="firstname" id="firstname" type="text" value="<?=old('firstname') ?>">
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label" for="lastname">Nachname</label>
                                    <input
                                        class="form-control form-control-lg form-control-alt <?php if(session('errors.lastname')) : ?>is-invalid<?php endif ?>"
                                        name="lastname" id="lastname" type="text" value="<?=old('lastname') ?>">
                                </div>
                                <div class="col-12 col-lg-9 mb-4">
                                    <label class="form-label" for="street">Strasse</label>
                                    <input
                                        class="form-control form-control-lg form-control-alt <?php if(session('errors.street')) : ?>is-invalid<?php endif ?>"
                                        name="street" id="street" type="text" value="<?=old('street') ?>">
                                </div>
                                <div class="col-12 col-lg-3 mb-4">
                                    <label class="form-label" for="street">Hausnummer</label>
                                    <input
                                        class="form-control form-control-lg form-control-alt <?php if(session('errors.street_nr')) : ?>is-invalid<?php endif ?>"
                                        name="street_nr" id="street_nr" type="text" value="<?=old('street_nr') ?>">
                                </div>
                                <div class="col-4 mb-4">
                                    <label class="form-label" for="postcode">PLZ</label>
                                    <input
                                        class="form-control form-control-lg form-control-alt <?php if(session('errors.postcode')) : ?>is-invalid<?php endif ?>"
                                        name="postcode" id="postcode" type="text" value="<?=old('postcode') ?>">
                                </div>
                                <div class="col-8 mb-4">
                                    <label class="form-label" for="location">Ort</label>
                                    <input
                                        class="form-control form-control-lg form-control-alt <?php if(session('errors.location')) : ?>is-invalid<?php endif ?>"
                                        name="location" id="location" type="text" value="<?=old('location') ?>">
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label" for="phone">Telefon</label>
                                    <input
                                        class="form-control form-control-lg form-control-alt <?php if(session('errors.phone')) : ?>is-invalid<?php endif ?>"
                                        name="phone" id="phone" type="text" value="<?=old('phone') ?>">
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label" for="email">E-Mail</label>
                                    <input
                                        class="form-control form-control-lg form-control-alt <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                        name="email" id="email" type="text" value="<?=old('email') ?>">
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label" for="birthday">Geburtstag</label>
                                    <input
                                        class="form-control form-control-lg form-control-alt <?php if(session('errors.birthday')) : ?>is-invalid<?php endif ?>"
                                        name="birthday" id="birthday" type="date" value="<?=old('birthday') ?>">
                                </div>
                            </div>
                            <?php foreach($formFields['sections'] as $section): ?>
                            <hr>
                            <div class="row py-3">
                                <?php foreach($section['fields'] as $fieldName => $field): ?>
                                <?php if($field['type'] == "text"): ?>
                                <div class="pb-3 <?= (isset($field['outerClass'])) ? $field['outerClass'] : null ?>">
                                    <label class="form-label" for="<?= $fieldName ?>"><?=$field['title'] ?>
                                        <?php if(isset($field['required']) && $field['required']): ?><span
                                            class="text-danger">*</span><?php endif; ?></label>
                                    <input
                                        class="form-control form-control-lg form-control-alt<?php if(session('errors.' .$fieldName)) : ?> is-invalid<?php endif ?> <?= (isset($field['inputClass'])) ? $field['inputClass'] : null ?>"
                                        name="<?= $fieldName ?>" id="<?= $fieldName ?>" type="text"
                                        value="<?=old($fieldName) ?>">
                                    <div class="invalid-feedback"><?= session('errors.' .$fieldName) ?></div>
                                    <?php if(isset($field['desc'])): ?>
                                    <div class="form-text text-primary"><?=$field['desc'] ?></div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>

                                <?php if($field['type'] == "select"): ?>
                                <div class="pb-3 <?= (isset($field['outerClass'])) ? $field['outerClass'] : null ?>">
                                    <label class="form-label" for="<?= $fieldName ?>"><?=$field['title'] ?>
                                        <?php if(isset($field['required']) && $field['required']): ?><span
                                            class="text-danger">*</span><?php endif; ?></label>
                                    <select
                                        class="form-select form-control-lg form-control-alt<?php if(session('errors.' .$fieldName)) : ?> is-invalid<?php endif ?> <?= (isset($field['inputClass'])) ? $field['inputClass'] : null ?>"
                                        name="<?= $fieldName ?>" id="<?= $fieldName ?>">
                                        <?php
                                                    foreach($field['option'] as $value => $name){
                                                        echo '<option value="'.$value.'">'.$name.'</option>';
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
                                <div class="pb-3 <?= (isset($field['outerClass'])) ? $field['outerClass'] : null ?>">
                                    <label class="form-label" for="<?= $fieldName ?>"><?=$field['title'] ?>
                                        <?php if(isset($field['required']) && $field['required']): ?><span
                                            class="text-danger">*</span><?php endif; ?></label>
                                    <textarea
                                        class="form-control form-control-lg form-control-alt<?php if(session('errors.' .$fieldName)) : ?> is-invalid<?php endif ?> <?= (isset($field['inputClass'])) ? $field['inputClass'] : null ?>"
                                        name="<?= $fieldName ?>" id="<?= $fieldName ?>"
                                        rows="4"><?=old($fieldName) ?></textarea>
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
                                            id="<?= $fieldName ?>[<?= $key ?>]" name="<?= $fieldName ?>[]">
                                        <label class="form-check-label"
                                            for="<?= $fieldName ?>[<?= $key ?>]"><?= $value ?></label>
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
                            <?php endforeach; ?>
                            <div class="row justify-content-center">
                                <div class="col-lg-6 col-xxl-5">
                                    <button type="submit" class="btn w-100 btn-alt-success">
                                        Absenden
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- END Sign Up Form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Sign Up Section -->

        <!-- Footer -->
        <div class="fs-sm text-center text-muted py-3">
            created by <a class="fw-semibold" href="https://github.com/Memurame/camp-manager"
                target="_blank">Memurame</a>
        </div>
        <!-- END Footer -->
    </div>


</div>
<!-- END Page Content -->
<?= $this->endSection() ?>