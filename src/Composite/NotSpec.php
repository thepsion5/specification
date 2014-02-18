<?php namespace Thepsion5\Specification\Composite;

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
        return !$this->spec->isSatisfiedBy($candidate);
    }
}
