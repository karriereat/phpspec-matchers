<?php

namespace Karriere\PhpSpecMatchers\Matchers\Json;

use Karriere\PhpSpecMatchers\JsonUtil;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;

class BeJsonMatcher implements Matcher
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
    public function supports($name, $subject, array $arguments)
    {
        return $name === 'beJson';
    }

    /**
     * Evaluates positive match.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @throws FailureException
     */
    public function positiveMatch($name, $subject, array $arguments)
    {
        if (!JsonUtil::isValidJson($subject)) {
            throw new FailureException(
                'the return value is not a valid json string'
            );
        }
    }

    /**
     * Evaluates negative match.
     *
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @throws FailureException
     */
    public function negativeMatch($name, $subject, array $arguments)
    {
        if (JsonUtil::isValidJson($subject)) {
            throw new FailureException(
                'the return value should not be a valid json string'
            );
        }
    }

    /**
     * Returns matcher priority.
     *
     * @return int
     */
    public function getPriority()
    {
        return 0;
    }
}
