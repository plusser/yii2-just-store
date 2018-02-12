<?php 

namespace JustStore\interfaces;

interface BasketItemInterface extends \Serializable
{

    public function getProduct();

    public function setProduct(ProductInterface $product);

    public function getName();

    public function setName($name);

    public function getPrice();

    public function setPrice($price);

    public function getCount();

    public function setCount($count);

    public function getTotalPrice();

    public function setAttribute($name, $value);

    public function hasAttribute($name);

}
