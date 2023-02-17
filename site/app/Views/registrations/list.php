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
<!-- Page Content -->
<div class="content">

        <div class="mb-3 d-flex justify-content-end">
            <?php if(has_permission('anmeldungen.export')): ?>
            <a href="<?php echo route_to('anmeldungen.export')?>" type="button" class="btn btn-alt-primary me-1 mb-3">
                <i class="fa-solid fa-file-csv"></i> CSV-Export
            </a>
            <?php endif; ?>
            <?php if(has_permission('anmeldungen.stack')): ?>
            <a href="<?php echo route_to('anmeldungen.stack')?>" type="button" class="btn btn-alt-primary me-1 mb-3">
                <i class="fa-solid fa-layer-group"></i> Stapelverarbeitung
            </a>
            <?php endif; ?>
            <?php if(has_permission('anmeldungen.create')): ?>
            <a href="<?php echo route_to('anmeldungen.create')?>" type="button" class="btn btn-alt-primary me-1 mb-3">
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
                    <a href="<?php echo route_to('anmeldungen')?>?<?php if(isset($getData['team'])) echo 'team='. $getData['team'] .'&'; ?>view=card" class="btn btn-light btn-sm"><i class="fa-solid fa-grip-vertical"></i></a>
                    <a href="<?php echo route_to('anmeldungen')?>?<?php if(isset($getData['team'])) echo 'team='. $getData['team'] .'&'; ?>view=list" class="btn btn-dark btn-sm"><i class="fa-solid fa-bars"></i></a>
                </div>
            </div>
            <table class="table table-bordered table-striped table-vcenter" id="anmeldungen" style="width: 100%">
                <thead>
                <tr>
                    <th class="all">Info</th>
                    <th class="all">Name</th>
                    <th>Wohnort</th>
                    <th>Jahrgang</th>
                    <th>Formular</th>
                    <th>Team</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($personen as $person): ?>
                    <?php

                    $geburtstag = new DateTime($person->birthday);
                    $heute = new DateTime(date('Y-m-d'));
                    $differenz = $geburtstag->diff($heute);
                    ?>
                    <tr>
                        <td>
                            <?php
                            if($person->paid == 1){
                                echo '<i class="fa-solid fa-coins pe-2" style="color: green"></i>';
                            } else {
                                echo '<i class="fa-solid fa-coins pe-2" style="color: darkred"></i>';
                            }
                            if(!empty($person->room_id) && $person->room_id > 0){
                                echo '<i class="fa-solid fa-building pe-2" style="color: green"></i>';
                            } else {
                                echo '<i class="fa-solid fa-building pe-2" style="color: darkred"></i>';
                            }
                            ?>

                        </td>
                        <td><?= esc($person->lastname) ?> <?= esc($person->firstname) ?></td>
                        <td><?= esc($person->location) ?></td>
                        <td><?= date("Y", strtotime($person->birthday)) ?> (<?= esc($differenz->format('%y')) ?>)</td>
                        <td><?= esc($person->form) ?></td>
                        <td>
                            <span><?= $person->getTeam() ?></span>

                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <?php if(has_permission('anmeldungen.show')): ?>
                                    <a href="<?php echo route_to('anmeldungen.detail',$person->id)?>" class="btn btn-secondary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                <?php endif; ?>
                                <?php if(has_permission('anmeldungen.edit')): ?>
                                    <a href="<?php echo route_to('anmeldungen.edit',$person->id)?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <?php endif; ?>
                                <?php if(has_permission('anmeldungen.delete')): ?>
                                    <button class="btn btn-danger btn-sm person_delete_button" data-uid="<?=$person->id ?>"><i class="fa-solid fa-trash-can"></i></button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
    <!-- END Your Block -->
</div>
<!-- END Page Content -->
<?= $this->endSection() ?>



