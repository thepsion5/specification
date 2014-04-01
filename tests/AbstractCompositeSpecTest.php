<?php

use Thepsion5\Spec\CompositeAssertableSpec;

class AbstractCompositeSpecTest extends TestFixture
{

    protected $spec;

    protected $subject;

    public function setUp()
    {
        $this->subject = new stdClass();
        $this->spec = new StubCompositeSpec();
    }

    public function testSatisfiedWithNoComponents()
    {
        $this->spec->assertSatisfiedBy($this->subject);

        $this->assertTrue($this->spec->isSatisfiedBy($this->subject));
    }

    public function testNotSatisfiedWithOneUnsatisfiedAndComponent()
    {
        $this->spec->andSatisfiedBy($this->stubUnsatisfiedSpec());

        $this->assertFalse($this->spec->isSatisfiedBy($this->subject));
    }

    /**
     * @expectedException \Thepsion5\Spec\Exceptions\BaseSpecUnsatisfiedException
     */
    public function testThrowsExceptionOnAssertWithUnsatisfiedComponentSpec()
    {
        $this->spec->andSatisfiedBy($this->stubUnsatisfiedSpec());

        $this->spec->assertSatisfiedBy($this->subject);
    }

    public function testSatisfiedWithTwoPositiveAndComponents()
    {
        $this->spec
            ->andSatisfiedBy($this->stubSatisfiedSpec())
            ->andSatisfiedBy($this->stubSatisfiedSpec());

        $this->spec->assertSatisfiedBy($this->subject);
        $this->assertTrue($this->spec->isSatisfiedBy($this->subject));
    }

    public function testNotSatisfiedWithOneNegativeAndComponent()
    {
        $this->spec
            ->andSatisfiedBy($this->stubSatisfiedSpec())
            ->andSatisfiedBy($this->stubUnsatisfiedSpec());

        $this->assertFalse($this->spec->isSatisfiedBy($this->subject));
    }

    public function testSatisfiedWithOnePositiveAndComponentPlusOneNegativeOrComponent()
    {
        $this->spec
            ->andSatisfiedBy($this->stubSatisfiedSpec())
            ->andSatisfiedBy($this->stubUnsatisfiedSpec());

        $this->assertFalse($this->spec->isSatisfiedBy($this->subject));
    }

    public function testNotSatisfiedWithOneNegativeAndComponentPlusOnePositiveOrComponent()
    {
        $this->spec
            ->andSatisfiedBy($this->stubSatisfiedSpec())
            ->orSatisfiedBy($this->stubUnsatisfiedSpec());

        $this->assertFalse($this->spec->isSatisfiedBy($this->subject));
    }

    public function testSatisfiedWithOnePositiveOrComponentPlusOneNegativeOrComponent()
    {
        $this->spec
            ->orSatisfiedBy($this->stubSatisfiedSpec())
            ->orSatisfiedBy($this->stubUnsatisfiedSpec());

        $this->assertTrue($this->spec->isSatisfiedBy($this->subject));
    }

    public function testSatisfiedWithOneNegativeOrComponentPlusOnePositiveOrComponent()
    {
        $this->spec
            ->orSatisfiedBy($this->stubSatisfiedSpec())
            ->orSatisfiedBy($this->stubUnsatisfiedSpec());

        $this->spec->assertSatisfiedBy($this->subject);
    }

    public function testAssertSatisfiedWithOneNegativeOrComponentPlusOnePositiveOrComponent()
    {
        $this->spec
            ->orSatisfiedBy($this->stubUnsatisfiedSpec())
            ->orSatisfiedBy($this->stubSatisfiedSpec());

        $this->spec->assertSatisfiedBy($this->subject);
    }

    /**
     * @expectedException \Thepsion5\Spec\Exceptions\BaseSpecUnsatisfiedException
     */
    public function testThrowsExceptionOnAssertWithOneNegativeOrComponent()
    {
        $this->spec->orSatisfiedBy($this->stubUnsatisfiedSpec());

        $this->spec->assertSatisfiedBy($this->subject);
    }

}

class StubCompositeSpec extends CompositeAssertableSpec { }