<?= $this->extend('empty') ?>

<?= $this->section('content') ?>

<div class="login-form-col">
    <?= form_open('remind_password', ['class' => 'pass-remind-form']); ?>
        <fieldset class="form-group">
            <h2 class="star-form-heading">
                Remind password
            </h2>
            <p class="star-form-heading-subtext">
                Enter your e-mail address provided during registration below, we will send you a link to set a new password.
            </p>
            <div class="form-item larger-margin">
                <div class="form-item-group">
                    <input class="form-control" type="email" id="email" name="email" placeholder="E-mail address">
                    <p class="form-error-box"></p>
                </div>
            </div>
            <div class="form-item larger-margin">
                <div class="form-item-group login-button-wrapper">
                    <button class="button btn btn-light" type="submit">
                        Send
                    </button>
                </div>
            </div>
            <div class="form-item smaller-margin">
                <div class="form-item-group">
                    <p>Back to <a href="<?= base_url('login') ?>" class="regular-link color-blue-6"><strong>Login</strong></a></p>
                </div>
            </div>
        </fieldset>
    <?= form_close() ?>
</div>

<?= $this->endSection() ?>
