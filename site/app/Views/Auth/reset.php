<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">

                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title"><?=lang('Auth.resetYourPassword')?></h3>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <p class="fw-medium text-muted">
                                <?=lang('Auth.enterCodeEmailPassword')?>
                            </p>

                            <form action="<?= route_to('reset-password') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="py-3">
                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-lg form-control-alt <?php if(session('errors.token')) : ?>is-invalid<?php endif ?>"  name="token" placeholder="<?=lang('Auth.token')?>" value="<?= old('token', $token ?? '') ?>">
                                        <div class="invalid-feedback"><?= session('errors.token') ?></div>
                                    </div>
                                    <div class="mb-4">
                                        <input type="email" class="form-control form-control-lg form-control-alt <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"  name="email" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                                        <div class="invalid-feedback"><?= session('errors.email') ?></div>
                                    </div>
                                    <br>
                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg form-control-alt <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>"  name="password" placeholder="<?=lang('Auth.newPassword')?>" value="<?= old('password') ?>">
                                        <div class="invalid-feedback"><?= session('errors.password') ?></div>
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg form-control-alt <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"  name="pass_confirm" placeholder="<?=lang('Auth.newPasswordRepeat')?>" value="<?= old('pass_confirm') ?>">
                                        <div class="invalid-feedback"><?= session('errors.pass_confirm') ?></div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-alt-success">
                                            <?=lang('Auth.resetPassword')?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign Up Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->







<?= $this->endSection() ?>
