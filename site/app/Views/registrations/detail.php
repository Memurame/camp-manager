<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Teilnehmer
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Detailansicht des Teilnehmers
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
                        Teilnehmer
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Your Block -->
    <div class="mb-3 d-flex justify-content-end">
        <?php if(has_permission('anmeldungen.edit')): ?>
        <a href="<?php echo route_to('anmeldungen.edit', $person->id)?>" class="btn btn-alt-primary me-1 mb-3">
            <i class="fa fa-fw fa-plus me-1"></i> Bearbeiten
        </a>
        <?php endif; ?>
        <?php if(has_permission('anmeldungen.delete')): ?>
        <button class="btn btn-alt-danger me-1 mb-3 person_delete_button" data-uid="<?= $person->id ?>>" "="">
                    <i class=" fa fa-fw fa-trash me-1"></i> Löschen
        </button>
        <?php endif; ?>
    </div>
    <div class="row gutters-sm mb-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                            <h6 class="mb-0">Team:</h6>
                        </div>
                        <div class="col-sm-8 text-secondary">
                            <?=$person->getTeam() ?>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-0">Bezahlt:</h6>
                        </div>
                        <div class="col-sm-8 text-secondary">
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
                </div>
            </div>
            <?php if(false): ?>

            <div class="card text-dark bg-modern-light mt-3">
                <div class="card-body">
                    <h5 class="card-title">Eltern Info</h5>
                    <div class="row mb-2">
                        <div class="col-4">
                            <span class="fw-bold">Mail</span>
                        </div>
                        <div class="col-8">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <span class="fw-bold">Telefon</span>
                        </div>
                        <div class="col-8">

                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(!empty($person->notes)): ?>

            <div class="card text-dark bg-modern-light mt-3">
                <div class="card-body">
                    <h5 class="card-title">Interne Bemerkung</h5>
                    <div class="card-text">
                        <?= $person->notes ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-md-8 mb-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?php echo $person->firstname . ' ' . $person->lastname ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Adresse</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?php echo $person->street . ' '. $person->street_nr .'<br>' . $person->postcode . ' ' . $person->location ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Handy / Telefon</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= (!empty($person->phone))? $person->phone : '---' ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Mail</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= (!empty($person->email))? $person->email : '---' ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Geburtstag</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?php
                            $geburtstag = new DateTime($person->birthday);
                            $heute = new DateTime(date('Y-m-d'));
                            $differenz = $geburtstag->diff($heute);
                            echo date("d.m.Y", strtotime($person->birthday)) . ' (' . esc($differenz->format('%y')) . ')';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php foreach(cache('form_'.$form->name.'_fields')['sections'] as $section): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <?php $i = 0; ?>
                    <?php foreach($section['fields'] as $fieldName => $field): ?>
                    <?php $i++; ?>
                    <?php if($fieldName != 'submit'): ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0"><?= $field['title'] ?></h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?php
                                    if(is_array($person->data->{$fieldName})){
                                        foreach($person->data->{$fieldName} as $option){
                                            echo "<li>" . cache('form_'.$form->name.'_options')[$fieldName][$option] . "</li>";
                                        }
                                    } else {
                                        if($field['type'] == 'textarea' || $field['type'] == 'text'){
                                            echo $person->data->{$fieldName};
                                        } else {
                                            if($person->data->{$fieldName} == null){
                                                echo "-";
                                            } else {
                                                echo cache('form_'.$form->name.'_options')[$fieldName][$person->data->{$fieldName}];
                                            }
                                            
                                        }
                                    }
                                    ?>
                        </div>
                    </div>
                    <?php
                                    if($i < count($section['fields'])){
                                        echo"<hr>";
                                    }
                                ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>


            <?php endforeach; ?>


        </div>


    </div>

</div>




<?= $this->endSection() ?>