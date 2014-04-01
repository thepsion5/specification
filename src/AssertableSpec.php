<?php

namespace Thepsion5\Spec;

use Thepsion5\Spec\Exceptions\BaseSpecUnsatisfiedException;

/**
 * Class AssertableSpec
 * @package Thepsion5\Spec
 */
abstract class AssertableSpec
{
    /**
     * Checks to see if a specified object meets the specification
     * @param  mixed $subject The object or value being examined
     * @return bool           True if the specification is satisfied, false otherwise
     */
    public abstract function isSatisfiedBy($subject);

    /**
     * Asserts that a specified object meets the specification
     * @param mixed $subject The object or value being examined
     * @throws Exceptions\SpecUnsatisfiedException If the assertion fails
     */
    public function assertSatisfiedBy($subject)
    {
        if(!$this->isSatisfiedBy($subject)) {
            $this->assertionFailed($subject);
        }
    }

    /**
     * Creates and throws an exception after adding references to itself
     * and the subject.
     * @param mixed $subject The object or value being examined
     * @throws Exceptions\BaseSpecUnsatisfiedException
     */
    protected function assertionFailed($subject)
    {
        $exception = new BaseSpecUnsatisfiedException();
        throw $exception->setSpec($this)->setSubject($subject);
    }
}
