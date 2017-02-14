<?php

namespace spec\Karriere\PhpSpecMatchers\Matchers;

use Karriere\PhpSpecMatchers\Matchers\BeLessMatcher;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\ObjectBehavior;

class BeLessMatcherSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(BeLessMatcher::class);
        $this->shouldImplement(Matcher::class);
    }

    public function it_should_return_true_if_call_to_matcher_is_supported()
    {
        $this->supports('beLess', 1, [3])->shouldReturn(true);
        $this->supports('beLessThan', 1, [3])->shouldReturn(true);
    }

    public function it_should_return_false_if_call_to_matcher_is_not_supported()
    {
        $this->supports('invalidName', 1, [3])->shouldReturn(false);
        $this->supports('beLess', 'a string', [3])->shouldReturn(false);
        $this->supports('beLess', 1, ['a string'])->shouldReturn(false);
    }

    public function it_should_succeed_on_positive_match()
    {
        $this->positiveMatch('beLess', 1, [3])->shouldReturn(null);
        $this->positiveMatch('beLess', -1, [0])->shouldReturn(null);
        $this->positiveMatch('beLess', 999, [1000])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_positive_match()
    {
        $this->shouldThrow(FailureException::class)->duringPositiveMatch('beLess', 3, [1]);
        $this->shouldThrow(FailureException::class)->duringPositiveMatch('beLess', 1, [0]);
        $this->shouldThrow(FailureException::class)->duringPositiveMatch('beLess', -1, [-1]);
    }

    public function it_should_succeed_on_negative_match()
    {
        $this->negativeMatch('beLess', 3, [1])->shouldReturn(null);
        $this->negativeMatch('beLess', 1, [1])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_negative_match()
    {
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beLess', 1, [3]);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beLess', -1, [0]);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beLess', 999, [1000]);
    }

    public function it_should_have_zero_priority()
    {
        $this->getPriority()->shouldReturn(0);
    }
}
