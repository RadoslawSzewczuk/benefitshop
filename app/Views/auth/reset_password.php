<?= $this->extend('empty') ?>

<?= $this->section('content') ?>

<div class="login-form-wrap">
    <div class="pass-remind-form-row">
        <?= form_open('set_new_password', ['class' => 'pass-remind-form']); ?>
            <fieldset>
                <h2 class="star-form-heading">
                    Ustaw nowe hasło
                </h2>
                <p class="star-form-heading-subtext">
                    Wprowadź nowe hasło dla Twojego konta: <?= $email ?? '' ?>
                </p>
                <input type="hidden" name="token" value="<?= $token ?? '' ?>">
                <div class="form-item larger-margin">
                    <div class="form-item-group">
                        <input type="password" id="password_pass_new" name="password_pass_new" autocomplete="new-password" placeholder="Wpisz nowe hasło">
                        <p class="form-error-box"></p>
                    </div>
                </div>
                <div class="form-item larger-margin">
                    <div class="form-item-group">
                        <input type="password" id="password_pass_new_r" name="password_pass_new_r" autocomplete="new-password" placeholder="Powtórz nowe hasło">
                        <p class="form-error-box"></p>
                    </div>
                </div>
                <div class="form-item larger-margin">
                    <div class="form-item-group">
                        <button class="button button-gradient star-form-submit" type="submit">
                            Potwierdź
                        </button>
                    </div>
                </div>
            </fieldset>
        <?= form_close() ?>
    </div>
</div>

<?= $this->endSection() ?>
