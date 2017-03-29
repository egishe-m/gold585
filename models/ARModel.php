<?php

namespace app\models;

use Yii;

class ARModel extends \yii\db\ActiveRecord
{
    public function softDelete() {
        $this->is_deleted = 1;

        return $this->save() ? true : false;
    }
}