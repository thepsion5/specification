<?php namespace Thepsion5\Specification\Composite;

class AndSpec extends AbstractCompositeSpec
{

    protected $haltOnFirstFailure = false;

    public function haltOnFirstFailure($halt = true)
    {
        $this->haltOnFirstFailure = (bool) $halt;

        return $this;
    }

    public function isSatisfiedBy($candidate)
    {
        $satisfied = true;
        foreach($this->specs as $spec) {
            if(!$spec->isSatisfiedBy($candidate)) {
                $satisfied = false;
                if($this->haltOnFirstFailure) {
                    break;
                }
            }
        }
        return $satisfied;
    }
}
