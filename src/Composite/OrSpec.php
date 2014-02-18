<?php namespace Thepsion5\Specification\Composite;

class OrSpec extends AbstractCompositeSpec
{

    protected $haltOnFirstSuccess = true;

    public function haltOnFirstSuccess($halt = true)
    {
        $this->haltOnFirstSuccess = (bool) $halt;

        return $this;
    }

    public function isSatisfiedBy($candidate)
    {
        $satisfied = false;
        foreach($this->specs as $spec) {
            if($spec->isSatisfiedBy($candidate)) {
                $satisfied = true;
                if($this->haltOnFirstSuccess) {
                    break;
                }
            }
        }
        return $satisfied;
    }
}
