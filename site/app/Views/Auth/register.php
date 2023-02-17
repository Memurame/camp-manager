<?= $this->extend($config->viewLayout) ?>
<?= $this->section('main') ?>
<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">

                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title"><?=lang('Auth.register')?></h3>
                        <div class="block-options">
                            <a class="btn-block-option js-bs-tooltip-enabled" href="<?= route_to('login') ?>"
                                data-bs-toggle="tooltip" data-bs-placement="left" title=""
                                data-bs-original-title="<?=lang('Auth.alreadyRegistered')?>">
                                <i class="fa fa-sign-in-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <p class="fw-medium text-muted">
                                Bitte gib die erforderlichen Angaben ein um einen Account zu erstellen.
                            </p>

                            <!-- Sign Up Form -->
                            <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _js/pages/op_auth_signup.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signup" action="<?= route_to('register') ?>" method="POST"
                                novalidate="novalidate">
                                <?= csrf_field() ?>
                                <div class="py-3">
                                    <div class="mb-4">
                                        <input type="text"
                                            class="form-control form-control-lg form-control-alt <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>"
                                            name="username" placeholder="<?=lang('Auth.username')?>"
                                            value="<?= old('username') ?>">
                                        <div class="invalid-feedback"><?= session('errors.username') ?></div>
                                    </div>
                                    <div class="mb-4">
                                        <input type="email"
                                            class="form-control form-control-lg form-control-alt <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                            name="email" placeholder="<?=lang('Auth.email')?>"
                                            value="<?= old('email') ?>">
                                        <div class="invalid-feedback"><?= session('errors.email') ?></div>
                                    </div>
                                    <div class="mb-4">
                                        <input type="password"
                                            class="form-control form-control-lg form-control-alt <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>"
                                            name="password" placeholder="<?=lang('Auth.password')?>">
                                        <div class="invalid-feedback"><?= session('errors.password') ?></div>
                                    </div>
                                    <div class="mb-4">
                                        <input type="password"
                                            class="form-control form-control-lg form-control-alt <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                                            name="pass_confirm" placeholder="<?=lang('Auth.repeatPassword')?>">
                                        <div class="invalid-feedback"><?= session('errors.pass_confirm') ?></div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-alt-success">
                                            <?=lang('Auth.register')?>
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