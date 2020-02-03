<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Search model for authors
 */
class Search_author extends Authors
{

    public $name;
    public $dob;

    public function rules()
    {
        return [
            [['name', 'dob'], 'safe']
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'dob' => 'Year of birth'
        ];
    }


    public function search($params) {
        $query = Authors::find();
        if(isset($params[0]['Search_author'])) {
            $pparams = $params[0]['Search_author'];
            $query->andWhere('name LIKE "%' . $pparams['name'] . '%" ' .
                'AND dob LIKE "%' . $pparams['dob'] . '%"'
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