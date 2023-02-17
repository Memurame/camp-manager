<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title"><?=lang('Auth.forgotPassword')?></h3>
                        <div class="block-options">
                            <a class="btn-block-option js-bs-tooltip-enabled" href="<?= route_to('login') ?>"
                                data-bs-toggle="tooltip" data-bs-placement="left" title=""
                                data-bs-original-title="Sign In">
                                <i class="fa fa-sign-in-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <p class="fw-medium text-muted">
                                <?=lang('Auth.enterEmailForInstructions')?>
                            </p>

                            <form class="mt-4" action="<?= route_to('forgot') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="mb-4">
                                    <input type="email"
                                        class="form-control form-control-lg form-control-alt <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                        name="email" placeholder="<?=lang('Auth.email')?>">
                                    <div class="invalid-feedback"><?= session('errors.email') ?></div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-alt-primary">
                                            <?=lang('Auth.sendInstructions')?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Reminder Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->







<?= $this->endSection() ?>