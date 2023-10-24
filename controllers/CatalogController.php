<?php

namespace app\controllers;

use app\models\Author;
use app\models\Book;
use app\models\services\GuestService;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CatalogController implements the CRUD actions for Book model.
 */
class CatalogController extends Controller
{

    public function __construct($id, $module, $config = [], private GuestService $guestService)
    {
        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Book models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists author Book models.
     *
     * @return string
     */
    public function actionAuthor(int $id)
    {
        $authorModel = Author::findOne($id);
        if (!$authorModel) {
            throw new NotFoundHttpException();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $authorModel->getBooks()
        ]);

        $subscribed = $this->guestService->getSubscribe(\Yii::$app->user->id, $id);

        return $this->render('author', [
            'dataProvider' => $dataProvider,
            'author' => $authorModel,
            'subscribed' => $subscribed
        ]);
    }

    /**
     * Displays a single Book model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Book();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSubscribes()
    {
        $subscribes = $this->guestService->getSubscribes(\Yii::$app->user->id);
        return $this->render('subscribes', ['subscribes' => $subscribes ?? []]);
    }

    public function actionSubscribe($id)
    {
        $this->guestService->subscribe(\Yii::$app->user->id, $id);
        return $this->redirect(['author', 'id' => $id]);
    }
    public function actionUnsubscribe($id)
    {
        $this->guestService->unsubscribe(\Yii::$app->user->id, $id);
        return $this->redirect(['author', 'id' => $id]);

    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
