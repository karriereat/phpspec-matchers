<?php

namespace spec\Karriere\PhpSpecMatchers\Matchers;

use Karriere\PhpSpecMatchers\Matchers\BeEmptyMatcher;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\ObjectBehavior;

class BeEmptyMatcherSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(BeEmptyMatcher::class);
        $this->shouldImplement(Matcher::class);
    }

    public function it_should_return_true_if_call_to_matcher_is_supported()
    {
        $this->supports('beEmpty', '', [])->shouldReturn(true);
    }

    public function it_should_return_false_if_call_to_matcher_is_not_supported()
    {
        $this->supports('invalidName', '', [])->shouldReturn(false);
    }

    public function it_should_succeed_on_positive_match()
    {
        $this->positiveMatch('beEmpty', '', [])->shouldReturn(null);
        $this->positiveMatch('beEmpty', null, [])->shouldReturn(null);
        $this->positiveMatch('beEmpty', [], [])->shouldReturn(null);
        $this->positiveMatch('beEmpty', 0, [])->shouldReturn(null);
        $this->positiveMatch('beEmpty', 0.0, [])->shouldReturn(null);
        $this->positiveMatch('beEmpty', '0', [])->shouldReturn(null);
        $this->positiveMatch('beEmpty', false, [])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_positive_match()
    {
        $this->shouldThrow(new FailureException('Expected an empty response but got "abc".'))->duringPositiveMatch('beEmpty', 'abc', []);
        $this->shouldThrow(new FailureException('Expected an empty response but got an array (1,2,3).'))->duringPositiveMatch('beEmpty', [1, 2, 3], []);
        $this->shouldThrow(new FailureException('Expected an empty response but got 1.'))->duringPositiveMatch('beEmpty', 1, []);
    }

    public function it_should_succeed_on_negative_match()
    {
        $this->negativeMatch('beEmpty', 'abc', [])->shouldReturn(null);
        $this->negativeMatch('beEmpty', [1, 2, 3], [])->shouldReturn(null);
        $this->negativeMatch('beEmpty', 1, [])->shouldReturn(null);
    }

    public function it_should_throw_an_exception_for_failing_negative_match()
    {
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beEmpty', '', []);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beEmpty', null, []);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beEmpty', [], []);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beEmpty', 0, []);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beEmpty', 0.0, []);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beEmpty', '0', []);
        $this->shouldThrow(FailureException::class)->duringNegativeMatch('beEmpty', false, []);
    }

    public function it_should_have_zero_priority()
    {
        $this->getPriority()->shouldReturn(0);
    }
}
