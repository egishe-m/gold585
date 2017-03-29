<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Roles extends ARModel
{
    public static function tableName()
    {
        return 'tbl_role';
    }

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Имя  отправителя '),
            'date_create' => Yii::t('app', 'Дата создания'),
        ];
    }


    public static function getListRoles()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }
}