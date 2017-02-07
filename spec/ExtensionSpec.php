<?php

namespace spec\Karriere\PhpSpecMatchers;

use Karriere\PhpSpecMatchers\Extension;
use PhpSpec\ObjectBehavior;
use PhpSpec\ServiceContainer;
use Prophecy\Argument;

class ExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Extension::class);
        $this->shouldImplement(\PhpSpec\Extension::class);
    }

    function it_should_define_the_any_of_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.be_any_of', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    function it_should_define_the_some_of_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.be_some_of', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    function it_should_define_the_be_json_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.be_json', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    function it_should_define_the_have_json_key_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.have_json_key', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }

    function it_should_define_the_have_json_key_with_value_matcher(ServiceContainer $container)
    {
        $this->load($container, []);
        $container->define('karriere.matchers.have_json_key_with_value', Argument::type('callable'), ['matchers'])->shouldHaveBeenCalled();
    }
}
