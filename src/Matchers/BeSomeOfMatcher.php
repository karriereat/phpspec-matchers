<?php

namespace Karriere\PhpSpecMatchers\Matchers;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\Wrapper\DelayedCall;

class BeSomeOfMatcher implements Matcher
{
    /**
     * Checks if matcher supports provided subject and matcher name.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return bool
     */
    public function supports(string $name, $subject, array $arguments): bool
    {
        return $name === 'beSomeOf' && is_array($subject) && count($subject) > 0 && count($arguments) > 0;
    }

    /**
     * Evaluates positive match.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @throws FailureException
     *
     * @return DelayedCall|null
     */
    public function positiveMatch(string $name, $subject, array $arguments): ?DelayedCall
    {
        foreach ($subject as $value) {
            if (!in_array($value, $arguments)) {
                throw new FailureException(
                    sprintf(
                        'the return value "%s" should be contained in "%s"',
                        implode(', ', $subject),
                        implode(', ', $arguments)
                    )
                );
            }
        }

        return null;
    }

    /**
     * Evaluates negative match.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @throws FailureException
     *
     * @return DelayedCall|null
     */
    public function negativeMatch(string $name, $subject, array $arguments): ?DelayedCall
    {
        foreach ($subject as $value) {
            if (in_array($value, $arguments)) {
                throw new FailureException(
                    sprintf(
                        'the return value "%s" should not be contained in "%s"',
                        implode(', ', $subject),
                        implode(', ', $arguments)
                    )
                );
            }
        }

        return null;
    }

    /**
     * Returns matcher priority.
     *
     * @return int
     */
    public function getPriority(): int
    {
        return 0;
    }
}
