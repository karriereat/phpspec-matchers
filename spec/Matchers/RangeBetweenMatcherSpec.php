<?php

namespace spec\Karriere\PhpSpecMatchers\Matchers;

use Karriere\PhpSpecMatchers\Matchers\RangeBetweenMatcher;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\ObjectBehavior;

class RangeBetweenMatcherSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(RangeBetweenMatcher::class);
        $this->shouldImplement(Matcher::class);
    }

    public function it_should_return_true_if_call_to_matcher_is_supported()
    {
        $this->supports('rangeBetween', 1, [1, 3])->shouldReturn(true);
        $this->supports('rangeBetween', 0.5, [0.1, 0.6])->shouldReturn(true);
    }

    public function it_should_return_false_if_call_to_matcher_is_not_supported()
    {
        $this->supports('invalidName', 1, [1, 3])->shouldReturn(false);
        $this->supports('rangeBetween', 1, [1])->shouldReturn(false);
        $this->supports('rangeBetween', 1, ['string'])->shouldReturn(false);
    }

    public function it_should_succeed_on_positive_match()
    {
        $this->positiveMatch('rangeBetween', 1, [1, 3])->shouldReturn(null);
        $this->positiveMatch('rangeBetween', 100, [1, 100])->shouldReturn(null);
        $this->positiveMatch('rangeBetween', 0.2, [0.1, 0.4])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_positive_match()
    {
        $this->shouldThrow(FailureException::class)->duringPositiveMatch('rangeBetween', 1, [2, 3]);
        $this->shouldThrow(FailureException::class)->duringPositiveMatch('rangeBetween', 0.1, [0.2, 0.4]);
    }

    public function it_should_succeed_on_negative_match()
    {
        $this->negativeMatch('rangeBetween', 1, [2, 3])->shouldReturn(null);
        $this->negativeMatch('rangeBetween', 0.1, [0.2, 0.4])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_negative_match()
    {
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('rangeBetween', 1, [1, 3]);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('rangeBetween', 100, [1, 100]);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('rangeBetween', 0.2, [0.1, 0.3]);
    }

    public function it_should_have_zero_priority()
    {
        $this->getPriority()->shouldReturn(0);
    }
}
