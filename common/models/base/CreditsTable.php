<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "credits_table".
 *
 * @property string $account_name
 * @property string $char_name
 * @property double $credits
 * @property string $aliasModel
 */
abstract class CreditsTable extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'credits_table';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_name', 'char_name'], 'required'],
            [['account_name', 'char_name'], 'string'],
            [['credits'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_name' => 'Account Name',
            'char_name' => 'Char Name',
            'credits' => 'Credits',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\CreditsTableQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CreditsTableQuery(get_called_class());
    }


}
