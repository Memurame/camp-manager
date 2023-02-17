<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Gesendete Mails
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Überischt über alle bereits versendeten Mails
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Gesendete Mails
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
            <table class="table table-bordered table-striped table-vcenter" id="mail_sent" style="width: 100%">
                <thead>
                    <tr>
                        <th class="all">Datum</th>
                        <th class="all">Betreff</th>
                        <th>Empfänger</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $mail): ?>
                    <tr>
                        <td><?= date("d.m.Y H:i", $mail['sent']) ?></td>
                        <td><?= $mail['subject'] ?></td>
                        <td><?= $mail['count'] ?></td>
                        <td class="text-end">
                            <a href="<?php echo route_to('mail.detail',$mail['time'])?>"
                                class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>