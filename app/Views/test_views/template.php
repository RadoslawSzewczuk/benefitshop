<?= $this->extend('default') ?>

<!-- Content -->
<?= $this->section('content') ?>

    <!-- your html -->

<?= $this->endSection() ?>


<!-- Modals if necessary  -->
<?= $this->section('content') ?>

    <!-- your modals  -->

<?= $this->endSection() ?>


<!-- Custom scripts for this page  -->
<?= $this->section('scripts') ?>
    <?= $this->include('scripts/template'); ?>
<?= $this->endSection() ?>
