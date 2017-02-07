<?php

namespace spec\Karriere\PhpSpecMatchers\Matchers\Json;

use Karriere\PhpSpecMatchers\Matchers\Json\HaveJsonKeyMatcher;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\ObjectBehavior;

class HaveJsonKeyMatcherSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(HaveJsonKeyMatcher::class);
        $this->shouldImplement(Matcher::class);
    }

    public function it_should_return_true_if_call_to_matcher_is_supported()
    {
        $this->supports('haveJsonKey', '', ['key'])->shouldReturn(true);
    }

    public function it_should_return_false_if_call_to_matcher_is_not_supported()
    {
        $this->supports('invalidName', '', ['key'])->shouldReturn(false);
        $this->supports('haveJsonKey', '', [])->shouldReturn(false);
    }

    public function it_should_succeed_on_positive_match()
    {
        $this->positiveMatch('haveJsonKey', '{"key": "value"}', ['key'])->shouldReturn(null);
        $this->positiveMatch('haveJsonKey', '{"key": { "subkey": "value" }}', ['key.subkey'])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_positive_match()
    {
        $this->shouldThrow(new FailureException('the return value should be valid json'))->duringPositiveMatch('haveJsonKey', '{invalid', ['key']);
        $this->shouldThrow(new FailureException('the return value should contain key "data" at level 1'))->duringPositiveMatch('haveJsonKey', '{"key": "value"}', ['data']);
    }

    public function it_should_succeed_on_negative_match()
    {
        $this->negativeMatch('haveJsonKey', '{"key": "value"}', ['data'])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_negative_match()
    {
        $this->shouldThrow(new FailureException('the return value should be valid json'))->duringNegativeMatch('haveJsonKey', '{invalid', ['key']);
        $this->shouldThrow(new FailureException('the return value should not contain key "key"'))->duringNegativeMatch('haveJsonKey', '{"key": "value"}', ['key']);
    }

    public function it_should_have_zero_priority()
    {
        $this->getPriority()->shouldReturn(0);
    }
}
