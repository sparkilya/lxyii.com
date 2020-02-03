<?
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="authors-block">




<div class="ab-header">
    <div class="pull-left"><h1><?= Html::encode($this->title) ?></h1></div>

    <div class="pull-right">
    <?

    $customUrl = Yii::$app->getUrlManager()->createUrl(['library/addauthor']);
    echo Html::a('Add an author', $customUrl, [
        'class' => 'btn btn-primary',
        'role' => 'button',
        'title' => 'Add an author'
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
            'attribute' => 'dob',
            'value' => 'dob'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'edit' => function ($url, $model) {
                        $customUrl = Yii::$app->getUrlManager()->createUrl(['library/editauthor', 'id' => $model['id']]);
                        return Html::a('Edit', $customUrl, [
                            'class' => 'btn btn-info',
                            'role' => 'button',
                            'title' => 'Edit'
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        //$customUrl = Yii::$app->getUrlManager()->createUrl(['crm/landingpage/delete', 'id' => $model['id']]);
                        return Html::button('Delete', [
                            'class' => 'btn btn-danger author-delete-action',
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