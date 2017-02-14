<?php

namespace Karriere\PhpSpecMatchers\Matchers;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;

class BeEmptyMatcher implements Matcher
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
        return $name === 'beEmpty';
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
        if (!empty($subject)) {
            throw new FailureException('The return value should be empty.');
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
        if (empty($subject)) {
            throw new FailureException('The return value should not be empty.');
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
