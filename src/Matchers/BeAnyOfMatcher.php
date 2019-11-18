<?php

namespace Karriere\PhpSpecMatchers\Matchers;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\Wrapper\DelayedCall;

class BeAnyOfMatcher implements Matcher
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
        return $name === 'beAnyOf' && count($arguments) > 0;
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
        if (!in_array($subject, $arguments)) {
            throw new FailureException(
                sprintf(
                    'the return value "%s" should be any of "%s"',
                    $subject,
                    implode(', ', $arguments)
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
        if (in_array($subject, $arguments)) {
            throw new FailureException(
                sprintf(
                    'the return value "%s" should not be any of "%s"',
                    $subject,
                    implode(', ', $arguments)
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
