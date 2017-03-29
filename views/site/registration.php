<?php
/**
 *
 * @var \app\models\User $model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'GOLD 585 | Регистрация');
$this->params['breadcrumbs'][] = Yii::t('app', 'Регистрация');
?>
<div class="user-create">

    <h1><?= Html::encode(Yii::t('app', 'Регистрация')) ?></h1>


    <div class="registration-form">

        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Зарегистрироваться'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>



</div>
