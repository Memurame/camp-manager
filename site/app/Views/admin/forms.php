<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Formulare
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Erstellen und Verwalten von Benutzerdefinierten Formularen
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Formulare
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Content -->
<div class="content">
    <?php if(has_permission('form.create') or in_groups('superadmin')): ?>
        <div class="mb-3 d-flex justify-content-end">
            <a href="#" class="btn btn-alt-primary me-1 mb-3">
                <i class="fa fa-fw fa-plus me-1"></i> Neues Formular
            </a>
        </div>
    <?php endif; ?>
    <div class="block block-rounded">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Titel</th>
                    <th>Info</th>
                    <th>actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($forms as $form): ?>
                    <tr>
                        <td><a href="<?php echo route_to('public.register', $form->name)?>" target="_blank"><?=$form->name ?></a></td>
                        <td><?=$form->title ?></td>
                        <td>
                            <?php
                            if($form->active){
                                echo'<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">Aktiv</span>';
                            } else {
                                echo'<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Inaktiv</span>';
                            }

                            if($form->name == settings()->read('registration.form')){
                                echo'<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">Default</span>';
                            }

                            ?>
                        </td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<?= $this->endSection() ?>