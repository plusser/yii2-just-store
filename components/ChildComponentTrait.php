<?php 

namespace JustStore\components;

trait ChildComponentTrait
{

    protected $parentComponent;

    public function setParentComponent(Component $parentComponent)
    {
        $this->parentComponent = $parentComponent;

        return $this;
    }

    protected function getParentComponent()
    {
        return $this->parentComponent;
    }

}
