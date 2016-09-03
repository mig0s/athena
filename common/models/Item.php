<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property string $title
 * @property string $author
 * @property string $editor
 * @property string $publisher
 * @property string $pub_place
 * @property string $pub_year
 * @property string $price
 * @property string $price_currency
 * @property string $price_sgd
 * @property string $isbn
 * @property string $edition
 * @property integer $num_of_copies
 * @property integer $created_by
 * @property string $created_at
 * @property integer $edited_by
 * @property string $edited_at
 * @property string $accompanying_materials
 * @property integer $subject_id
 * @property integer $spot_tag_id
 * @property integer $location_id
 * @property integer $collection_id
 * @property integer $category_id
 * @property integer $sub_category_id
 * @property integer $item_status_id
 *
 * @property Fine[] $fines
 * @property Category $category
 * @property Collection $collection
 * @property User $createdBy
 * @property User $editedBy
 * @property ItemStatus $itemStatus
 * @property SettingsVenues $location
 * @property SpotTag $spotTag
 * @property SubCategory $subCategory
 * @property Subject $subject
 * @property ItemPair[] $itemPairs
 * @property ItemPair[] $itemPairs0
 * @property Loan[] $loans
 * @property Remarks[] $remarks
 * @property Reservation[] $reservations
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['id', 'num_of_copies', 'created_by', 'edited_by', 'subject_id', 'spot_tag_id', 'location_id', 'collection_id', 'category_id', 'sub_category_id', 'item_status_id'], 'integer'],
            [['pub_year', 'created_at', 'edited_at'], 'safe'],
            [['price', 'price_sgd'], 'number'],
            [['title', 'accompanying_materials'], 'string', 'max' => 256],
            [['author'], 'string', 'max' => 128],
            [['editor', 'publisher'], 'string', 'max' => 64],
            [['pub_place'], 'string', 'max' => 32],
            [['price_currency'], 'string', 'max' => 3],
            [['isbn', 'edition'], 'string', 'max' => 20],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['collection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Collection::className(), 'targetAttribute' => ['collection_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['edited_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['edited_by' => 'id']],
            [['item_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemStatus::className(), 'targetAttribute' => ['item_status_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => SettingsVenues::className(), 'targetAttribute' => ['location_id' => 'id']],
            [['spot_tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpotTag::className(), 'targetAttribute' => ['spot_tag_id' => 'id']],
            [['sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategory::className(), 'targetAttribute' => ['sub_category_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'author' => 'Author',
            'editor' => 'Editor',
            'publisher' => 'Publisher',
            'pub_place' => 'Pub Place',
            'pub_year' => 'Pub Year',
            'price' => 'Price',
            'price_currency' => 'Price Currency',
            'price_sgd' => 'Price Sgd',
            'isbn' => 'Isbn',
            'edition' => 'Edition',
            'num_of_copies' => 'Num Of Copies',
            'created_by' => 'Created By',
            'createdByName' => 'Created By',
            'created_at' => 'Created At',
            'edited_by' => 'Edited By',
            'editedByName' => 'Edited By',
            'edited_at' => 'Edited At',
            'accompanying_materials' => 'Accompanying Materials',
            'subject_id' => 'Subject',
            'subjectName' => 'Subject',
            'spot_tag_id' => 'Spot Tag',
            'spotTagDesc' => 'Spot Tag Info',
            'location_id' => 'Location',
            'locationName' => 'Location',
            'collection_id' => 'Collection',
            'collectionName' => 'Collection',
            'category_id' => 'Category',
            'categoryName' => 'Category',
            'sub_category_id' => 'Sub Category',
            'sub_category_name' => 'Sub Category',
            'item_status_id' => 'Item Status',
            'itemStatusName' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFines()
    {
        return $this->hasMany(Fine::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCategoryName()
    {
        return $this->category->name;
    }

    public function getCategoryList()
    {
        $droptions = Category::find()->orderBy('name')->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollection()
    {
        return $this->hasOne(Collection::className(), ['id' => 'collection_id']);
    }

    public function getCollectionName()
    {
        return $this->collection->name;
    }

    public function getCollectionList()
    {
        $droptions = Collection::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'name');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getCreatedByName()
    {
        $this->createdBy->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEditedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'edited_by']);
    }

    public function getEditedByName()
    {
        if (!is_null($this->editedBy)) {
            return $this->editedBy->username;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemStatus()
    {
        return $this->hasOne(ItemStatus::className(), ['id' => 'item_status_id']);
    }

    public function getItemStatusName()
    {
        return $this->itemStatus->name;
    }

    public function getItemStatusList()
    {
        $droptions = ItemStatus::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(SettingsVenues::className(), ['id' => 'location_id']);
    }

    public function getLocationName() {
        return $this->location->name;
    }

    public function getLocationList()
    {
        $droptions = SettingsVenues::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpotTag()
    {
        return $this->hasOne(SpotTag::className(), ['id' => 'spot_tag_id']);
    }

    public function getSpotTagDesc()
    {
        return $this->spotTag->description;
    }

    public function getSpotTagList()
    {
        $droptions = SpotTag::find()->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'colour');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::className(), ['id' => 'sub_category_id']);
    }

    public function getSubCategoryName()
    {
        return $this->subCategory->name;
    }

    public function getSubCategoryList()
    {
        $droptions = SubCategory::find()->orderBy('name')->asArray()->all();
        return ArrayHelper::map($droptions, 'id', 'name');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    public function getSubjectName()
    {
        return $this->subject->name;
    }

    public function getSubjectList()
    {
        $droptions = Subject::find()->asArray()->all();
        return ArrayHelper::map($droptions,'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemPairs()
    {
        return $this->hasMany(ItemPair::className(), ['item1' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemPairs0()
    {
        return $this->hasMany(ItemPair::className(), ['item2' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemarks()
    {
        return $this->hasMany(Remarks::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservation::className(), ['item_id' => 'id']);
    }
}
