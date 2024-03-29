<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "PcbangList".
 *
 * @property string $AccountID
 * @property string $PcbangCode
 * @property string $PcbangName
 * @property string $Owner
 * @property string $SCN
 * @property string $PcbangAddress
 * @property string $PcbangZipcode
 * @property string $OwnerAddress
 * @property string $OwnerZipcode
 * @property string $PcbangTel
 * @property string $Uptae
 * @property string $OpenDate
 * @property string $Upzong
 * @property string $Semuser
 * @property string $RequestDate
 * @property string $Result
 * @property string $ResultDate
 * @property string $ResultDesc
 * @property string $ResultUser
 * @property integer $ResultNo
 * @property string $aliasModel
 */
abstract class PcbangList extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PcbangList';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AccountID', 'PcbangCode', 'PcbangName', 'Owner', 'SCN', 'PcbangAddress', 'PcbangZipcode', 'OwnerAddress', 'OwnerZipcode', 'PcbangTel', 'Uptae', 'OpenDate', 'Upzong', 'Semuser', 'RequestDate', 'Result', 'ResultDesc', 'ResultUser', 'ResultNo'], 'required'],
            [['AccountID', 'PcbangCode', 'PcbangName', 'Owner', 'SCN', 'PcbangAddress', 'PcbangZipcode', 'OwnerAddress', 'OwnerZipcode', 'PcbangTel', 'Uptae', 'OpenDate', 'Upzong', 'Semuser', 'Result', 'ResultDesc', 'ResultUser'], 'string'],
            [['RequestDate', 'ResultDate'], 'safe'],
            [['ResultNo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AccountID' => 'Account ID',
            'PcbangCode' => 'Pcbang Code',
            'PcbangName' => 'Pcbang Name',
            'Owner' => 'Owner',
            'SCN' => 'Scn',
            'PcbangAddress' => 'Pcbang Address',
            'PcbangZipcode' => 'Pcbang Zipcode',
            'OwnerAddress' => 'Owner Address',
            'OwnerZipcode' => 'Owner Zipcode',
            'PcbangTel' => 'Pcbang Tel',
            'Uptae' => 'Uptae',
            'OpenDate' => 'Open Date',
            'Upzong' => 'Upzong',
            'Semuser' => 'Semuser',
            'RequestDate' => 'Request Date',
            'Result' => 'Result',
            'ResultDate' => 'Result Date',
            'ResultDesc' => 'Result Desc',
            'ResultUser' => 'Result User',
            'ResultNo' => 'Result No',
        ];
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\PcbangListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PcbangListQuery(get_called_class());
    }


}
