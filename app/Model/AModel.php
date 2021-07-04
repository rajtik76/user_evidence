<?php


namespace App\Model;


use Nette\Database\Explorer;
use Nette\Database\Table\Selection;
use Nette\SmartObject;

abstract class AModel
{
    use SmartObject;

    protected string $table;

    public function __construct(protected Explorer $explorer)
    {

    }

    protected function getTable(): Selection
    {
        return $this->explorer->table($this->table);
    }
}