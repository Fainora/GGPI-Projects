<?php

namespace frontend\controllers;

use Yii;
use common\models\Projects;
use common\models\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use common\models\ProjectsUser;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use common\models\ProjectsTag;
use common\models\UserTag;
use common\models\Dashboard;
use yii\web\HttpException;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Displays a single Projects model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $members = ProjectsUser::find()->where(['status' => 2])->all();
        $project = $this->findProject($id);
        $count = ProjectsUser::find()->where(['status' => 2, 'project_id' => $project->id])->count();
        $tags = ProjectsTag::find()->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'members'=>$members,
            'project' => $project,
            'count' => $count,
            'tags' => $tags,
        ]);
    }

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		if (Yii::$app->user->getIdentity()->id != $model->user_id){
            throw new HttpException(403, Yii::t('app', 'Вам не разрешено выполнять это действие.'));
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      	$model = $this->findModel($id);
      	if (Yii::$app->user->getIdentity()->id != $model->user_id){
            throw new HttpException(403, Yii::t('app', 'Вам не разрешено выполнять это действие.'));
        }
        $model->delete();

        return $this->redirect(['site/index']);
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findProject($id)
    {
        $project = $this->findModel($id);
        if(!$project) {
            throw new NotFoundHttpException("Project does not exist");
        }
        return $project;
    }

    //Подать заявку
    public function actionApply($id)
    {
        $project = $this->findProject($id);
        $userId = Yii::$app->user->identity->id;
        $member = $project->isWaitingMember($userId);

        if(!$member) {
            $member = new ProjectsUser();
            $member->project_id = $project->id;
            $member->user_id = $userId;
            $member->status = 1;
            $member->save();
        } else {
            $member->delete();
          	return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_member', [
            'project' => $project,
        ]);
    }

    //Выйти из проекта
    public function actionExit($id)
    {
        $project = $this->findProject($id);
        $userId = Yii::$app->user->identity->id;
        $member = $project->isMember($userId);
        $member->delete();
      	return $this->redirect(Yii::$app->request->referrer);

        return $this->renderAjax('_member', [
            'project' => $project,
        ]);
    }

    //Кнопка "Проверить заявки"
    public function actionRequest($id)
    {
        $project = $this->findProject($id);
        $query = ProjectsUser::find()->where(['project_id' => $project->id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $members = $query->offset($pages->offset)->limit($pages->limit)->all();
        $tags = UserTag::find()->all();
        $count = ProjectsUser::find()->where(['status' => 2, 'project_id' => $project->id])->count();

        return $this->render('request', [
            'members' => $members,
            'project' => $project,
            'query' => $query,
            'pages' => $pages,
            'tags' => $tags,
            'count' => $count,
        ]);
    }
    //Принять заявку user'a в проект
    public function actionAccept($id, $project_id)
    {
        $project = $this->findProject($project_id);
        $member = $project->isWaitingMember($id);

        if($member) {
            $member->status = 2;
            $member->save();
          	return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_waitmember');
    }
    //Отклонить заявку user'a в проект
    public function actionReject($id, $project_id)
    {
        $project = $this->findProject($project_id);
        $member = $project->isWaitingMember($id);
        
        if($member) {
            $member->delete();
          	return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('_waitmember');
    }
    //Выгнать из проекта
    public function actionKick($id, $project_id)
    {
        $project = $this->findProject($project_id);
        $member = $project->isMember($id);
        $member->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }
}
