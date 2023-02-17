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
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-xxl-5">

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