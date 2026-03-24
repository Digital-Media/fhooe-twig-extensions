<?php

declare(strict_types=1);

namespace Fhooe\Twig;

use Fhooe\Router\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Twig extension that exposes fhooe/router's urlFor() and the read-only basePath in templates as url_for and get_base_path.
 * @package Fhooe\Twig
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @since 1.0.0
 */
final class RouterExtension extends AbstractExtension
{
    /**
     * Creates a new Router extension with the fhooe/router object as parameter.
     * @param Router $router The fhooe/router object.
     */
    public function __construct(private readonly Router $router) {}

    /**
     * Provides url_for(pattern) and get_base_path() for Twig templates (router uses public readonly basePath).
     * @return TwigFunction[] The array with Twig functions.
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction("url_for", $this->router->urlFor(...)),
            new TwigFunction("get_base_path", fn(): string => $this->router->basePath),
        ];
    }
}
