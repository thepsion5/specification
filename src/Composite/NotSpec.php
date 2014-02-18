<?php namespace Thepsion5\Specification\Composite;

use Thepsion5\Specification\SpecInterface;

class NotSpec extends AbstractCompositeSpec
{
    public function __construct(SpecInterface $spec)
    {
        $this->with($spec);
    }

    public function with(SpecInterface $spec)
    {
        $this->specs[0] = $spec;
    }

    public function isSatisfiedBy($candidate)
    {
        return !$this->specs[0]->isSatisfiedBy($candidate);
    }
}
