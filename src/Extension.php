<?php

namespace Karriere\PhpSpecMatchers;

use Karriere\PhpSpecMatchers\Matchers\BeAnyOfMatcher;
use PhpSpec\ServiceContainer;
use Prophecy\Argument;

class Extension implements \PhpSpec\Extension
{

    /**
     * @param ServiceContainer $container
     * @param array $params
     */
    public function load(ServiceContainer $container, array $params)
    {
        $container->define(
            'karriere.matchers.be_any_of',
            function ($c) {
                return new BeAnyOfMatcher();
            },
            ['matchers']
        );

    }
}