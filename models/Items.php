<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ospos_items".
 *
 * @property string $name
 * @property string $category
 * @property integer $supplier_id
 * @property string $item_number
 * @property string $description
 * @property string $cost_price
 * @property string $unit_price
 * @property string $quantity
 * @property string $reorder_level
 * @property string $location
 * @property integer $item_id
 * @property integer $allow_alt_description
 * @property integer $is_serialized
 * @property integer $deleted
 * @property string $custom1
 * @property string $custom2
 * @property string $custom3
 * @property string $custom4
 * @property string $custom5
 * @property string $custom6
 * @property string $custom7
 * @property string $custom8
 * @property string $custom9
 * @property string $custom10
 *
 * @property OsposInventory[] $osposInventories
 * @property OsposItemKitItems[] $osposItemKitItems
 * @property OsposSuppliers $supplier
 * @property OsposItemsTaxes[] $osposItemsTaxes
 * @property OsposReceivingsItems[] $osposReceivingsItems
 * @property OsposSalesItems[] $osposSalesItems
 * @property OsposSalesItemsTaxes[] $osposSalesItemsTaxes
 * @property OsposSalesSuspendedItems[] $osposSalesSuspendedItems
 * @property OsposSalesSuspendedItemsTaxes[] $osposSalesSuspendedItemsTaxes
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ospos_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category', 'cost_price', 'unit_price', 'allow_alt_description', 'is_serialized', 'custom1', 'custom2', 'custom3', 'custom4', 'custom5', 'custom6', 'custom7', 'custom8', 'custom9', 'custom10'], 'required'],
            [['supplier_id', 'allow_alt_description', 'is_serialized', 'deleted'], 'integer'],
            [['cost_price', 'unit_price', 'quantity', 'reorder_level'], 'number'],
            [['name', 'category', 'item_number', 'description', 'location'], 'string', 'max' => 255],
            [['custom1', 'custom2', 'custom3', 'custom4', 'custom5', 'custom6', 'custom7', 'custom8', 'custom9', 'custom10'], 'string', 'max' => 25],
            [['item_number'], 'unique'],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => OsposSuppliers::className(), 'targetAttribute' => ['supplier_id' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'category' => 'Category',
            'supplier_id' => 'Supplier ID',
            'item_number' => 'Item Number',
            'description' => 'Description',
            'cost_price' => 'Cost Price',
            'unit_price' => 'Unit Price',
            'quantity' => 'Quantity',
            'reorder_level' => 'Reorder Level',
            'location' => 'Location',
            'item_id' => 'Item ID',
            'allow_alt_description' => 'Allow Alt Description',
            'is_serialized' => 'Is Serialized',
            'deleted' => 'Deleted',
            'custom1' => 'Custom1',
            'custom2' => 'Custom2',
            'custom3' => 'Custom3',
            'custom4' => 'Custom4',
            'custom5' => 'Custom5',
            'custom6' => 'Custom6',
            'custom7' => 'Custom7',
            'custom8' => 'Custom8',
            'custom9' => 'Custom9',
            'custom10' => 'Custom10',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposInventories()
    {
        return $this->hasMany(OsposInventory::className(), ['trans_items' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposItemKitItems()
    {
        return $this->hasMany(OsposItemKitItems::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(OsposSuppliers::className(), ['person_id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposItemsTaxes()
    {
        return $this->hasMany(OsposItemsTaxes::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposReceivingsItems()
    {
        return $this->hasMany(OsposReceivingsItems::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposSalesItems()
    {
        return $this->hasMany(OsposSalesItems::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposSalesItemsTaxes()
    {
        return $this->hasMany(OsposSalesItemsTaxes::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposSalesSuspendedItems()
    {
        return $this->hasMany(OsposSalesSuspendedItems::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsposSalesSuspendedItemsTaxes()
    {
        return $this->hasMany(OsposSalesSuspendedItemsTaxes::className(), ['item_id' => 'item_id']);
    }
}
