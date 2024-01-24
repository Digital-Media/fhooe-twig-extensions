<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\Loader\ArrayLoader;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
*/

/**
 * Helper function to create a Twig environment with a given template and extension.
 * @param string $template The template (fragment) to render.
 * @param AbstractExtension $extension The extension to add to the Twig environment.
 * @return Environment The Twig environment.
 */
function createTwigEnvironment(string $template, AbstractExtension $extension): Environment
{
    $loader = new ArrayLoader([
        "template" => $template
    ]);
    $twig = new Environment($loader);
    $twig->addExtension($extension);

    return $twig;
}

/**
 * Helper function to render a Twig template with a given extension and template.
 * @param AbstractExtension $extension The extension to add to the Twig environment.
 * @param string $template The template (fragment) to render.
 * @param array $data The data to pass to the template.
 * @return string The rendered template.
 * @throws LoaderError Thrown if the template cannot be loaded.
 * @throws RuntimeError Thrown if an error occurs during rendering.
 * @throws SyntaxError Thrown if a syntax error occurs during rendering.
 */
function render(AbstractExtension $extension, string $template, array $data = []): string
{
    $twig = createTwigEnvironment($template, $extension);
    return $twig->render("template", $data);
}

/**
 * Helper function to start a session.
 * @return bool Returns true if the session was started successfully, false otherwise.
 */
function startSession(): bool
{
    return session_start();
}

/**
 * Helper function to destroy a session. Empties the session array and invalidates the session cookie before destroying
 * the session on the server.
 * @return bool Returns true if the session was destroyed successfully, false otherwise.
 */
function destroySession(): bool
{
    // Empty session array
    $_SESSION = [];

    // Invalidate session cookie
    if (isset($_COOKIE[session_name()])) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            "",
            [
                "expires" => time() - 42000,
                "path" => $params["path"],
                "domain" => $params["domain"],
                "secure" => $params["secure"],
                "httponly" => $params["httponly"],
                "samesite" => $params["samesite"]
            ]
        );
    }

    // Destroy session and return session destruction status
    return session_destroy();
}
