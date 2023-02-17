<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Neue E-Mail
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Erstellen einer neuen E-Mail
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Mail Versand
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
    <div class="block block-rounded">
        <div class="block-content">
            <form method="POST" action="<?=route_to('mail')?>">
                <?= csrf_field() ?>
                <?php if(isset($errors) && !empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if(session()->getFlashdata('mail_error')):
                    echo '<div class="alert alert-danger" role="alert"><ul class="mb-0">';
                    foreach(session()->getFlashdata('mail_error') as $value){
                        echo '<li>' . $value['name'] . ' - ' . $value['msg'] . '</li>';
                    }
                    echo '</ul></div>';
                endif;?>
                <div class="mb-3 row">
                    <label for="input_sender" class="col-sm-2 col-form-label">Absender</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?= ($entwurf) ? $entwurf['reply_to'] : old('input_sender'); ?>"
                            placeholder="<?=settings()->read('email.fromMail')?>" id="input_sender" name="input_sender"
                            class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="input_subject" class="col-sm-2 col-form-label">Betreff</label>
                    <div class="col-sm-10">
                        <input value="<?= ($entwurf) ? $entwurf['subject'] : old('input_subject'); ?>" type="text"
                            class="form-control <?php if(session('errors.input_subject')) : ?>is-invalid<?php endif ?>"
                            name="input_subject" id="input_subject">
                        <div class="invalid-feedback"><?= session('errors.input_subject') ?></div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="input_text" class="col-sm-2 col-form-label">Nachricht</label>
                    <div class="col-sm-10">
                        <textarea rows="10" name="input_text" id="input_mail_text"
                            class="js-simplemde form-control <?php if(session('errors.input_text')) : ?>is-invalid<?php endif ?>"><?= ($entwurf) ? $entwurf['text'] : old('input_text'); ?></textarea>
                        <div class="invalid-feedback"><?= session('errors.input_text') ?></div>
                    </div>
                </div>
                <hr>
                <div class="mb-3 row">
                    <label for="input_subject" class="col-sm-2 col-form-label">Empfänger</label>
                    <div class="col-sm-10">
                        <div class="alert alert-info">
                            Hier können ganze Teams als Empfänger ausgewählt werden.<br>
                            Es können jedoch auch nur einzelne Personen als Empfänger gewählt werden.<br>
                            <strong>Es werden keine Mails doppelt verschickt.</strong>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Teams auswählen..." multiple name="selectGroup[]"
                                    id="selectGroup">
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <?php foreach($teams as $key => $team): ?>
                                    <option value="<?= esc($team->id) ?>"><?= $team->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Personen auswählen..." multiple name="persons[]" id="persons">
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <?php foreach ($persons as $person): ?>
                                    <option value="<?= esc($person->id) ?>"><?= $person->firstname ?>
                                        <?= $person->lastname ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="offset-sm-2 col-sm-10">
                        <div class="d-flex justify-content-between flex-md-row flex-column">
                            <div class="">
                                <button type="submit" class="btn btn-alt-primary">
                                    Senden
                                </button>
                            </div>
                            <div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="save_name"
                                        placeholder="Speichern als...">
                                    <button type="submit" class="btn btn-alt-secondary"
                                        formaction="<?=route_to('mail.save')?>">Speichern</button>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>