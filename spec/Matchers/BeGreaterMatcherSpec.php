<?php

namespace spec\Karriere\PhpSpecMatchers\Matchers;

use Karriere\PhpSpecMatchers\Matchers\BeGreaterMatcher;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\ObjectBehavior;

class BeGreaterMatcherSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(BeGreaterMatcher::class);
        $this->shouldImplement(Matcher::class);
    }

    public function it_should_return_true_if_call_to_matcher_is_supported()
    {
        $this->supports('beGreater', 3, [1])->shouldReturn(true);
        $this->supports('beGreaterThan', 3, [1])->shouldReturn(true);
    }

    public function it_should_return_false_if_call_to_matcher_is_not_supported()
    {
        $this->supports('invalidName', 1, [3])->shouldReturn(false);
        $this->supports('beGreater', 'a string', [3])->shouldReturn(false);
        $this->supports('beGreater', 1, ['a string'])->shouldReturn(false);
    }

    public function it_should_succeed_on_positive_match()
    {
        $this->positiveMatch('beGreater', 1, [0])->shouldReturn(null);
        $this->positiveMatch('beGreater', 0, [-1])->shouldReturn(null);
        $this->positiveMatch('beGreater', 1000, [100])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_positive_match()
    {
        $this->shouldThrow(FailureException::class)->duringPositiveMatch('beGreater', 1, [2]);
        $this->shouldThrow(FailureException::class)->duringPositiveMatch('beGreater', -1, [0]);
    }

    public function it_should_succeed_on_negative_match()
    {
        $this->negativeMatch('beGreater', 1, [2])->shouldReturn(null);
        $this->negativeMatch('beGreater', -1, [0])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_negative_match()
    {
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beGreater', 1, [0]);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beGreater', 0, [-1]);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beGreater', 1000, [100]);
    }

    public function it_should_have_zero_priority()
    {
        $this->getPriority()->shouldReturn(0);
    }
}
