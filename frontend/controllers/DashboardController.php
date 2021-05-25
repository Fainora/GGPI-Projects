<?php

namespace frontend\controllers;

use Yii;
use common\models\Dashboard;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Projects;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;

/**
 * DashboardController implements the CRUD actions for Dashboard model.
 */
class DashboardController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Dashboard models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $project = $this->findProject($id);
        $projects = Projects::find()->all();
        $dashboard = Dashboard::find()->all();

        if (!($project->isMember(Yii::$app->user->identity->id)) && 
            ($project->user_id != Yii::$app->user->identity->id)) {
            throw new ForbiddenHttpException('У вас нет прав просматривать данную доску');
        }

        return $this->render('index', [
            'id' => $id,
            'project' => $project,
            'projects' => $projects,
            'dashboard' => $dashboard
        ]);    
    }

    /**
     * Displays a single Dashboard model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = new Dashboard();
      	if (!($project->isMember(Yii::$app->user->identity->id)) && 
            ($project->user_id != Yii::$app->user->identity->id)) {
            throw new ForbiddenHttpException('У вас нет прав просматривать данную доску');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dashboard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Dashboard();
        $project = $this->findProject($id);
        $url = Url::previous();
      	if (!($project->isMember(Yii::$app->user->identity->id)) && 
            ($project->user_id != Yii::$app->user->identity->id)) {
            throw new ForbiddenHttpException('У вас нет прав просматривать данную доску');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->goBack();
        }

        return $this->render('create', [
            'model' => $model,
            'project' => $project,
        ]);
    }

    /**
     * Updates an existing Dashboard model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $project_id)
    {
        $model = $this->findModel($id);
        $project = $this->findProject($project_id);
        $url = Url::previous();
      	if (!($project->isMember(Yii::$app->user->identity->id)) && 
            ($project->user_id != Yii::$app->user->identity->id)) {
            throw new ForbiddenHttpException('У вас нет прав просматривать данную доску');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goBack();
        }

        return $this->render('update', [
            'model' => $model,
            'project' => $project,
        ]);
    }

    /**
     * Deletes an existing Dashboard model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer);
    } */

    /**
     * Finds the Dashboard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dashboard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dashboard::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная страница не существует.');
    }

    protected function findProject($id)
    {
        if (($project = Projects::findOne($id)) !== null) {
            return $project;
        }

        throw new NotFoundHttpException('Проект не найден.');
    }

    //Доска
    public function actionDashboard($id)
    {
        $project = $this->findProject($id);
        $projects = Projects::find()->all();
        $model = $this->findModel($id);
        $dashboard = Dashboard::find()->all();

        return $this->render('dashboard', [
            'id' => $id,
            'project' => $project,
            'projects' => $projects,
            'model' => $model,
            'dashboard' => $dashboard
        ]);
    }

    public function actionTodo($card_id)
    {
        $model = $this->findModel($card_id);
        if($model->position != 'todo') {
            $model->position = 'todo';
            $model->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDoing($card_id)
    {
        $model = $this->findModel($card_id);
        if($model->position != 'doing') {
            $model->position = 'doing';
            $model->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDone($card_id)
    {
        $model = $this->findModel($card_id);
        if($model->position != 'done') {
            $model->position = 'done';
            $model->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionBacklog($card_id)
    {
        $model = $this->findModel($card_id);
        if($model->position != 'backlog') {
            $model->position = 'backlog';
            $model->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}
