<?php

declare(strict_types=1);

namespace Fhooe\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Twig extension that allows to query entries in the $_SESSION superglobal and display them in the template.
 * @package Fhooe\Twig
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @since 1.0.0
 */
final class SessionExtension extends AbstractExtension
{
    /**
     * Provides the Twig function session($key) that allows to query an entry in $_SESSION with the given key.
     * @return TwigFunction[] The array with Twig functions.
     */
    public function getFunctions(): array
    {
        return [
          new TwigFunction("session", [$this, "getSessionEntry"])
        ];
    }

    /**
     * Retrieves an entry from $_SESSION with a given key.
     * @param string $key The key to lookup in $_SESSION.
     * @return mixed Returns the entry from $_SESSION or empty string if it is not present or $_SESSION does not exist.
     */
    public function getSessionEntry(string $key): mixed
    {
        return $_SESSION[$key] ?? "";
    }
}
