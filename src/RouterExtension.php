<?php

declare(strict_types=1);

namespace Fhooe\Twig;

use Fhooe\Router\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Twig extension that allows to use the fhooe/router functions urlFor() and getBasePath() within a Twig template.
 * @package Fhooe\Twig
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @since 1.0.0
 */
final class RouterExtension extends AbstractExtension
{
    /**
     * @var Router The fhooe/router object.
     */
    private Router $router;

    /**
     * Creates a new Router extension with the fhooe/router object as parameter.
     * @param Router $router The fhooe/router object.
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Provides the router methods urlFor() and getBasePath() as Twig functions url_for() and get_base_path().
     * @return TwigFunction[] The array with Twig functions.
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction("url_for", [$this->router, "urlFor"]),
            new TwigFunction("get_base_path", [$this->router, "getBasePath"])
        ];
    }
}
