<?php


namespace app\models;


use yii\base\Model;

class KeywordInput extends Model
{
    public $keyWord;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['keyWord'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'keyWord' => 'keyWord',
        ];
    }

    public function analiz()
    {
        return true;
    }

}