<?php if(session()->getFlashdata('msg_success')):?>
    <script type="text/javascript">
        One.helpers('jq-notify', {
            type: 'success',
            icon: 'fa fa-check me-1',
            message: "<?= session()->getFlashdata('msg_success') ?>"});
    </script>
<?php endif;?>

<?php if(session()->getFlashdata('msg_error')):?>
    <script type="text/javascript">
        One.helpers('jq-notify', {
            type: 'danger',
            icon: 'fa fa-times me-1',
            message: "<?= session()->getFlashdata('msg_error') ?>"});
    </script>
<?php endif;?>

<?php if(session()->getFlashdata('msg_warning')):?>
    <script type="text/javascript">
        One.helpers('jq-notify', {
            type: 'warning',
            icon: 'fa fa-exclamation me-1',
            message: "<?= session()->getFlashdata('msg_warning') ?>"});
    </script>
<?php endif;?>

<?php if(session()->getFlashdata('msg_info')):?>
    <script type="text/javascript">
        One.helpers('jq-notify', {
            type: 'info',
            icon: 'fa fa-info-circle me-1',
            message: "<?= session()->getFlashdata('msg_info') ?>"});
    </script>
<?php endif;?>

