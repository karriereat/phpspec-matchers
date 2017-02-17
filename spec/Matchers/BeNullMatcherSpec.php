<?php

namespace spec\Karriere\PhpSpecMatchers\Matchers;

use Karriere\PhpSpecMatchers\Matchers\BeNullMatcher;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\ObjectBehavior;

class BeNullMatcherSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(BeNullMatcher::class);
        $this->shouldImplement(Matcher::class);
    }

    public function it_should_return_true_if_call_to_matcher_is_supported()
    {
        $this->supports('beNull', null, [])->shouldReturn(true);
    }

    public function it_should_return_false_if_call_to_matcher_is_not_supported()
    {
        $this->supports('invalidName', null, [])->shouldReturn(false);
    }

    public function it_should_succeed_on_positive_match()
    {
        $this->positiveMatch('beNull', null, [])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_positive_match()
    {
        $this->shouldThrow(new FailureException('Expected response to be null but got "abc".'))->duringPositiveMatch('beNull', 'abc', []);
        $this->shouldThrow(new FailureException('Expected response to be null but got false.'))->duringPositiveMatch('beNull', false, []);
        $this->shouldThrow(new FailureException('Expected response to be null but got 1.'))->duringPositiveMatch('beNull', 1, []);
        $this->shouldThrow(new FailureException('Expected response to be null but got an array (1,2,3).'))->duringPositiveMatch('beNull', [1, 2, 3], []);
    }

    public function it_should_succeed_on_negative_match()
    {
        $this->negativeMatch('beNull', 'abc', [])->shouldReturn(null);
        $this->negativeMatch('beNull', false, [])->shouldReturn(null);
        $this->negativeMatch('beNull', 1, [])->shouldReturn(null);
        $this->negativeMatch('beNull', [1, 2, 3], [])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_negative_match()
    {
        $this->shouldThrow(new FailureException('The response should not be null'))->duringNegativeMatch('beNull', null, []);
    }

    public function it_should_have_zero_priority()
    {
        $this->getPriority()->shouldReturn(0);
    }
}
