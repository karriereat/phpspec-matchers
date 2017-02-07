<?php

namespace spec\Karriere\PhpSpecMatchers\Matchers\Json;

use Karriere\PhpSpecMatchers\Matchers\Json\HaveJsonKeyWithValueMatcher;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\ObjectBehavior;

class HaveJsonKeyWithValueMatcherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(HaveJsonKeyWithValueMatcher::class);
        $this->shouldImplement(Matcher::class);
    }

    function it_should_return_true_if_call_to_matcher_is_supported()
    {
        $this->supports('haveJsonKeyWithValue', '', ['key', 'value'])->shouldReturn(true);
    }

    function it_should_return_false_if_call_to_matcher_is_not_supported()
    {
        $this->supports('invalidName', '', ['key', 'value'])->shouldReturn(false);
        $this->supports('haveJsonKeyWithValue', '', [])->shouldReturn(false);
        $this->supports('haveJsonKeyWithValue', '', ['key'])->shouldReturn(false);
    }

    function it_should_succeed_on_positive_match()
    {
        $this->positiveMatch('haveJsonKeyWithValue', '{"key": "value"}', ['key', 'value'])->shouldReturn(null);
        $this->positiveMatch('haveJsonKeyWithValue', '{"key": {"subkey": "value" }}', ['key.subkey', 'value'])->shouldReturn(null);
    }

    function it_should_throw_an_exception_for_failing_positive_match()
    {
        $this->shouldThrow(FailureException::class)->duringPositiveMatch('haveJsonKeyWithValue', '{invalid', ['key', 'value']);
        $this->shouldThrow(FailureException::class)->duringPositiveMatch('haveJsonKeyWithValue', '{"key": "value2"}', ['key', 'value']);
        $this->shouldThrow(FailureException::class)->duringPositiveMatch('haveJsonKeyWithValue', '{}', ['key', 'value']);
    }

    function it_should_succeed_on_negative_match()
    {
        $this->negativeMatch('haveJsonKeyWithValue', '{"key": "value"}', ['key', 'value2'])->shouldReturn(null);
        $this->negativeMatch('haveJsonKeyWithValue', '{"key": { "subkey": "value" }}', ['key.subkey', 'value2'])->shouldReturn(null);
    }

    function  it_should_throw_an_exception_for_failing_negative_match()
    {
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('haveJsonKeyWithValue', '{invalid', ['key', 'value']);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('haveJsonKeyWithValue', '{"key": "value"}', ['key', 'value']);
    }

    function it_should_have_zero_priority()
    {
        $this->getPriority()->shouldReturn(0);
    }
}
