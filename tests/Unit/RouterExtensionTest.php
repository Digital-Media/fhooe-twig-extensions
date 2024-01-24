<?php

/**
 * Tests for RouterExtension.
 */

use Fhooe\Router\Router;
use Fhooe\Twig\RouterExtension;

/**
 * Creates a Router object and a RouterExtension object before each test.
 * GET /test is considered the route that is called in the client.
 */
beforeEach(function () {
    $this->router = new Router();
    $this->routerExtension = new RouterExtension($this->router);
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/test";
});

/**
 * Uses the url_for() function in a template to output the full request url without a base path.
 */
it("renders a template and outputs the correct full request url from url_for() when no base path is set", function () {
    $output = render($this->routerExtension, "{{ url_for('/test') }}");

    expect($output)->toBe("/test");
});

/**
 * Uses the url_for() function in a template to output the full request url with a base path.
 */
it("renders a template and outputs the correct full request url from url_for() when a base path is set", function () {
    $_SERVER["REQUEST_URI"] = "/some/basepath/test";
    $this->router->setBasePath("/some/basepath");

    $output = render($this->routerExtension, "{{ url_for('/test') }}");

    expect($output)->toBe("/some/basepath/test");
});

/**
 * Uses the get_base_path() function in a template to output an empty string when no base path is set.
 */
it("renders a template and outputs an empty string from get_base_path() when no base path is set", function () {
    $output = render($this->routerExtension, "{{ get_base_path() }}");

    expect($output)->toBeEmpty();
});

/**
 * Uses the get_base_path() function in a template to output the base path when a base path is set.
 */
it("renders a template and outputs the base path from get_base_path() when a base path is set", function () {
    $_SERVER["REQUEST_URI"] = "/some/basepath/test";
    $this->router->setBasePath("/some/basepath");

    $output = render($this->routerExtension, "{{ get_base_path() }}");

    expect($output)->toBe("/some/basepath");
});
