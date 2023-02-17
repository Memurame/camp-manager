<?= $this->extend('templates/layout') ?>
<?= $this->section('main') ?>
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    E-Mail Entwürfe
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Übersicht über alle gespeicherte E-Mails
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="<?php echo base_url()?>">Übersicht</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Mail Versand
                    </li>
                    <li class="breadcrumb-item active">
                        Entwürfe
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Content -->
<div class="content">
    <!-- Your Block -->
    <?php if(!empty($list)): ?>
    <div class="row">
        <div class="col-sm-4">
            <div class="block">
                <div class="block-content p-3">
                    <div class="list-group">
                        <?php
                        foreach($list as $value){
                            $active = (isset($entwurf) && $entwurf['time'] == $value['time']) ? 'active' : '';
                            echo '<a href="'.route_to('mail.load',$value['time']).'" class="list-group-item list-group-item-action '.$active.'">'. $value['name'] .'</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="block">
                <div class="block-content">
                    <?php if(!empty($entwurf)): ?>
                    <form method="POST" action="<?=route_to('mail.load',$entwurf['time'])?>">
                        <?= csrf_field() ?>
                        <?php if(isset($errors) && !empty($errors)): ?>
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        <?php if(session()->getFlashdata('mail_error')):
                                echo '<div class="alert alert-danger" role="alert"><ul class="mb-0">';
                                foreach(session()->getFlashdata('mail_error') as $value){
                                    echo '<li>' . $value['name'] . ' - ' . $value['msg'] . '</li>';
                                }
                                echo '</ul></div>';
                            endif;?>
                        <div class="mb-3 row">
                            <label for="save_name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" id="save_name" name="save_name" class="form-control"
                                    value="<?=$entwurf['name'] ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3 row">
                            <label for="input_sender" class="col-sm-2 col-form-label">Absender</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="<?=settings()->read('email.fromMail')?>"
                                    id="input_sender" name="input_sender" class="form-control"
                                    value="<?=$entwurf['reply_to'] ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="input_subject" class="col-sm-2 col-form-label">Betreff</label>
                            <div class="col-sm-10">
                                <input value="<?=$entwurf['subject'] ?>" type="text" class="form-control"
                                    name="input_subject" id="input_subject">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="input_text" class="col-sm-2 col-form-label">Nachricht</label>
                            <div class="col-sm-10">
                                <textarea rows="10" name="input_text" id="input_mail_text"
                                    class="js-simplemde form-control"><?=$entwurf['text'] ?></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="offset-sm-2 col-sm-10">
                                <a href="<?=route_to('mail.copy',$entwurf['time'])?>" class="btn btn-alt-primary">
                                    Als neues Mail generieren
                                </a>
                                <button type="submit" class="btn btn-alt-success">
                                    Speichern
                                </button>
                                <button class="btn btn-alt-danger entwurf_delete_button"
                                    data-time="<?=$entwurf['time'] ?>">
                                    Entwurf löschen
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php else: ?>

                    <p>Wähle einen Entwurf aus um diesen anzuzeigen.</p>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <?php else: ?>

    <div class="block block-rounded">
        <div class="block-content text-center">
            <p>
                Zurzeit sind keine gespeicherten Entwürfe vorhanden.
            </p>
        </div>
    </div>

    <?php endif; ?>

</div>
<?= $this->endSection() ?>