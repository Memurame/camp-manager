<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Benutzergruppen
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Verwaltung der Benutzergruppen
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Benutzergruppen
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Content -->
<div class="content">
    <?php if(has_permission('group.create')): ?>
    <div class="mb-3 d-flex justify-content-end">
        <a href="<?php echo route_to('group.create')?>" class="btn btn-alt-primary me-1 mb-3">
            <i class="fa fa-fw fa-plus me-1"></i> Neue Gruppe
        </a>
    </div>
    <?php endif; ?>
    <div class="block block-rounded">

        <div class="block-content block-content-full">

            <table class="table table-bordered table-striped table-vcenter" id="datatable-groups">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Beschreibung</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groups as $key => $group): ?>


                    <tr>
                        <td>
                            <?= esc($group->name) ?>
                            <?php
                            if($defaultGroups['owner'] == $group->id || $defaultGroups['user'] == $group->id){
                                echo '&nbsp;<i class="fa-solid fa-lock" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Dies ist eine Standartgruppe und kann nicht gelöscht werden."></i>';
                            }
                            ?>
                        </td>
                        <td><?= esc($group->description) ?></td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <?php if((has_permission('group.edit') and $group->id != $defaultGroups['owner']) OR ($group->id == $defaultGroups['owner'] AND array_key_exists($defaultGroups['owner'], user()->roles))): ?>
                                <a href="<?php echo route_to('group.edit', $group->id)?>"
                                    class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <?php endif; ?>
                                <?php if((has_permission('group.delete') and !in_array($group->id, $defaultGroups))): ?>
                                <button class="btn btn-danger btn-sm group_delete_button" data-id="<?=$group->id ?>"><i
                                        class="fa-solid fa-trash-can"></i></button>
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