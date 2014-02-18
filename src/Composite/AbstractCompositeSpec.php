<?php namespace Thepsion5\Specification\Composite;

use Thepsion5\Specification\AbstractSpec,
    Thepsion5\Specification\SpecInterface;

abstract class AbstractCompositeSpec extends AbstractSpec
{
    protected $specs = array();

    public function __construct(SpecInterface $spec1, SpecInterface $spec2)
    {
        $this->with($spec1)->with($spec2);
    }

    public function with(SpecInterface $spec)
    {
        $this->specs[] = $spec;

        return $this;
    }

    protected function compileMessages()
    {
        $messages = array();
        foreach($this->specs as $spec) {
            array_merge_recursive($messages, $spec->messages());
        }
        $this->messages = $messages;
    }

    public function messages()
    {
        $this->compileMessages();
        return parent::messages();
    }
}
