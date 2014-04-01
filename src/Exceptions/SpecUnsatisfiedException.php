<?php

namespace Thepsion5\Spec\Exceptions;

use Thepsion5\Spec\AssertableSpec;

interface SpecUnsatisfiedException
{
    public function getSpec();

    public function setSpec(AssertableSpec $spec);

    public function getSubject();

    public function setSubject($subject);
}
