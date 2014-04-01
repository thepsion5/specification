<?php

use Thepsion5\Spec\AssertableSpec;

class TestFixture extends PHPUnit_Framework_TestCase
{

    protected function stubSatisfiedSpec()
    {
        return new StubSatisfiedSpec;
    }

    protected function stubUnsatisfiedSpec()
    {
        return new StubUnsatisfiedSpec;
    }
}

class StubSatisfiedSpec extends AssertableSpec
{
    public function isSatisfiedBy($subject) { return true; }
}

class StubUnsatisfiedSpec extends AssertableSpec
{
    public function isSatisfiedBy($subject) { return false; }
}