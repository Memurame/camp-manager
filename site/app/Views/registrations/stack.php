<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Stapelverarbeitung
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Bearbeiten mehrerer Einträge auf einmal
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
                        Stapelverarbeitung
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Content -->
<div class="content">
    <!-- Your Block -->
    <form method="POST" action="<?php echo route_to('anmeldungen.stack') ?>">
        <div class="block block-rounded">

            <div class="block-header block-header-default">
                <h3 class="block-title">

                </h3>
                <div class="block-options">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Speichern
                    </button>
                </div>
            </div>

            <div class="block-content block-content-full">
                <?= csrf_field() ?>
                <table id="stack_edit" class="table" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Team</th>
                        <th>Bezahlt</th>
                        <th>Betrag</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($personen as $key => $person): ?>
                        <tr>
                            <input type="hidden" name="stack[<?=$key ?>][uid]" value="<?= $person->id ?>">
                            <td>
                                <input type="text" class="form-control" style="width: 250px;" value="<?= esc($person->lastname) ?> <?= esc($person->firstname) ?> (<?= date("Y", strtotime($person->birthday)) ?>)" disabled></td>
                            </td>
                            <td>
                                <select class="form-select" name="stack[<?=$key ?>][team]">
                                    <option value="0" <?php echo ($person->team_id == null) ? 'selected' : '' ?>>-- Kein Team --</option>
                                    <?php foreach ($teams as $team): ?>
                                        <option value="<?= $team->id ?>" <?php echo ($team->id == $person->team_id) ? 'selected' : '' ?>><?= $team->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-select" name="stack[<?=$key ?>][paid]">
                                    <option value="0" <?php echo ($person->paid == 0) ? 'selected' : '' ?>>Nein</option>
                                    <option value="1" <?php echo ($person->paid == 1) ? 'selected' : '' ?>>Ja</option>
                                </select>
                            </td>
                            <td style="width: 120px">
                                <input type="text" name="stack[<?=$key ?>][amount]" class="form-control" placeholder="CHF" value="<?= esc($person->paid_amount) ?>">
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

