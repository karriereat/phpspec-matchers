<?php

namespace spec\Karriere\PhpSpecMatchers\Matchers;

use Karriere\PhpSpecMatchers\Matchers\BeAnyOfMatcher;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\ObjectBehavior;

class BeAnyOfMatcherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BeAnyOfMatcher::class);
        $this->shouldImplement(Matcher::class);
    }

    function it_should_return_true_if_call_to_matcher_is_supported()
    {
        $this->supports('beAnyOf', '', [1, 2, 3])->shouldReturn(true);
    }

    function it_should_return_false_if_call_to_matcher_is_not_supported()
    {
        $this->supports('anyOf', '', [1, 2, 3])->shouldReturn(false);
        $this->supports('beAnyOf', '', [])->shouldReturn(false);
    }

    function it_should_succeed_on_positive_match()
    {
        $this->positiveMatch('beAnyOf', 1, [1, 2, 3])->shouldReturn(null);
        $this->positiveMatch('beAnyOf', 'string', ['string', 'abc', 'def'])->shouldReturn(null);
    }

    function it_should_throw_an_exception_for_failing_positive_match()
    {
        $this->shouldThrow(new FailureException('the return value "1" should be any of "2, 3"'))->duringPositiveMatch('beAnyOf', 1, [2, 3]);
    }

    function it_should_succeed_on_negative_match()
    {
        $this->negativeMatch('beAnyOf', 1, [2, 3])->shouldReturn(null);
    }

    function it_should_throw_an_exception_for_failing_negative_match()
    {
        $this->shouldThrow(new FailureException('the return value "1" should not be any of "1, 2, 3"'))->duringNegativeMatch('beAnyOf', 1, [1, 2, 3]);
    }

    function it_should_have_zero_priority()
    {
        $this->getPriority()->shouldReturn(0);
    }
}
