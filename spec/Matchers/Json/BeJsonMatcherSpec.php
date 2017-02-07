<?php

namespace spec\Karriere\PhpSpecMatchers\Matchers\Json;

use Karriere\PhpSpecMatchers\Matchers\Json\BeJsonMatcher;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\ObjectBehavior;

class BeJsonMatcherSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(BeJsonMatcher::class);
        $this->shouldImplement(Matcher::class);
    }

    public function it_should_return_true_if_call_to_matcher_is_supported()
    {
        $this->supports('beJson', '', [])->shouldReturn(true);
    }

    public function it_should_return_false_if_call_to_matcher_is_not_supported()
    {
        $this->supports('invalidName', '', [])->shouldReturn(false);
    }

    public function it_should_succeed_on_positive_match()
    {
        $this->positiveMatch('beJson', '{}', [])->shouldReturn(null);
        $this->positiveMatch('beJson', '{"foo": "bar", "key": "value"}', [])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_positive_match()
    {
        $this->shouldThrow(new FailureException('the return value is not a valid json string'))->duringPositiveMatch('beJson', 'ab', []);
        $this->shouldThrow(new FailureException('the return value is not a valid json string'))->duringPositiveMatch('beJson', '{"key": "value }', []);
    }

    public function it_should_succeed_on_negative_match()
    {
        $this->negativeMatch('beJson', 'a string', [])->shouldReturn(null);
        $this->negativeMatch('beJson', '{', [])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_negative_match()
    {
        $this->shouldThrow(new FailureException('the return value should not be a valid json string'))->duringNegativeMatch('beJson', '{}', []);
        $this->shouldThrow(new FailureException('the return value should not be a valid json string'))->duringNegativeMatch('beJson', '{"foo": "bar", "key": "value"}', []);
    }

    public function it_should_have_zero_priority()
    {
        $this->getPriority()->shouldReturn(0);
    }
}
