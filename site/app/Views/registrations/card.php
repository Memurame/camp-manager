<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Anmeldungen
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Übersicht der angemeldeten Teilnehmer
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Anmeldungen
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">

        <div class="mb-3 d-flex justify-content-end">
            <?php if(has_permission('anmeldungen.export')): ?>
                <a href="<?php echo base_url('anmeldungen/export')?>" type="button" class="btn btn-alt-primary me-1 mb-3">
                    <i class="fa-solid fa-file-csv"></i> CSV-Export
                </a>
            <?php endif; ?>
            <?php if(has_permission('anmeldungen.stack')): ?>
                <a href="<?php echo base_url('anmeldungen/stack')?>" type="button" class="btn btn-alt-primary me-1 mb-3">
                    <i class="fa-solid fa-layer-group"></i> Stapelverarbeitung
                </a>
            <?php endif; ?>
            <?php if(has_permission('anmeldungen.create')): ?>
                <a href="<?php echo base_url('anmeldungen/add')?>" type="button" class="btn btn-alt-primary me-1 mb-3">
                    <i class="fa-solid fa-plus"></i> Neue Person
                </a>
            <?php endif; ?>
        </div>

    <!-- Your Block -->
    <div class="block block-rounded">

        <div class="block-content block-content-full">
            <div class="d-flex justify-content-between pb-3">
                <div>
                    <a href="<?php echo route_to('anmeldungen')?>?view=<?= $view ?>" class="btn btn-outline-dark <?php echo(!isset($getData['team'])) ? 'active' : ''; ?> btn-sm" type="button">ALLE</a>
                    <a href="<?php echo route_to('anmeldungen')?>?team=1&view=<?= $view ?>" class="btn btn-outline-primary btn-sm <?php echo(isset($getData['team']) && $getData['team'] == 1) ? 'active' : ''; ?>" type="button">Kleinkinder</a>
                    <a href="<?php echo route_to('anmeldungen')?>?team=2&view=<?= $view ?>" class="btn btn-outline-primary btn-sm <?php echo(isset($getData['team']) && $getData['team'] == 2) ? 'active' : ''; ?>" type="button">Kids</a>
                    <a href="<?php echo route_to('anmeldungen')?>?team=3&view=<?= $view ?>" class="btn btn-outline-primary btn-sm <?php echo(isset($getData['team']) && $getData['team'] == 3) ? 'active' : ''; ?>" type="button">Jugend</a>
                    <a href="<?php echo route_to('anmeldungen')?>?team=4&view=<?= $view ?>" class="btn btn-outline-primary btn-sm <?php echo(isset($getData['team']) && $getData['team'] == 4) ? 'active' : ''; ?>" type="button">Erwachsen</a>
                    <a href="<?php echo route_to('anmeldungen')?>?team=5&view=<?= $view ?>" class="btn btn-outline-primary btn-sm <?php echo(isset($getData['team']) && $getData['team'] == 5) ? 'active' : ''; ?>" type="button">Mitarbeiter</a>
                </div>
                <div>
                    <a href="<?php echo route_to('anmeldungen')?>?<?php if(isset($getData['team'])) echo 'team='. $getData['team'] .'&'; ?>view=card" class="btn btn-dark btn-sm"><i class="fa-solid fa-grip-vertical"></i></a>
                    <a href="<?php echo route_to('anmeldungen')?>?<?php if(isset($getData['team'])) echo 'team='. $getData['team'] .'&'; ?>view=list" class="btn btn-light btn-sm"><i class="fa-solid fa-bars"></i></a>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach ($personen as $person): ?>
                <?php

                $geburtstag = new DateTime($person->birthday);
                $heute = new DateTime(date('Y-m-d'));
                $differenz = $geburtstag->diff($heute);
                ?>
                <div class="col">
                    <div class="block block-rounded" style="border: 1px solid lightgrey">
                        <div class="block-header block-header-default">
                            <h3 class="block-title"><?= $person->lastname ?> <?= $person->firstname?></h3>
                            <div class="block-options">
                                <?php if(has_permission('anmeldungen.show')): ?>
                                    <a href="<?php echo route_to('anmeldungen.detail',$person->id) ?>" type="button" class="btn btn-sm btn-secondary"><i class="fa-solid fa-eye"></i></a>
                                <?php endif; ?>
                                <?php if(has_permission('anmeldungen.edit')): ?>
                                    <a href="<?php echo route_to('anmeldungen.edit',$person->id) ?>" type="button" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <?php endif; ?>
                                <?php if(has_permission('anmeldungen.delete')): ?>
                                    <button type="button" class="btn btn-sm btn-danger person_delete_button" data-uid="<?= $person->id ?>"><i class="fa-solid fa-trash-can"></i></button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row mb-2">
                                <div class="col-xl-4 col-lg-5 col-md-12 col-sm-4">
                                    <h6 class="mb-0">Adresse</h6>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-12 col-sm-8 text-secondary">
                                    <?php echo $person->street . '<br>' . $person->postcode . ' ' . $person->location ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-xl-4 col-lg-5 col-sm-4">
                                    <h6 class="mb-0">Handy / Telefon</h6>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-12 col-sm-8 text-secondary">
                                    <?= (!empty($person->phone))? $person->phone : '---' ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-xl-4 col-lg-5 col-md-12 col-sm-4">
                                    <h6 class="mb-0">Mail</h6>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-12 col-sm-8 text-secondary">
                                    <?= (!empty($person->email))? $person->email : '---' ?>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-xl-4 col-lg-5 col-md-12 col-sm-4">
                                    <h6 class="mb-0">Geburtstag</h6>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-12 col-sm-8 text-secondary">
                                    <?php
                                    $geburtstag = new DateTime($person->birthday);
                                    $heute = new DateTime(date('Y-m-d'));
                                    $differenz = $geburtstag->diff($heute);
                                    echo date("d.m.Y", strtotime($person->birthday)) . ' (' . esc($differenz->format('%y')) . ')';
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-xl-4 col-lg-5 col-md-12 col-sm-4">
                                    <h6 class="mb-0">Übernachtung</h6>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-12 col-sm-8 text-secondary">

                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-xl-4 col-lg-5 col-md-12 col-sm-4">
                                    <h6 class="mb-0">Team</h6>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-12 col-sm-8 text-secondary">
                                    <?= $person->getTeam() ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-xl-4 col-lg-5 col-md-12 col-sm-4">
                                    <h6 class="mb-0">Bezahlt</h6>
                                </div>
                                <div class="col-xl-8 col-lg-7 col-md-12 col-sm-8 text-secondary">
                                    <?php
                                    if($person->paid == 1){
                                        echo '<div class="badge bg-success">Ja</div>';
                                    } else {
                                        echo '<div class="badge bg-danger">Nein</div>';
                                    }
                                    if($person->paid_amount > 0){
                                        echo '&nbsp;( CHF '.$person->paid_amount . '.-)';
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php if(!empty($person->notes)): ?>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-5 col-md-12 col-sm-4">
                                        <h6 class="mb-0">Bemerkung</h6>
                                    </div>
                                    <div class="col-xl-8 col-lg-7 col-md-12 col-sm-8 text-info">
                                        <strong><?= $person->notes ?></strong>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <?php endforeach; ?>
            </div>


        </div>
    </div>
</div>



<?= $this->endSection() ?>








