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
    // Make sure no session is running
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }
    session_start();
});

/**
 * Tests if the session function is available in templates.
 */
it("provides the session function in templates", function () {
    $output = render($this->sessionExtension, "{{ session('test_key') }}");
    expect($output)->toBe("");
});

/**
 * Tests retrieving a session value that exists.
 */
it("retrieves an existing session value", function () {
    $_SESSION["test_key"] = "test_value";
    $output = render($this->sessionExtension, "{{ session('test_key') }}");
    expect($output)->toBe("test_value");
});

/**
 * Tests retrieving a non-existent session value.
 */
it("returns empty string for non-existent session value", function () {
    $output = render($this->sessionExtension, "{{ session('non_existent_key') }}");
    expect($output)->toBe("");
});

/**
 * Tests retrieving different types of session values.
 */
it("handles different types of session values", function () {
    $_SESSION["string"] = "test";
    $_SESSION["number"] = 42;
    $_SESSION["array"] = ["key" => "value"];
    $_SESSION["boolean"] = true;

    $output = render(
        $this->sessionExtension,
        "{{ session('string') }} {{ session('number') }} {{ session('array')|json_encode|raw }} {{ session('boolean') }}",
    );
    expect($output)->toBe("test 42 {\"key\":\"value\"} 1");
});

/**
 * Tests retrieving nested array values from session.
 */
it("handles nested array values in session", function () {
    $_SESSION["nested"] = [
        "level1" => [
            "level2" => "value",
        ],
    ];

    $output = render($this->sessionExtension, "{{ session('nested')|json_encode|raw }}");
    expect($output)->toBe("{\"level1\":{\"level2\":\"value\"}}");
});