<?php namespace Thepsion5\Specification;

interface SpecInterface
{
    public function isSatisfiedBy($object);

    public function messages();
}
