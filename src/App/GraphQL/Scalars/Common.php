<?php

namespace Lvcmf\Core\App\GraphQL\Scalars;

use Folklore\GraphQL\Support\Contracts\TypeConvertible;
use GraphQL\Type\Definition\ScalarType;

class Common extends ScalarType implements TypeConvertible
{
    /**
     * @var string
     */
    public $name = 'Common';

    /**
     * @var string
     */
    public $description = '';

    /**
     * @param mixed $value
     * @return mixed
     */
    public function serialize($value)
    {
        return $value;
    }

    /**
     * @param mixed $value
     * @return string
     */
    public function parseValue($value)
    {
        return $value;
    }

    /**
     * @param $ast
     * @return null|string
     */
    public function parseLiteral($ast)
    {
        return $ast;
    }

    /**
     * @return Main
     */
    public function toType()
    {
        return new static();
    }
}
