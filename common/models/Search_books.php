<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Search model for books
 */
class Search_books extends Books
{

    public $name;
    public $pages;
    public $year;

    public function rules()
    {
        return [
            [['name', 'pages', 'year'], 'safe']
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'pages' => 'Pages',
            'year' => 'Year of birth'
        ];
    }


    public function search($params) {
        $query = Books::find()->joinWith(['authorsdata.author']);
        if(isset($params[0]['Search_books'])) {
            $pparams = $params[0]['Search_books'];
            $query->andWhere('books.name LIKE "%' . $pparams['name'] . '%" ' .
                'AND books.pages LIKE "%' . $pparams['pages'] . '%"' .
                'AND books.year LIKE "%' . $pparams['year'] . '%"'
            );
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        return $dataProvider;
    }


}