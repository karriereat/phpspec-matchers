<?php

namespace Karriere\PhpSpecMatchers;

use Karriere\PhpSpecMatchers\Matchers\BeAnyOfMatcher;
use Karriere\PhpSpecMatchers\Matchers\BeEmptyMatcher;
use Karriere\PhpSpecMatchers\Matchers\BeGreaterMatcher;
use Karriere\PhpSpecMatchers\Matchers\BeLessMatcher;
use Karriere\PhpSpecMatchers\Matchers\BeNullMatcher;
use Karriere\PhpSpecMatchers\Matchers\BeSomeOfMatcher;
use Karriere\PhpSpecMatchers\Matchers\Json\BeJsonMatcher;
use Karriere\PhpSpecMatchers\Matchers\Json\HaveJsonKeyMatcher;
use Karriere\PhpSpecMatchers\Matchers\Json\HaveJsonKeyWithValueMatcher;
use PhpSpec\ServiceContainer;

class Extension implements \PhpSpec\Extension
{
    /**
     * @param ServiceContainer $container
     * @param array            $params
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

        $container->define(
            'karriere.matchers.be_some_of',
            function ($c) {
                return new BeSomeOfMatcher();
            },
            ['matchers']
        );

        $container->define(
            'karriere.matchers.be_empty',
            function ($c) {
                return new BeEmptyMatcher();
            },
            ['matchers']
        );

        $container->define(
            'karriere.matchers.be_null',
            function ($c) {
                return new BeNullMatcher();
            },
            ['matchers']
        );

        $container->define(
            'karriere.matchers.be_less_than',
            function ($c) {
                return new BeLessMatcher();
            },
            ['matchers']
        );

        $container->define(
            'karriere.matchers.be_greater_than',
            function ($c) {
                return new BeGreaterMatcher();
            },
            ['matchers']
        );

        $container->define(
            'karriere.matchers.be_json',
            function ($c) {
                return new BeJsonMatcher();
            },
            ['matchers']
        );

        $container->define(
            'karriere.matchers.have_json_key',
            function ($c) {
                return new HaveJsonKeyMatcher();
            },
            ['matchers']
        );

        $container->define(
            'karriere.matchers.have_json_key_with_value',
            function ($c) {
                return new HaveJsonKeyWithValueMatcher();
            },
            ['matchers']
        );
    }
}
