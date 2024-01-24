<?php

/**
 * Tests for SessionExtension.
 */

use Fhooe\Twig\SessionExtension;

/**
 * Creates a SessionExtension object before each test.
 */
beforeEach(function () {
    $this->sessionExtension = new SessionExtension();
});

/**
 * Uses the session() function in a template to output the correct value from the session when the key is set.
 */
it("renders a template and outputs the correct value from the session when the key is set", function () {
    startSession();

    $_SESSION["test"] = "test value";

    $output = render($this->sessionExtension, "{{ session('test') }}");
    expect($output)->toBe("test value");

    destroySession();
});

/**
 * Uses the session() function in a template to output an empty string from the session when the key is not set.
 */
it("renders a template and outputs an empty string from the session when the key is not set", function () {
    startSession();

    $output = render($this->sessionExtension, "{{ session('test') }}");
    expect($output)->toBeEmpty();

    destroySession();
});

/**
 * Uses the session() function in a template to output an empty string when no session is started.
 */
it("renders a template and outputs an empty string when no session is started", function () {
    // Unset the session superglobal to make sure that the array is not present
    unset($_SESSION);

    $output = render($this->sessionExtension, "{{ session('test') }}");

    expect($output)->toBeEmpty();
});
