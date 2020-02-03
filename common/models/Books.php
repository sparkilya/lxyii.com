<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Books model
 *
 * @property integer $id
 * @property string $name
 * @property string $authors
 * @property integer $pages
 * @property integer $year
 */
class Books extends ActiveRecord
{

    public function rules()
    {
        return [
            [['name', 'pages', 'year'], 'required'],
            [['name'], 'string', 'max' => 224],
            [['pages', 'year'], 'integer']
            
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'pages' => 'Pages',
            'year' => 'Year',
            'authorsdata' => 'Authors'
        ];
    }

    public function add($request)
    {
        if ($this->validate()) {

            $POST_VARIABLE = $request['Books'];
            
            $add = new Books;
            $add->name = $POST_VARIABLE['name'];
            $add->pages = $POST_VARIABLE['pages'];
            $add->year = $POST_VARIABLE['year'];
            $add->insert();
        }
        
        
        return $add->id;
    }


    public function edit($request, $id)
    {
        if ($this->validate()) {

            $POST_VARIABLE = $request['Books'];

            $add = new Books;
            $add = $add->findOne($id);
            $add->name = $POST_VARIABLE['name'];
            $add->pages = $POST_VARIABLE['pages'];
            $add->year = $POST_VARIABLE['year'];
            $add->save();
        }
        
        
        return $add->id;
    }


    public function deleteItem($id)
    {
        $deleteQuery = $this->find()->where(['id'=>$id])->one();
        if($deleteQuery){$deleteQuery->delete();}
    }
    


    /**
     * Merging tables
     *
     * @return array
     */

    public function getAuthorsdata()
    {
        return $this->hasMany(Link_ab::className(), ['book_id' => 'id']);
    }


    


}