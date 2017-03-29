<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\NotFoundHttpException;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [

        ];
    }


    public function beforeAction($action) {
        if (Yii::$app->user->identity->role_id != 1)
            return $this->goHome();
        return true;
    }


    public function actionIndex() {
        return $this->render('index', [
            'model' => new User()
        ]);
    }


    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id)
    {
        if ($id != Yii::$app->user->identity->id)
            $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}