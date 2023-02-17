<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Materialliste
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Übersicht über alle Materialien
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Materialliste
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Content -->
<div class="content">
    <!-- Your Block -->
    <?php if(has_permission('matlist.create') or in_groups('superadmin')): ?>
    <div class="mb-3 d-flex justify-content-end">
        <a href="<?php echo route_to("material.create")?>" class="btn btn-alt-primary me-1 mb-3">
            <i class="fa fa-fw fa-plus me-1"></i> Neues Material
        </a>
    </div>
    <?php endif; ?>
    <div class="block block-rounded">
        <div class="block-content block-content-full">

            <div class="space-x-2 pb-3">
                <?php foreach ($categories as $key => $cat): ?>

                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" value="<?= $cat->name ?>" id="mat_kat_<?= $key ?>" name="kat" >
                        <label class="form-check-label" for="mat_kat_<?= $key ?>"><?= $cat->name ?></label>
                    </div>

                <?php endforeach; ?>
            </div>



                <table id="datatable-mat" class="table table-bordered table-striped table-vcenter dataTable no-footer dtr-inline" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Material</th>
                        <th>Anzahl</th>
                        <th>Kategorie</th>
                        <th>Verantwortlich</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($materiallist as $mat):
                        $mat->getAssignedUser();
                        $mat->getCategory();
                        ?>
                            <tr data-id="<?= $mat->id ?>" class="mat-row">
                                <td><?= $mat->name ?></td>
                                <td><?= $mat->count ?></td>
                                <td><?= $mat->category ?></td>
                                <td>
                                    <?php
                                    if($mat->assigned){
                                        echo  $mat->assigned;
                                    }
                                    else
                                    {
                                        if(has_permission('matlist.edit') or in_groups('superadmin')){
                                            echo'<button class="btn btn-primary btn-sm material-assign" data-uid="'.user_id().'">Mir zuweisen</button>';
                                        } else {
                                            echo "-- Nicht zugewiesen --";
                                        }

                                    }

                                    ?>
                                </td>
                                <td>
                                    <select  style="width: 150px" name="status" id="status" class="form-select material-status" <?= (!has_permission('matlist.edit')) ? 'disabled' : '' ?>>
                                        <option value="0" <?= ($mat->status == 0) ? 'selected' : '' ?>>Offen</option>
                                        <option value="1" <?= ($mat->status == 1) ? 'selected' : '' ?>>Organisiert</option>
                                        <option value="2" <?= ($mat->status == 2) ? 'selected' : '' ?>>Verladen</option>
                                        <option value="3" <?= ($mat->status == 3) ? 'selected' : '' ?>>Erledigt</option>
                                    </select>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <?php if(has_permission('matlist.edit') or in_groups('superadmin')): ?>
                                            <a href="<?php echo route_to("material.edit", $mat->id)?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <?php endif; ?>
                                        <?php if(has_permission('matlist.delete') or in_groups('superadmin')): ?>
                                            <button class="btn btn-danger btn-sm material_delete_button" data-id="<?=$mat->id ?>"><i class="fa-solid fa-trash-can"></i></button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>

        </div>
    </div>
</div>
<?= $this->endSection() ?>



