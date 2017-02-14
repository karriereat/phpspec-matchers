<?php

namespace Karriere\PhpSpecMatchers\Matchers;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;

class BeGreaterMatcher implements Matcher
{
    /**
     * Checks if matcher supports provided subject and matcher name.
     *
     * @param string $name
     * @param mixed $subject
     * @param array $arguments
     *
     * @return Boolean
     */
    public function supports($name, $subject, array $arguments)
    {
        return in_array($name, ['beGreater', 'beGreaterThan']) &&
            is_numeric($subject) && count($arguments) > 0 &&
            is_numeric($arguments[0]);
    }

    /**
     * Evaluates positive match.
     *
     * @param string $name
     * @param mixed $subject
     * @param array $arguments
     * @throws FailureException
     */
    public function positiveMatch($name, $subject, array $arguments)
    {
        if ($subject <= $arguments[0]) {
            throw new FailureException(
                sprintf(
                    'The return value %d should be greater than %d',
                    $subject,
                    $arguments[0]
                )
            );
        }
    }

    /**
     * Evaluates negative match.
     *
     * @param string $name
     * @param mixed $subject
     * @param array $arguments
     * @throws FailureException
     */
    public function negativeMatch($name, $subject, array $arguments)
    {
        if ($subject > $arguments[0]) {
            throw new FailureException(
                sprintf(
                    'The return value %d should not be greater than %d',
                    $subject,
                    $arguments[0]
                )
            );
        }
    }

    /**
     * Returns matcher priority.
     *
     * @return integer
     */
    public function getPriority()
    {
        return 0;
    }
}
