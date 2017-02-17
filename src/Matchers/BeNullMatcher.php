<?php

namespace Karriere\PhpSpecMatchers\Matchers;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;

class BeNullMatcher implements Matcher
{
    /**
     * Checks if matcher supports provided subject and matcher name.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return Boolean
     */
    public function supports($name, $subject, array $arguments)
    {
        return $name === 'beNull';
    }

    /**
     * Evaluates positive match.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     * @throws FailureException
     */
    public function positiveMatch($name, $subject, array $arguments)
    {
        if (!is_null($subject)) {
            if (is_array($subject)) {
                $message = sprintf(
                    'Expected response to be null but got an array (%s).',
                    implode(',', $subject)
                );
            } elseif (is_bool($subject)) {
                $message = sprintf(
                    'Expected response to be null but got %s.',
                    $subject ? 'true' : 'false'
                );
            } elseif (is_numeric($subject)) {
                $message = sprintf(
                    'Expected response to be null but got %d.',
                    $subject
                );
            } else {
                $message = sprintf(
                    'Expected response to be null but got "%s".',
                    $subject
                );
            }

            throw new FailureException($message);
        }
    }

    /**
     * Evaluates negative match.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     * @throws FailureException
     */
    public function negativeMatch($name, $subject, array $arguments)
    {
        if (is_null($subject)) {
            throw new FailureException('The response should not be null');
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
