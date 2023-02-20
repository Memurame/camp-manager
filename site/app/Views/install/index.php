<?= $this->extend('install/layout') ?>
<?= $this->section('main') ?>
<div>
    <div class="w-100 position-relative">
        <span class="smini-hide fs-5 tracking-wider"
            style="width:150px; position: absolute; top: 20px; left: 20px;">Camp<span
                class="fw-normal">Manager</span></span>

        <div class="bg-body-extra-light pt-5">
            <div class="content content-full">
                <div class="row g-0 justify-content-center">
                    <div class="col-md-12 col-xl-8 py-4 px-4 px-lg-5">
                        <!-- Header -->
                        <div class="text-center">
                            <h1 class="h4  mb-1">
                                Installation
                            </h1>
                        </div>
                        <form method="POST">
                            <?= csrf_field() ?>
                            <div class="row py-3">
                                <div class="col-12">
                                    <div class="block block-fx-shadow">
                                        <div class="block-header block-header-default">
                                            <h3 class="block-title">Seiteninfo</h3>
                                        </div>
                                        <div class="block-content pb-4">
                                            <input
                                                class="form-control form-control-lg  <?php if(session('errors.site_title')) : ?>is-invalid<?php endif ?>"
                                                placeholder="Seitentitel" name="site_title" id="site_title" type="text"
                                                value="<?=old('site_title') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="block block-fx-shadow">
                                        <div class="block-header block-header-default">
                                            <h3 class="block-title">E-Mail</h3>
                                        </div>
                                        <div class="block-content">
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <input
                                                        class="form-control form-control-lg  <?php if(session('errors.email_fromMail')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="Absender E-Mail-Adresse" name="email_fromMail"
                                                        id="email_fromMail" type="text"
                                                        value="<?=old('email_fromMail') ?>">
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <input
                                                        class="form-control form-control-lg  <?php if(session('errors.email_fromName')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="Absender Name" name="email_fromName"
                                                        id="email_fromName" type="text"
                                                        value="<?=old('email_fromName') ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="block block-fx-shadow">
                                        <div class="block-header block-header-default">
                                            <h3 class="block-title">Administrator</h3>
                                        </div>
                                        <div class="block-content">
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <input
                                                        class="form-control form-control-lg  <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="E-Mail" name="email" id="email" type="mail"
                                                        value="<?=old('email') ?>">
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <input
                                                        class="form-control form-control-lg  <?php if(session('errors.name')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="Anzeigename" name="name" id="name" type="text"
                                                        value="<?=old('name') ?>">
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <input
                                                        class="form-control form-control-lg  <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="Benutzername" name="username" id="username"
                                                        type="text" value="<?=old('username') ?>">
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <input
                                                        class="form-control form-control-lg  <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="Passwort" name="password" id="password"
                                                        type="password" value="<?=old('password') ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="block block-fx-shadow">
                                        <div class="block-header block-header-default">
                                            <h3 class="block-title">SMTP Zugangsdaten</h3>
                                        </div>
                                        <div class="block-content">
                                            <div class="row">
                                                <div class="col-12 mb-4">
                                                    <input
                                                        class="form-control form-control-lg <?php if(session('errors.smtp_host')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="Host" name="smtp_host" id="smtp_host" type="mail"
                                                        value="<?=old('smtp_host') ?>">
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <input
                                                        class="form-control form-control-lg <?php if(session('errors.smtp_username')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="Benutzername" name="smtp_username"
                                                        id="smtp_username" type="text"
                                                        value="<?=old('smtp_username') ?>">
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <input
                                                        class="form-control form-control-lg <?php if(session('errors.smtp_passwort')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="Passwort" name="smtp_passwort" id="smtp_passwort"
                                                        type="text" value="<?=old('smtp_passwort') ?>">
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <select id="smtp_secure" name="smtp_secure"
                                                        class="form-select form-select-lg">
                                                        <option value="ssl">SSL</option>
                                                        <option value="tls">TLS</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mb-4">
                                                    <input
                                                        class="form-control form-control-lg <?php if(session('errors.smtp_port')) : ?>is-invalid<?php endif ?>"
                                                        placeholder="Port" name="smtp_port" id="smtp_port" type="text"
                                                        value="<?=old('smtp_port') ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn w-100 btn-alt-success">
                                        Installieren
                                    </button>
                                </div>
                            </div>
                        </form>
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