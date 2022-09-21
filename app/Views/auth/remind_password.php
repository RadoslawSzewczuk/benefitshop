<?= $this->extend('empty') ?>

<?= $this->section('content') ?>

<div class="login-form-wrap">
    <div class="pass-remind-form-row">
        <?= form_open('remind_password', ['class' => 'pass-remind-form']); ?>
            <fieldset>
                <h2 class="star-form-heading">
                    Przypomnij hasło
                </h2>
                <p class="star-form-heading-subtext">
                    Wpisz poniżej swój adres e-mail podany przy rejestracji, wyślemy na niego link do ustawienia nowego hasła.
                </p>
                <div class="form-item larger-margin">
                    <div class="form-item-group">
                        <input type="email" id="email" name="email" placeholder="Adres e-mail">
                        <p class="form-error-box"></p>
                    </div>
                </div>
                <div class="form-item larger-margin">
                    <div class="form-item-group">
                        <button class="button button-gradient star-form-submit" type="submit">
                            Wyślij
                        </button>
                    </div>
                </div>
                <div class="form-item smaller-margin">
                    <div class="form-item-group">
                        <p>Wróć do <a href="<?= base_url('login') ?>" class="regular-link color-blue-6"><strong>Logowania</strong></a></p>
                    </div>
                </div>
            </fieldset>
        <?= form_close() ?>
    </div>
</div>

<?= $this->endSection() ?>
