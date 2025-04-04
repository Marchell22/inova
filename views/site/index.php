<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */

$this->title = 'Inova Medika Solusi';
?>
<div class="site-login">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title text-center"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
                            ]); ?>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Enter username">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password">
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <p>Belum punya akun? <?= Html::a('Daftar disini', ['site/register']) ?></p>
                            <p>Lupa password? <?= Html::a('Reset password', ['#']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>