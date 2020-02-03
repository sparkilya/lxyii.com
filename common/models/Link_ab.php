<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Model to link authors and books models
 *
 * @property integer $id
 * @property array $request
 * @property integer $link_id
 */
class Link_ab extends ActiveRecord
{

    public function add($request, $link_id)
    {
        $POST_VARIABLE = $request['Books']['authors'];
        $array = explode(',', $POST_VARIABLE);

        foreach($array as $value) {
            $add = new Link_ab;
            $add->book_id = $link_id;
            $add->author_id = $value;
            $add->insert();
        }

        return false;
    }


    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    public function getByid($id)
    {
        $getdata = $this->find()->where(['book_id'=>$id])->asArray()->all();
        return $getdata;
    }
    

    public function deleteItem($id)
    {
        $deleteQuery = $this->deleteAll(['book_id'=>$id]);
    }

    public function deleteAuthorItem($id)
    {
        $deleteQuery = $this->find()->where(['author_id'=>$id])->one();
        if($deleteQuery){$deleteQuery->delete();}
    }




}