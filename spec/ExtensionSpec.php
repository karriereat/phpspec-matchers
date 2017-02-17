<?php

namespace spec\Karriere\PhpSpecMatchers;

use Karriere\PhpSpecMatchers\Extension;
use PhpSpec\ObjectBehavior;
use PhpSpec\ServiceContainer;
use Prophecy\Argument;

class ExtensionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Extension::class);
        $this->shouldImplement(\PhpSpec\Extension::class);
    }

    public function it_should_define_the_any_of_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.be_any_of', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    public function it_should_define_the_some_of_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.be_some_of', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    public function it_should_define_the_be_json_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.be_json', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    public function it_should_define_the_have_json_key_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.have_json_key', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    public function it_should_define_the_have_json_key_with_value_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.have_json_key_with_value', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    public function it_should_define_the_be_empty_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.be_empty', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    public function it_should_define_the_be_less_than_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.be_less_than', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    public function it_should_define_the_be_greater_than_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.be_greater_than', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    public function it_should_define_the_be_null_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.be_null', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }
}
