<?= $this->extend('empty') ?>

<?= $this->section('content') ?>

<div class="login-form-wrap">
    <div class="pass-remind-form-row">
        <?= form_open('set_new_password', ['class' => 'pass-remind-form']); ?>
            <fieldset>
                <h2 class="star-form-heading">
                    Set new password
                </h2>
                <p class="star-form-heading-subtext">
                    Enter a new password for your account: <?= $email ?? '' ?>
                </p>
                <input type="hidden" name="token" value="<?= $token ?? '' ?>">
                <div class="form-item larger-margin">
                    <div class="form-item-group">
                        <input type="password" id="password_pass_new" name="password_pass_new" autocomplete="new-password" placeholder="Enter new password">
                        <p class="form-error-box"></p>
                    </div>
                </div>
                <div class="form-item larger-margin">
                    <div class="form-item-group">
                        <input type="password" id="password_pass_new_r" name="password_pass_new_r" autocomplete="new-password" placeholder="Repeat new password">
                        <p class="form-error-box"></p>
                    </div>
                </div>
                <div class="form-item larger-margin">
                    <div class="form-item-group">
                        <button class="button button-gradient star-form-submit" type="submit">
                            Confirm
                        </button>
                    </div>
                </div>
            </fieldset>
        <?= form_close() ?>
    </div>
</div>

<?= $this->endSection() ?>
