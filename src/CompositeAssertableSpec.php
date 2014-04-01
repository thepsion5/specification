<?php
namespace Thepsion5\Spec;

use Thepsion5\Spec\Exceptions\SpecUnsatisfiedException;

abstract class CompositeAssertableSpec extends AssertableSpec
{
    /**
     * Contains and specifications
     * @var array
     */
    protected $andSpecs = [];

    /**
     * Contains or specifications
     * @var array
     */
    protected $orSpecs = [];

    public function andSatisfiedBy(AssertableSpec $spec)
    {
        $this->andSpecs[] = $spec;
        return $this;
    }

    public function orSatisfiedBy(AssertableSpec $spec)
    {
        $this->orSpecs[] = $spec;
        return $this;
    }

    public function isSatisfiedBy($subject)
    {
        return $this->andSpecsSatisfied($subject) && $this->orSpecsSatisfied($subject);
    }

    protected function andSpecsSatisfied($subject)
    {
        $satisfied = true;
        foreach($this->andSpecs as $spec) {
            if(!$spec->isSatisfiedBy($subject)) {
                $satisfied = false;
                break;
            }
        }
        return $satisfied;
    }

    protected function orSpecsSatisfied($subject)
    {
        if(empty($this->orSpecs)) return true;
        $satisfied = false;
        foreach($this->orSpecs as $spec) {
            if($spec->isSatisfiedBy($subject)) {
                $satisfied = true;
                break;
            }
        }
        return $satisfied;
    }

    public function assertSatisfiedBy($subject)
    {
        $this->assertAndSpecsSatisfied($subject);
        $this->assertOrSpecsSatisfied($subject);
    }

    protected function assertAndSpecsSatisfied($subject)
    {
        foreach($this->andSpecs as $spec) {
            $spec->assertSatisfiedBy($subject);
        }
    }

    protected function assertOrSpecsSatisfied($subject)
    {
        if(empty($this->orSpecs)) return;
        $satisfied = false;
        $firstException = null;
        foreach($this->orSpecs as $spec) {
            try {
                $spec->assertSatisfiedBy($subject);
                $satisfied = true;
                break;
            } catch(SpecUnsatisfiedException $exception) {
                if(is_null($firstException)) {
                    $firstException = $exception;
                }
            }
        }
        if(!$satisfied) {
            throw $firstException;
        }
    }
}
