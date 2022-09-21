<?= $this->extend('empty') ?>

<?= $this->section('content') ?>

<div class="login-form-col">
    <?= form_open('login', ['class' => 'login-form']); ?>
        <fieldset>
            <h2 class="login-form-heading">
                Zaloguj
            </h2>

            <div class="form-item">
                <div class="form-item-group">
                    <input type="email" id="email" name="email" placeholder="Adres e-mail">
                    <p class="form-error-box"></p>
                </div>
            </div>
            <div class="form-item">
                <div class="form-item-group">
                    <input type="password" id="password" name="password" autocomplete="new-password" placeholder="Hasło">
                    <p class="form-error-box"></p>
                </div>
            </div>
            <div class="form-item double">
                <div class="form-item-group">
                    <div class="login-checkbox-wrap">
                        <label class="circle-checkbox" for="remember">
                            <input type="checkbox" id="remember" name="remember" value="1"/>
                            <div class="circle-checkbox-visuals"></div>
                            <p class="circle-checkbox-desc">
                                Zapamiętaj mnie
                            </p>
                        </label>
                    </div>
                </div>
                <div class="form-item-group">
                    <a href="<?= base_url('remind_password') ?>" class="regular-link color-blue-6">Nie pamiętasz hasła?</a>
                </div>
            </div>

            <div class="form-item larger-margin">
                <div class="form-item-group">
                    <button class="button button-gradient" type="submit" role="button">
                        Zaloguj
                    </button>
                </div>
            </div>

        </fieldset>
    <?= form_close() ?>
</div>

<?= $this->endSection() ?>
