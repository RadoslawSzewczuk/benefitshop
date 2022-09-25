<?= $this->extend('default') ?>

<!-- Content -->
<?= $this->section('content') ?>
    <?= view('components/table/table'); ?>
<?= $this->endSection() ?>



<?= $this->section('content') ?>
<?= $this->endSection() ?>

<?= $this->section('modals') ?>
    <?= view('pages/admin/users_add_user_modal') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <?= $this->include('scripts/admin/' . basename(__FILE__) ); ?>
<?= $this->endSection() ?>
