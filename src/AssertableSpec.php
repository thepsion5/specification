<?php

namespace Thepsion5\Spec;

use Thepsion5\Spec\Exceptions\BaseSpecUnsatisfiedException;

abstract class AssertableSpec
{
    public abstract function isSatisfiedBy($subject);

    public function assertSatisfiedBy($subject)
    {
        if(!$this->isSatisfiedBy($subject)) {
            $this->assertionFailed($subject);
        }
    }

    protected function assertionFailed($subject)
    {
        $exception = new BaseSpecUnsatisfiedException();
        throw $exception->setSpec($this)->setSubject($subject);
    }
}
