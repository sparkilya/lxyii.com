<?

/* @var $this yii\web\View */
/* @var $grid yii\grid\GridView */
/* @var $model \common\models\Authors */


use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="books-block">




<div class="ab-header">
    <div class="pull-left"><h1><?= Html::encode($this->title) ?></h1></div>

    
    <div class="pull-right">

    <?

    $customUrl = Yii::$app->getUrlManager()->createUrl(['library/addbook']);
    echo Html::a('Add a book', $customUrl, [
        'class' => 'btn btn-primary',
        'role' => 'button',
        'title' => 'Add a book'
    ]);

    ?>
   
    </div>
</div>



<div class="a-data-block">
<?= GridView::widget([
        'dataProvider' => $dataprovider,
        'filterModel' => $searchmodel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'name',
                'value' => 'name'
            ],
            [
                'attribute' => 'pages',
                'value' => 'pages'
            ],
            [
                'attribute' => 'year',
                'value' => 'year'
            ],
            [
             'attribute'=>'authorsdata',
             'content' => function ($data) {
                $vstring = '';
                 if ($data->authorsdata) {
                    foreach($data->authorsdata as $val) {
                        
                        $vstring = $vstring.' <span class="author-span"><b>'.$val['author']['name'].'</b> ('.$val['author']['dob'].')</span>';
                        
                    }
                 }
                 return $vstring;
             },
    
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'edit' => function ($url, $model) {
                        $customUrl = Yii::$app->getUrlManager()->createUrl(['library/editbook', 'id' => $model['id']]);
                        return Html::a('<span><i class="fas fa-pencil-alt" aria-hidden="true"></i> Edit</span>', $customUrl, [
                            'class' => 'btn btn-info',
                            'role' => 'button',
                            'title' => 'Edit'
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        //$customUrl = Yii::$app->getUrlManager()->createUrl(['crm/landingpage/delete', 'id' => $model['id']]);
                        return Html::button('<span><i class="fa fa-ban" aria-hidden="true"></i> Delete</span>', [
                            'class' => 'btn btn-danger book-delete-action',
                            'role' => 'button',
                            'title' => 'Delete',
                            'data' => $model['id']
                        ]);
                    }
                ],
                'template' => '{edit} {delete}',
            ],
        ],
    ]); ?>

</div>


</div>