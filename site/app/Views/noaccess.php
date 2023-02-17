<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<!-- Page Content -->
<div class="hero">
    <div class="hero-inner text-center">
        <div class="bg-body-extra-light">
            <div class="content content-full overflow-hidden">
                <div class="py-4">
                    <!-- Error Header -->
                    <h1 class="display-1 fw-bolder text-flat">
                        403
                    </h1>
                    <h2 class="h4 fw-normal text-muted mb-5">
                        <?= lang('Auth.notEnoughPrivilege') ?>
                    </h2>
                    <!-- END Error Header -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
<?= $this->endSection() ?>
