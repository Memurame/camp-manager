<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Benutzer
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Benutzerverwaltung aller Benutzer die ein Login zu dieser Webseite haben
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Benutzer
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Content -->
<div class="content">
    <?php if(has_permission('user.create')): ?>
        <div class="mb-3 d-flex justify-content-end">
            <a href="<?php echo route_to('user.create')?>" class="btn btn-alt-primary me-1 mb-3">
                <i class="fa fa-fw fa-plus me-1"></i> Neuer Benutzer
            </a>
        </div>
    <?php endif; ?>
    <div class="block block-rounded">

        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Mail</th>
                    <th>Rolle</th>
                    <th>Status</th>
                    <th>actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $key => $user):
                    $user->getRoles() ?>


                    <tr>
                        <td><?= esc($user->username) ?></td>
                        <td><?= esc($user->email) ?></td>
                        <td>
                            <?php foreach($user->roles as $key => $role){
                                echo '<span class="fs-xs fw-semibold d-block">';
                                echo ucfirst($role);
                                echo '</span>';

                             }?>
                        </td>
                        <td>
                            <?php
                            if($user->isBanned()){
                                echo'<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Gesperrt</span>';
                            }
                            elseif($user->isActivated()){
                                echo'<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">Aktiv</span>';
                            }
                            else{
                                echo'<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">Inaktiv</span>';
                            }

                            ?>
                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <?php if(has_permission('user.edit')): ?>
                                    <button class="btn btn-warning btn-sm user_reset_button" data-uid="<?=$user->id ?>"><i class="fa-solid fa-arrows-rotate"></i></button>
                                <?php endif; ?>
                                <?php if(has_permission('user.edit')): ?>
                                <a href="<?php echo route_to('user.edit', $user->id)?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <?php endif; ?>
                                <?php if((has_permission('user.delete') and array_values($user->roles)[0] != $config->ownerGroup)): ?>
                                <button class="btn btn-danger btn-sm user_delete_button" data-uid="<?=$user->id ?>"><i class="fa-solid fa-trash-can"></i></button>
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