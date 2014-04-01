<?php
namespace Thepsion5\Spec;

use Thepsion5\Spec\Exceptions\SpecUnsatisfiedException;

/**
 * Class CompositeAssertableSpec
 * @package Thepsion5\Spec
 */
abstract class CompositeAssertableSpec extends AssertableSpec
{
    /**
     * Contains specifications that must all be satisfied
     * @var array
     */
    protected $andSpecs = [];

    /**
     * Contains specifications of which only one must be satisfied
     * @var array
     */
    protected $orSpecs = [];

    /**
     * Adds a specification to the collection that must be satisfied in order for
     * the overall spec to be satisfied
     * @param AssertableSpec $spec Added to the collection of logical and specifications
     * @return $this
     */
    public function andSatisfiedBy(AssertableSpec $spec)
    {
        $this->andSpecs[] = $spec;
        return $this;
    }

    /**
     * Adds a specification to the collection for which only one specification must
     * be satisfied for the overall spec to be satisfied
     * @param AssertableSpec $spec Added to the collection of logical or specifications
     * @return $this
     */
    public function orSatisfiedBy(AssertableSpec $spec)
    {
        $this->orSpecs[] = $spec;
        return $this;
    }

    /**
     * @param mixed $subject The object or value being examined
     * @return bool True if the specification is satisfied based on its components
     */
    public function isSatisfiedBy($subject)
    {
        return $this->andSpecsSatisfied($subject) && $this->orSpecsSatisfied($subject);
    }

    /**
     * @param mixed $subject The object or value being examined
     * @return bool True if the logical and specifications are all satisfied
     */
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

    /**
     * @param mixed $subject The object or value being examined
     * @return bool True if at least one logical or specification is satisfied or there are no logical or specifications
     */
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

    /**
     * @inheritdoc
     */
    public function assertSatisfiedBy($subject)
    {
        $this->assertAndSpecsSatisfied($subject);
        $this->assertOrSpecsSatisfied($subject);
    }

    /**
     * Asserts that all logical and specifications are satisfied
     * @param mixed $subject The object or value being examined
     * @throws Exceptions\SpecUnsatisfiedException If any of the component specs' assertions fail
     */
    protected function assertAndSpecsSatisfied($subject)
    {
        foreach($this->andSpecs as $spec) {
            $spec->assertSatisfiedBy($subject);
        }
    }

    /**
     * Asserts that at least one logical or specification is satisfied, if any exist,
     * and throws the first failed assertion if none pass
     * @param mixed $subject The object or value being examined
     * @throws Exceptions\SpecUnsatisfiedException If none of the logical or spec assertions pass
     */
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
