<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
    <div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Nachrichten Details
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Betrachten der Details dieser E-Mail
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo route_to('mail.sent')?>">Gesendete Mails</a>
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
            <div class="mb-3 row">
                <label for="input_sender" class="col-sm-2 col-form-label">Absender</label>
                <div class="col-sm-10">
                    <input type="text" value="<?= $mail['reply_to'] ?>" placeholder="<?= settings()->read('email.fromMail') ?>" class="form-control" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="input_sender" class="col-sm-2 col-form-label">Empfänger</label>
                <div class="col-sm-10">
                    <select class="js-select2 form-select" style="width: 100%;" multiple disabled>
                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                        <?php foreach($mail['to'] as $to): ?>
                            <option selected><?= $to ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="input_sender" class="col-sm-2 col-form-label">Betreff</label>
                <div class="col-sm-10">
                    <input type="text" value="<?= $mail['subject'] ?>" class="form-control" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="input_sender" class="col-sm-2 col-form-label">Inhalt</label>
                <div class="col-sm-10">
                    <div class="border p-2"><?= $mail['text'] ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>