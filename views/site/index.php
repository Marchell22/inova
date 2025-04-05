<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */

$this->title = 'Inova Medika Solusi';
$this->registerCssFile('@web/css/login.css');
$this->registerJsFile('@web/js/login-validation.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<div class="site-index">
    <?php if (Yii::$app->user->isGuest): ?>
        <!-- Tampilkan form login jika pengguna belum login -->
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Silakan login untuk melanjutkan:</p>

                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'action' => ['site/index'],
                            'method' => 'post',
                        ]); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Masukkan username']) ?>

                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Masukkan password']) ?>

                        <?= $form->field($model, 'rememberMe')->checkbox([
                            'template' => "<div class=\"form-check\">\n{input} {label}\n{error}</div>",
                            'class' => 'form-check-input',
                        ]) ?>

                        <div class="form-group text-center">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <p>Belum punya akun? <?= Html::a('Daftar disini', ['site/register']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Tampilkan konten untuk pengguna yang sudah login -->
        <div class="jumbotron text-center bg-transparent mt-5">
            <h1 class="display-4">Selamat Datang, <?= Yii::$app->user->identity->username ?>!</h1>
            <p class="lead">Anda berhasil login ke aplikasi.</p>
            <p>
                <?= Html::a('Lihat Dashboard', ['dashboard/index'], ['class' => 'btn btn-lg btn-success']) ?>
            </p>
        </div>
    <?php endif; ?>
</div>