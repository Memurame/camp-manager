<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Zimmer
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Übersicht über die Zimmer
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Zimmer
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Your Block -->

    <?php if(has_permission('zimmer.create')): ?>
    <div class="mb-3 d-flex justify-content-end">
        <a href="<?php echo route_to('zimmer.create')?>" class="btn btn-alt-primary me-1 mb-3">
            <i class="fa fa-fw fa-plus me-1"></i> Neues Zimmer
        </a>
    </div>
    <?php endif; ?>

    <div class="row" id="masonry-cards">

        <?php foreach($rooms as $room): ?>
            <div class="col-lg-4 col-sm-6 room">
                <?php

                $color = null;
                if($room->stock == 0){
                    $color = 'bg-success';
                }
                elseif($room->capacity == $room->stock){
                    $color = 'bg-danger';
                }
                else
                {
                    $color = 'bg-warning';
                }

                ?>
                    <div class="block block-rounded" style="border: 1px solid lightgrey">
                        <div class="block-header block-header-default">
                            <h3 class="block-title"><?= $room->name ?></h3>

                            <div class="block-options">
                                <?php if(has_permission('zimmer.edit')): ?>
                                <a href="<?= route_to('zimmer.edit', $room->id) ?>" type="button" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <?php endif; ?>
                                <?php if(has_permission('zimmer.delete')): ?>
                                <button type="button" class="btn btn-sm btn-danger room_delete_button" data-id="<?= $room->id ?>"><i class="fa-solid fa-trash-can"></i></button>
                                <?php endif; ?>
                            </div>

                        </div>
                        <?php

                            if($room->stock == $room->capacity){
                                $ribbon_color = 'danger';
                                $ribbon_text = 'Belegt';
                            }
                            elseif($room->stock == 0){
                                $ribbon_color = 'success';
                                $ribbon_text = 'Leer';
                            }
                            else{
                                $ribbon_color = 'warning';
                                $ribbon_text = 'Freie Plätze';
                            }

                        ?>


                        <div class="block-content ribbon ribbon-<?= $ribbon_color ?>">
                            <div class="ribbon-box">
                                <?= $ribbon_text ?>
                            </div>
                            <p>
                                Kapazität: <?= $room->capacity ?><br>
                                Belegt: <?= $room->stock ?>
                            </p>
                            <hr>
                            <strong>Zugewiesene Personen:</strong>
                            <?php if(!empty($room->roomMembers)): ?>
                                <ul>
                                    <?php foreach($room->roomMembers as $member): ?>
                                        <li><?= $member->firstname .' ' . $member->lastname ?></li>

                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>-- Keine --</p>
                            <?php endif; ?>
                        </div>
                    </div>
            </div>
        <?php endforeach; ?>

    </div>




</div>
<?= $this->endSection() ?>
