<?php

namespace Karriere\PhpSpecMatchers\Matchers\Json;

use Karriere\PhpSpecMatchers\JsonUtil;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\Matcher;

class HaveJsonKeyMatcher implements Matcher
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
        return $name === 'haveJsonKey' && count($arguments) > 0;
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
        if (!JsonUtil::isValidJson($subject)) {
            throw new FailureException(
                "the return value should be valid json"
            );
        }

        $jsonKeys = explode('.', $arguments[0]);
        $jsonData = json_decode($subject, true);
        $level = 1;

        foreach ($jsonKeys as $key) {
            if (!array_key_exists($key, $jsonData)) {
                throw new FailureException(
                    sprintf(
                        "the return value should contain key \"%s\" at level %d",
                        $key,
                        $level
                    )
                );
            }

            $jsonData = $jsonData[$key];
            $level++;
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
        if (!JsonUtil::isValidJson($subject)) {
            throw new FailureException(
                "the return value should be valid json"
            );
        }

        try {
            $this->positiveMatch($name, $subject, $arguments);
        } catch (FailureException $ignored) {
            return;
        }

        throw new FailureException(
            sprintf(
                "the return value should not contain key \"%s\"",
                $arguments[0]
            )
        );
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
