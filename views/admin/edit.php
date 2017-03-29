<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'GOLD 585 | Редактирование пользователя: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пользователи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>
<div class="user-update">

    <h1><?= Html::encode(Yii::t('app', 'Редактирование пользователя')) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
