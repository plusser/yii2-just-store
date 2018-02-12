<?php 

namespace JustStore\components;

use JustStore\interfaces\BasketItemInterface;
use yii\base\InvalidParamException;

class Basket extends \yii\base\Component
{

    use ChildComponentTrait;

    public $storage;
    public $storageKey = 'JustStore::basket';

    protected $itemList = [];

    protected function checkItem($itemId)
    {
        if(!isset($this->itemList[$itemId])){
            throw new InvalidParamException('Item not found');
        }
    }

    public function getItem($itemId)
    {
        $this->checkItem($itemId);

        return $this->itemList[$itemId];
    }

    public function getItems()
    {
        return $this->itemList;
    }

    public function getItemsCount()
    {
        return count($this->itemList);
    }

    public function getProductUnitCount()
    {
        $result = 0;

        foreach($this->itemList as $item){
            $result += $item->getCount();
        }

        return $result;
    }

    public function addItem(BasketItemInterface $item)
    {
        $this->itemList[$itemId = md5(microtime())] = $item;

        $this->save();

        return $itemId;
    }

    public function updateItem($itemId, $attributes)
    {
        $this->checkItem($itemId);

        foreach($attributes as $k => $v){
            $this->itemList[$itemId]->hasAttribute($k) AND $this->itemList[$itemId]->setAttribute($k, $v);
        }

        $this->save();

        return $this;
    }

    public function deleteItem($itemId)
    {
        $this->checkItem($itemId);

        unset($this->itemList[$itemId]);

        $this->save();

        return $this;
    }

    public function getCost()
    {
        $result = 0;

        foreach($this->itemList as $item){
            $result += $item->getTotalPrice();
        }

        return $result;
    }

    public function init()
    {
        $this->load();
    }

    public function clear()
    {
        if($this->storage->has($this->storageKey)){
            $this->itemList = [];
            $this->storage->remove($this->storageKey);
        }
    }

    protected function save()
    {
        return $this->storage->set($this->storageKey, serialize($this->itemList));
    }

    protected function load()
    {
        if($this->storage->has($this->storageKey)){
            $this->itemList = unserialize($this->storage->get($this->storageKey));
        }
    }

}
