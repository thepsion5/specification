<?php namespace Thepsion5\Specification\Testing;

use Thepsion5\Specification\Composite\NotSpec;

class NotSpecTest extends TestFixture {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testConstructedWithComponents()
    {
        $falseSpec = new NotSpec($this->mockTrueSpec());
        $trueSpec = new NotSpec($this->mockfalseSpec());
        $testCandidate = $this->mockCandidate();

        $this->assertFalse($falseSpec->isSatisfiedBy($testCandidate));
        $this->assertTrue($trueSpec->isSatisfiedBy($testCandidate));
    }

    public function testTrueComponentAdded()
    {
        $falseSpec = new NotSpec($this->mockTrueSpec());
        $trueSpec = new NotSpec($this->mockFalseSpec());
        $testCandidate = $this->mockCandidate();

        $this->assertFalse($falseSpec->isSatisfiedBy($testCandidate));
        $this->assertTrue($trueSpec->isSatisfiedBy($testCandidate));
    }

    public function testFalseComponentAdded()
    {
        $falseSpec = new NotSpec($this->mockTrueSpec());
        $trueSpec = new NotSpec($this->mockFalseSpec());
        $testCandidate = $this->mockCandidate();

        $this->assertFalse($falseSpec->isSatisfiedBy($testCandidate));
        $this->assertTrue($trueSpec->isSatisfiedBy($testCandidate));
    }

}