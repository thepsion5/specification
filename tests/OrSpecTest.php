<?php namespace Thepsion5\Specification\Testing;

use Thepsion5\Specification\Composite\OrSpec;

class OrSpecTest extends TestFixture {

    public function testConstructedWithComponents()
    {
        $falseSpec = new OrSpec($this->mockFalseSpec(), $this->mockFalseSpec());
        $trueSpec = new OrSpec($this->mockTrueSpec(), $this->mockFalseSpec());
        $testCandidate = $this->mockCandidate();

        $this->assertFalse($falseSpec->isSatisfiedBy($testCandidate));
        $this->assertTrue($trueSpec->isSatisfiedBy($testCandidate));
    }

    public function testTrueComponentAdded()
    {
        $falseSpec = new OrSpec($this->mockFalseSpec(), $this->mockFalseSpec());
        $trueSpec = new OrSpec($this->mockTrueSpec(), $this->mockFalseSpec());
        $falseSpec->with($this->mockTrueSpec());
        $trueSpec->with($this->mockTrueSpec());
        $testCandidate = $this->mockCandidate();

        $this->assertTrue($falseSpec->isSatisfiedBy($testCandidate));
        $this->assertTrue($trueSpec->isSatisfiedBy($testCandidate));
    }

    public function testFalseComponentAdded()
    {
        $falseSpec = new OrSpec($this->mockFalseSpec(), $this->mockFalseSpec());
        $trueSpec = new OrSpec($this->mockTrueSpec(), $this->mockFalseSpec());
        $falseSpec->with($this->mockFalseSpec());
        $trueSpec->with($this->mockFalseSpec());
        $testCandidate = $this->mockCandidate();

        $this->assertFalse($falseSpec->isSatisfiedBy($testCandidate));
        $this->assertTrue($trueSpec->isSatisfiedBy($testCandidate));
    }

}