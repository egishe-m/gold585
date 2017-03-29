<?php
/**
 *
 * @var User $model
 */
use yii\grid\GridView;
use yii\widgets\Pjax;

$dataProvider = new \yii\data\ActiveDataProvider([
    'query' => \app\models\User::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
?>


<div class="users-list">
<?php Pjax::begin(); ?>    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

//        'id',
        'name',
        'email',
        'phone',
        'role.title',

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
    ],
]); ?>
<?php Pjax::end(); ?></div>