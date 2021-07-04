<?php


namespace App\Model;


use Nette\Database\Connection;
use Nette\Database\Explorer;
use Nette\DI\Container;
use Nette\SmartObject;

abstract class AModel
{
    use SmartObject;

    public function __construct(protected Explorer $explorer)
    {

    }
}