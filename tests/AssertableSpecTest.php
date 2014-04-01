<?php

use Thepsion5\Spec\Exceptions\BaseSpecUnsatisfiedException;

class AssertableSpecTest extends TestFixture
{
    public function testAssertSatisfiedByDoesNotThrowExceptionWhenSpecSatisfied()
    {
        $spec = new StubSatisfiedSpec;

        $spec->assertSatisfiedBy(new stdClass);
    }

    /**
     * @expectedException \Thepsion5\Spec\Exceptions\BaseSpecUnsatisfiedException
     */
    public function testAssertSatisfiedByThrowsExceptionWhenSpecNotSatisfied()
    {
        $spec = new StubUnsatisfiedSpec;

        $spec->assertSatisfiedBy(new stdClass);
    }

    public function testSetsExceptionSpecAndSubjectOnFailedAssertion()
    {
        $spec = new StubUnsatisfiedSpec;
        $subject = new stdClass;

        try {
            $spec->assertSatisfiedBy($subject);
        } catch(BaseSpecUnsatisfiedException $exception) {
            $this->assertEquals($spec, $exception->getSpec());
            $this->assertEquals($subject, $exception->getSubject());
        }
    }
}
