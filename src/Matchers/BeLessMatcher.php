<?php

namespace Karriere\PhpSpecMatchers\Matchers;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\Wrapper\DelayedCall;

class BeLessMatcher implements Matcher
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
        return in_array($name, ['beLess', 'beLessThan']) &&
            is_numeric($subject) && count($arguments) > 0 &&
            is_numeric($arguments[0]);
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
        if ($subject >= $arguments[0]) {
            throw new FailureException(
                sprintf(
                    'The return value %d should be less than %d.',
                    $subject,
                    $arguments[0]
                )
            );
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
        if ($subject < $arguments[0]) {
            throw new FailureException(
                sprintf(
                    'The return value %d should not be less than %d.',
                    $subject,
                    $arguments[0]
                )
            );
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
