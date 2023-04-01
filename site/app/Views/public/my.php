<?= $this->extend('public/layout') ?>
<?= $this->section('main') ?>
<div>
    <div class="w-100 position-relative">
        <a class="fw-semibold text-dual" href="<?php echo base_url()?>">
            <span class="position-absolute fs-5 tracking-wider" style="left: 30px; top: 30px">Camp<span
                    class="fw-normal">Manager</span></span>
        </a>
        <div class="bg-body-extra-light pt-5">
            <div class="content content-full">
                <div class="row g-0 justify-content-center">
                    <div class="col-md-12 col-xl-8 py-4 px-4 px-lg-5">
                        <!-- Header -->
                        <div class="text-center">
                            <h1 class="h4  mb-1">
                                Meine Anmeldungen
                            </h1>

                            <p class="text-muted mb-3">
                                Hier siehst du alle Anmeldungen welche du unter deinem Namen getätigt hast.
                            </p>
                        </div>

                        <div class="list-group">
                            <?php foreach($registrations as $person): ?>
                            <a href="<?= route_to('public.detail', $token, $person->id) ?>"
                                class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= $person->firstname . " " . $person->lastname ?></h5>
                                    <small><?php
                                        if($person->paid == 1){
                                            echo '<div class="badge bg-success">Bezahlt</div>';
                                        } else {
                                            echo '<div class="badge bg-danger">Nicht bezahlt</div>';
                                        }
                                        ?></small>
                                </div>
                                <p class="mb-1">
                                    <?= $person->street ?><br>
                                    <?= $person->postcode . " " . $person->location ?><br>
                                    <?= date("d.m.Y", strtotime($person->birthday)) ?><br>
                                    <?= $person->phone ?><br>
                                    <?= $person->email ?>
                                </p>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-xxl-5">
                        <a href="<?php echo route_to("public.register", $form) ?>?ref=<?=$token?>"
                            class="btn w-100 btn-alt-primary me-1 mb-3">Neue Person erfassen</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Sign Up Section -->

    </div>


</div>
<!-- END Page Content -->
<?= $this->endSection() ?>