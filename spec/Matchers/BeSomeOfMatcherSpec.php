<?php

namespace spec\Karriere\PhpSpecMatchers\Matchers;

use Karriere\PhpSpecMatchers\Matchers\BeSomeOfMatcher;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\ObjectBehavior;

class BeSomeOfMatcherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BeSomeOfMatcher::class);
        $this->shouldImplement(Matcher::class);
    }

    function it_should_return_true_if_call_to_matcher_is_supported()
    {
        $this->supports('beSomeOf', [1, 2], [1, 2, 3])->shouldReturn(true);
    }

    function it_should_return_false_if_call_to_matcher_is_not_supported()
    {
        $this->supports('invalidName', [1, 2], [1, 2, 3])->shouldReturn(false);
        $this->supports('beSomeOf', 'string', [1, 2, 3])->shouldReturn(false);
        $this->supports('beSomeOf', [], [1, 2, 3])->shouldReturn(false);
        $this->supports('beSomeOf', [1], [])->shouldReturn(false);
    }

    function it_should_succeed_on_positive_match()
    {
        $this->positiveMatch('beSomeOf', [1, 2], [1, 2, 3])->shouldReturn(null);
        $this->positiveMatch('beSomeOf', ['string', 'string1'], ['string', 'string1', 'string2'])->shouldReturn(null);
    }

    function it_should_throw_an_exception_for_failing_positive_match()
    {
        $this->shouldThrow(new FailureException("the return value \"1, 2\" should be contained in \"3, 4\""))->duringPositiveMatch('beSomeOf', [1, 2], [3, 4]);
    }

    function it_should_succeed_on_negative_match()
    {
        $this->negativeMatch('beSomeOf', [1, 2], [3, 4])->shouldReturn(null);
    }

    function it_should_throw_an_exception_for_failing_negative_match()
    {
        $this->shouldThrow(new FailureException("the return value \"1, 2\" should not be contained in \"1, 2, 3\""))->duringNegativeMatch('beSomeOf', [1, 2], [1, 2, 3]);
    }

    function it_should_have_zero_priority()
    {
        $this->getPriority()->shouldReturn(0);
    }
}
