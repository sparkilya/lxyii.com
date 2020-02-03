<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $name
 * @property integer $dob
 */
class Authors extends ActiveRecord
{

    public function rules()
    {
        return [
            // name and dob are both required
            [['name', 'dob'], 'required'],
            [['dob'], 'integer']
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
            'dob' => 'Year of birth'
        ];
    }


    public function add($request)
    {
        if ($this->validate()) {

            $POST_VARIABLE = $request['Authors'];
            
            $add = new Authors;
            $add->name = $POST_VARIABLE['name'];
            $add->dob = $POST_VARIABLE['dob'];
            $add->insert();
        }
        
        return false;
    }

    public function edit($request, $id)
    {
        if ($this->validate()) {

            $POST_VARIABLE = $request['Authors'];

            $add = new Authors;
            $add = $add->findOne($id);
            $add->name = $POST_VARIABLE['name'];
            $add->dob = $POST_VARIABLE['dob'];
            $add->save();
        }
        
        
        return $add->id;
    }


    public function deleteItem($id)
    {
        $deleteQuery = $this->find()->where(['id'=>$id])->one();
        if($deleteQuery){$deleteQuery->delete();}
    }

}