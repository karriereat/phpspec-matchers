<?php

namespace Karriere\PhpSpecMatchers\Matchers;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;

class BeAnyOfMatcher implements Matcher
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
        return $name === 'beAnyOf' && count($arguments) > 0;
    }

    /**
     * Evaluates positive match.
     *
     * @param string $name
     * @param mixed $subject
     * @param array $arguments
     */
    public function positiveMatch($name, $subject, array $arguments)
    {
        if (!in_array($subject, $arguments)) {
            throw new FailureException(
                sprintf(
                    "the return value \"%s\" should be any of \"%s\"",
                    $subject,
                    implode(', ', $arguments)
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
     */
    public function negativeMatch($name, $subject, array $arguments)
    {
        if(in_array($subject, $arguments)) {
            throw new FailureException(
                sprintf(
                    "the return value \"%s\" should not be any of \"%s\"",
                    $subject,
                    implode(', ', $arguments)
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