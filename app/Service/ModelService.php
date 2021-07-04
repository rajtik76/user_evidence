<?php


namespace App\Service;


use Nette\Database\Explorer;
use Nette\DI\Container;
use Nette\SmartObject;

final class ModelService
{
    use SmartObject;

    public function __construct(protected Explorer $explorer)
    {

    }

    public function getModel(string $model)
    {
        return new $model($this->explorer);
    }
}