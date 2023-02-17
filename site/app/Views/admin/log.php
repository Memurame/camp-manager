<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<!-- Page Content -->
<div class="content">
    <div class="block block-rounded">

        <div class="block-header block-header-default">
            <h3 class="block-title">
                Log
            </h3>
        </div>

        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter" id="datatable-log">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Datum</th>
                    <th>App</th>
                    <th>Typ</th>
                    <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= $log['id'] ?></td>
                        <td><?= $log['date'] ?></td>
                        <td><?= $log['app'] ?></td>
                        <td>
                            <?php
                            if($log['typ'] == 'success'){
                                $color = 'bg-success-light text-success';
                            }
                            elseif($log['typ'] == 'error'){
                                $color = 'bg-danger-light text-danger';
                            }
                            elseif($log['typ'] == 'info'){
                                $color = 'bg-info-light text-info';
                            }
                            elseif($log['typ'] == 'warning'){
                                $color = 'bg-warning-light text-warning';
                            }
                            else {
                                $color = 'bg-primary-light text-primary';
                            }
                            ?>
                            <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill <?=$color?>"><?=$log['typ']?></span>
                        </td>
                        <td>
                            <?php
                                $arr = json_decode($log['msg'], true);
                                if($log['app'] == 'login'){
                                    echo"<strong>Mail:</strong> " . $arr['v1'];
                                }
                                if($log['app'] == 'mail'){
                                    if($log['typ'] == 'success'){
                                        echo"<strong>Mail:</strong> " . $arr['v1'];
                                    } else {
                                        echo"<strong>Name:</strong> <a href='". route_to('anmeldungen.detail', $arr['id']) . "'>" . $arr['v1'] . " <i class='fa-solid fa-arrow-up-right-from-square'></i></a>";
                                    }
                                }
                            if($log['app'] == 'material'){
                                if(!isset($arr['id'])){
                                    echo"<strong>Material:</strong> " . $arr['v1'];
                                } else {
                                    echo"<strong>Material:</strong> <a href='". route_to('material.edit', $arr['id']) . "'>" . $arr['v1'] . " <i class='fa-solid fa-arrow-up-right-from-square'></i></a>";
                                }
                            }

                            if($log['app'] == 'person'){
                                if(!isset($arr['id'])){
                                    echo"<strong>Person:</strong> " . $arr['v1'];
                                } else {
                                    echo"<strong>Person:</strong> <a href='". route_to('anmeldungen.detail', $arr['id']) . "'>" . $arr['v1'] . " <i class='fa-solid fa-arrow-up-right-from-square'></i></a>";
                                }
                            }

                            if($log['app'] == 'zimmer'){
                                if(!isset($arr['id'])){
                                    echo"<strong>Zimmer:</strong> " . $arr['v1'];
                                } else {
                                    echo"<strong>Zimmer:</strong> <a href='". route_to('zimmer.edit', $arr['id']) . "'>" . $arr['v1'] . " <i class='fa-solid fa-arrow-up-right-from-square'></i></a>";
                                }
                            }

                            if($log['app'] == 'benutzer'){
                                if(!isset($arr['id'])){
                                    echo"<strong>Benutzer:</strong> " . $arr['v1'];
                                } else {
                                    echo"<strong>Benutzer:</strong> <a href='". route_to('user.edit', $arr['id']) . "'>" . $arr['v1'] . " <i class='fa-solid fa-arrow-up-right-from-square'></i></a>";
                                }

                            }
                            if($log['app'] == 'benutzergruppe'){
                                if(!isset($arr['id'])){
                                    echo"<strong>Gruppe:</strong> " . $arr['v1'];
                                } else {
                                    echo"<strong>Gruppe:</strong> <a href='". route_to('group.edit', $arr['id']) . "'>" . $arr['v1'] . " <i class='fa-solid fa-arrow-up-right-from-square'></i></a>";
                                }

                            }


                            echo"<br><strong>Meldung:</strong> " . $arr['msg'];

                            if(isset($arr['uid'])){
                                echo"<br><strong>Ausgeführt durch:</strong> " . $log['user'];
                            }


                            ?>

                        </td>
                    </tr>

                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>