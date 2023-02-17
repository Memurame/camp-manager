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
                                <?= $form->title ?>
                            </h1>
                            <?php if($form->description): ?>
                            <p class="text-muted mb-3">
                                <?= $form->description ?>
                            </p>
                            <?php endif ?>
                        </div>
                        <!-- END Header -->

                        <div class="alert alert-info">

                            Wegen Wartungsarbeiten ist die Registrierung vorübergehend deaktiviert.<br>
                            Bitte schaue später nochmals vorbei.<br><br>

                            Euer Camp-Team
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- END Sign Up Section -->

        <!-- Footer -->
        <div class="fs-sm text-center text-muted py-3">
            created by <a class="fw-semibold" href="https://github.com/Memurame/camp-manager"
                target="_blank">Memurame</a>
        </div>
        <!-- END Footer -->
    </div>


</div>
<!-- END Page Content -->
<?= $this->endSection() ?>