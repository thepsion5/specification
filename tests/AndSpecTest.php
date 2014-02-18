<?php namespace Thepsion5\Specification\Testing;

use Thepsion5\Specification\Composite\AndSpec;

class AndSpecTest extends TestFixture {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testConstructedWithComponents()
	{
		$falseSpec = new AndSpec($this->mockTrueSpec(), $this->mockFalseSpec());
        $trueSpec = new AndSpec($this->mockTrueSpec(), $this->mockTrueSpec());
        $testCandidate = $this->mockCandidate();

        $this->assertFalse($falseSpec->isSatisfiedBy($testCandidate));
        $this->assertTrue($trueSpec->isSatisfiedBy($testCandidate));
	}

    public function testTrueComponentAdded()
    {
        $falseSpec = new AndSpec($this->mockTrueSpec(), $this->mockFalseSpec());
        $trueSpec = new AndSpec($this->mockTrueSpec(), $this->mockTrueSpec());
        $falseSpec->with($this->mockTrueSpec());
        $trueSpec->with($this->mockTrueSpec());
        $testCandidate = $this->mockCandidate();

        $this->assertFalse($falseSpec->isSatisfiedBy($testCandidate));
        $this->assertTrue($trueSpec->isSatisfiedBy($testCandidate));
    }

    public function testFalseComponentAdded()
    {
        $falseSpec = new AndSpec($this->mockTrueSpec(), $this->mockFalseSpec());
        $trueSpec = new AndSpec($this->mockTrueSpec(), $this->mockTrueSpec());
        $falseSpec->with($this->mockFalseSpec());
        $trueSpec->with($this->mockFalseSpec());
        $testCandidate = $this->mockCandidate();

        $this->assertFalse($falseSpec->isSatisfiedBy($testCandidate));
        $this->assertFalse($trueSpec->isSatisfiedBy($testCandidate));
    }

}