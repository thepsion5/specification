<?php namespace Thepsion5\Specification\Testing;

use Mockery as M;

class TestFixture extends \PHPUnit_Framework_TestCase {

	protected function mockTrueSpec()
    {
        return M::mock('Thepsion5\Specification\SpecInterface')
            ->shouldReceive('isSatisfiedBy')
            ->andReturn(true)
            ->getMock();
    }

    protected function mockFalseSpec()
    {
        return M::mock('Thepsion5\Specification\SpecInterface')
            ->shouldReceive('isSatisfiedBy')
            ->andReturn(false)
            ->getMock();
    }

    protected function mockMessageSpec(array $messages = array())
    {
        return M::mock('Thepsion5\Specification\SpecInterface')
            ->shouldReceive('isSatisfiedBy')
            ->andReturn(false)
            ->shouldReceive('messages')
            ->andReturn($messages)
            ->getMock();
    }

    protected function mockCandidate(array $attrs = array())
    {
        return (object) $attrs;
    }

    protected function tearDown()
    {
        M::close();

        parent::tearDown();
    }

}
