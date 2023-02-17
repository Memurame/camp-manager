<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="content">
    <div
        class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
        <div class="flex-grow-1 mb-1 mb-md-0">
            <h1 class="h3 fw-bold mb-2">
                Übersicht
            </h1>
            <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                Willkommen <?= user()->name ?>
            </h2>
        </div>
        <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
            <a class="btn btn-sm btn-alt-secondary space-x-1" href="<?=route_to('profile') ?>">
                <i class="fa fa-cogs opacity-50"></i>
                <span>Mein Profil</span>
            </a>
        </div>
    </div>

</div>



<div class="content">
    <div class="row items-push">
        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold"><?= $stats['teilnehmer'] ?></dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Teilnehmer</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="si si-people fs-3 text-primary"></i>
                    </div>
                </div>
                <?php if(has_permission('anmeldungen.show')): ?>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                        href="<?=route_to('anmeldungen') ?>">
                        <span>Alle Teilnehmer anzeigen</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold"><?= $stats['chf'] ?></dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Lagerbeiträge</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa fa-money-bill-wave fs-3 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold"><?= $stats['material'] ?></dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Materialien</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa-solid fa-list-check fs-3 text-primary"></i>
                    </div>
                </div>
                <?php if(has_permission('matlist.show')): ?>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                        href="<?=route_to('material') ?>">
                        <span>Alle Materialien anzeigen</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold"><?= $stats['room'] ?></dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Zimmer</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="fa-solid fa-bed fs-3 text-primary"></i>
                    </div>
                </div>
                <?php if(has_permission('zimmer.show')): ?>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                        href="<?=route_to('zimmer') ?>">
                        <span>Alle Zimmer anzeigen</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>





    </div>
    <div class="row gutters-sm">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    Hier eine übersicht über die Anzahl der Anmeldungen
                    <hr>
                    <ul class="list-group">
                        <?php foreach($teams as $team): if($team->name != 'TEST'):?>
                        <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                            <?php
                                if(has_permission('anmeldungen.show')): ?>
                            <a href="<?php echo route_to('anmeldungen') .'?team='. $team->id?>"
                                class="text-black text-decoration-underline">
                                <?= $team->name ?>
                            </a>
                            <?php else: ?>
                            <?= $team->name ?>
                            <?php endif; ?>
                            <span class="badge badge bg-dark rounded-pill"><?= $team->count ?></span>
                        </li>

                        <?php endif; endforeach; ?>
                        <li
                            class="list-group-item list-group-item-dark d-flex justify-content-between align-items-start  border-0">
                            Gesamt
                            <span class="badge badge bg-dark rounded-pill"><?= $stats['teilnehmer'] ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>