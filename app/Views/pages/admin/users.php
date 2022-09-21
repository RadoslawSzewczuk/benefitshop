<?= $this->extend('default') ?>

<!-- Content -->
<?= $this->section('content') ?>

    <?= view('components/table/table'); ?>

<?= $this->endSection() ?>



<?= $this->section('content') ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<?= $this->include('scripts/templatka'); ?>
<?= $this->endSection() ?>
