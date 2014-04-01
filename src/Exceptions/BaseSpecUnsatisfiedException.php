<?php
/**
 * Created by PhpStorm.
 * User: Sean
 * Date: 3/31/14
 * Time: 10:16 PM
 */

namespace Thepsion5\Spec\Exceptions;


use Thepsion5\Spec\AssertableSpec;

class BaseSpecUnsatisfiedException extends \InvalidArgumentException implements SpecUnsatisfiedException
{
    /**
     * @var AssertableSpec
     */
    protected $spec;

    /**
     * @var mixed
     */
    protected $subject;

    public function getSpec()
    {
        return $this->spec;
    }

    public function setSpec(AssertableSpec $spec)
    {
        $this->spec = $spec;
        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }
}
