<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign In Block -->
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Anmelden</h3>
                        <div class="block-options">
                            <?php if ($config->activeResetter): ?>
                            <a class="btn-block-option fs-sm"
                                href="<?= route_to('forgot') ?>"><?=lang('Auth.forgotYourPassword')?></a>
                            <?php endif; ?>
                            <?php if ($config->allowRegistration) : ?>
                            <a class="btn-block-option js-bs-tooltip-enabled" href="<?= route_to('register') ?>"
                                data-bs-toggle="tooltip" data-bs-placement="left" title=""
                                data-bs-original-title="<?=lang('Auth.forgotYourPassword')?>">
                                <i class="fa fa-user-plus"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <p class="fw-medium text-muted">
                                Willkommen, bitte anmelden.
                            </p>
                            <form action="<?= route_to('login') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="py-3">
                                    <div class="mb-4">
                                        <input type="text"
                                            class="form-control form-control-alt form-control-lg <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
                                            name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
                                        <div class="invalid-feedback"><?= session('errors.login') ?></div>
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" name="password"
                                            class="form-control form-control-alt form-control-lg <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>"
                                            placeholder="<?=lang('Auth.password')?>">
                                        <div class="invalid-feedback"><?= session('errors.password') ?></div>
                                    </div>
                                    <?php if ($config->allowRemembering): ?>
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="remember"
                                                name="remember" <?php if(old('remember')) : ?> checked <?php endif ?>>
                                            <label class="form-check-label"
                                                for="remember"><?=lang('Auth.rememberMe')?></label>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-">
                                        <button type="submit" class="btn w-100 btn-alt-primary">
                                            <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Login
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
                    </div>
                </div>
                <!-- END Sign In Block -->
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->







<?= $this->endSection() ?>