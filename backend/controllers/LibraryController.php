<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use common\models\Authors;
use common\models\Books;
use common\models\Link_ab;
use common\models\Search_author;
use common\models\Search_books;
/**
 * Library controller
 */
class LibraryController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays all books.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new Search_books();
        $dataProvider = $searchModel->search([Yii::$app->request->queryParams]);
        

        return $this->render('books', [
            'dataprovider' => $dataProvider,
            'searchmodel' => $searchModel
        ]);
    }



    /**
     * Page to add a new book.
     *
     * @return string
     */
    public function actionAddbook()
    {

        $model = new Books();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            
            $add_id = $model->add(Yii::$app->request->post());

            $model_link = new Link_ab();
            $link_val = $model_link->add(Yii::$app->request->post(), $add_id);

            return $this->render('addBook', [
                'model' => $model,
                'success' => true
            ]);
        } else {
            return $this->render('addBook', [
                'model' => $model,
            ]);
        }

    }


    /**
     * Page to edit a book.
     *
     * @return string
     */
    public function actionEditbook()
    {

        $request = Yii::$app->request;
        $id = $request->get('id');

        
        $model = new Books();

        // getting book info
        $data = $model->findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            
            $add_id = $model->edit(Yii::$app->request->post(), $id);

            $model_link = new Link_ab();
            $delete_link = $model_link->deleteItem($id);
            $link_val = $model_link->add(Yii::$app->request->post(), $add_id);

            return $this->render('editBook', [
                'model' => $model,
                'data' => $data,
                'success' => true
            ]);
        } else {
            return $this->render('editBook', [
                'model' => $model,
                'data' => $data
            ]);
        }
    }


    /**
     * Book delete action.
     *
     * @return string
     */
    public function actionDeletebook()
    {
        $request = Yii::$app->request;
        $id = $request->post('id');

        $deleteFromBooks = new Books();
        $deleteFromBooks->deleteItem($id);

        $deleteFromLink = new Link_ab();
        $deleteFromLink->deleteItem($id);
    }



     /**
     * Page to view all the authors.
     *
     * @return string
     */
    public function actionAuthors()
    {
        
        //$dataProvider = new ActiveDataProvider([ 'query' => Authors::find()]); $dataProvider->pagination->pageSize = 12;

        $searchModel = new Search_author();
        $dataProvider = $searchModel->search([Yii::$app->request->queryParams]);

        return $this->render('authors', [
            'dataprovider' => $dataProvider,
            'searchmodel' => $searchModel
        ]);
    }


    /**
     * Page to add an author.
     *
     * @return string
     */
    public function actionAddauthor()
    {

        $model = new Authors();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->add(Yii::$app->request->post());

            return $this->render('addAuthor', [
                'model' => $model,
                'success' => true
            ]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('addAuthor', [
                'model' => $model,
            ]);
        }

        
    }


    /**
     * Page to edit an author.
     *
     * @return string
     */
    public function actionEditauthor()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');

        
        $model = new Authors();

        // getting book info
        $data = $model->findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            
            $add_id = $model->edit(Yii::$app->request->post(), $id);


            return $this->render('editAuthor', [
                'model' => $model,
                'data' => $data,
                'success' => true
            ]);
        } else {
            return $this->render('editAuthor', [
                'model' => $model,
                'data' => $data
            ]);
        }
    }


    /**
     * Book delete action.
     *
     * @return string
     */
    public function actionDeleteauthor()
    {
        $request = Yii::$app->request;
        $id = $request->post('id');

        $deleteFromAuthors = new Authors();
        $deleteFromAuthors->deleteItem($id);

        $deleteFromLink = new Link_ab();
        $deleteFromLink->deleteAuthorItem($id);
        
    }


    /**
     * Ajax gets json array of all authors.
     *
     * @return array
     */
    public function actionGetjsonauthors()
    {
        $model = new Authors();
        $authors = $model->find()->asArray()->all();

        return json_encode($authors);
    }



    /**
     * Ajax gets json array of authors of specific ID.
     *
     * @return array
     */
    public function actionGetjsonauthorsbyid()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');


        $model = Link_ab::find()
        ->where(['book_id'=>$id])
        ->joinWith(['author'])
        ->asArray()
        ->all();

        
        return json_encode($model);
    }


}