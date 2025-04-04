<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->registerJsFile('@web/js/register-validation.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-register">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title text-center"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="card-body">
                    <p class="text-center">Silahkan isi data berikut untuk mendaftar:</p>

                    <div class="row">
                        <div class="col-md-12">
                            <?php $form = ActiveForm::begin([
                                'id' => 'register-form',
                                'action' => ['site/do-register'],
                                'method' => 'post',
                            ]); ?>

                            <?= $form->field($model, 'fullname')
                                ->textInput(['placeholder' => 'Masukkan nama lengkap'])
                                ->label('Nama Lengkap') ?>

                            <?= $form->field($model, 'email')
                                ->textInput(['placeholder' => 'Masukkan email'])
                                ->label('Email')
                                ->hint('Kami tidak akan membagikan email Anda kepada siapapun.') ?>

                            <?= $form->field($model, 'username')
                                ->textInput(['placeholder' => 'Masukkan username'])
                                ->label('Username') ?>

                            <?= $form->field($model, 'password')
                                ->passwordInput(['placeholder' => 'Masukkan password'])
                                ->label('Password') ?>

                            <?= $form->field($model, 'confirmPassword')
                                ->passwordInput(['placeholder' => 'Masukkan konfirmasi password'])
                                ->label('Konfirmasi Password') ?>

                            <?= $form->field($model, 'terms')->checkbox([
                                'label' => 'Saya setuju dengan ' . Html::a('syarat dan ketentuan', '#'),
                                'class' => 'form-check-input',
                            ]) ?>

                            <div class="form-group text-center">
                                <?= Html::submitButton('Daftar', [
                                    'class' => 'btn btn-success btn-block w-100',
                                    'name' => 'signup-button'
                                ]) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <p>Sudah punya akun? <?= Html::a('Login disini', ['site/login']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>