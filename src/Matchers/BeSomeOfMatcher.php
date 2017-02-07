<?php

namespace Karriere\PhpSpecMatchers\Matchers;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;

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
    public function supports($name, $subject, array $arguments)
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
     */
    public function positiveMatch($name, $subject, array $arguments)
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
