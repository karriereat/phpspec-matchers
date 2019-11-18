<?php

namespace Karriere\PhpSpecMatchers\Matchers;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;
use PhpSpec\Wrapper\DelayedCall;

class BeEmptyMatcher implements Matcher
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
        return $name === 'beEmpty';
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
        if (!empty($subject)) {
            if (is_array($subject)) {
                $message = sprintf(
                    'Expected an empty response but got an array (%s).',
                    implode(',', $subject)
                );
            } elseif (is_numeric($subject)) {
                $message = sprintf(
                    'Expected an empty response but got %d.',
                    $subject
                );
            } else {
                $message = sprintf(
                    'Expected an empty response but got "%s".',
                    $subject
                );
            }

            throw new FailureException($message);
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
        if (empty($subject)) {
            throw new FailureException('The return value should not be empty.');
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
