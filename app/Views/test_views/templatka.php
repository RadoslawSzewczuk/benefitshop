<?= $this->extend('default') ?>

<!-- Content -->
<?= $this->section('content') ?>

    <!-- twoj html -->

<?= $this->endSection() ?>


<!-- Modale jezeli jakies sa ci potrzebne  -->
<?= $this->section('content') ?>

    <!-- twoje modale  -->

<?= $this->endSection() ?>


<!-- Customowe skrypty dla tej zakladki  -->
<?= $this->section('scripts') ?>
    <?= $this->include('scripts/templatka'); ?>
<?= $this->endSection() ?>
