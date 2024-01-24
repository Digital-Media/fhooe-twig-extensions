# fhooe/twig-extensions

A collection of Twig extensions for other *fhooe* packages used in the [Media Technology and Design](https://www.fh-ooe.at/en/hagenberg-campus/studiengaenge/bachelor/media-technology-and-design/) program at the [University of Applied Sciences Upper Austria](https://www.fh-ooe.at/en/hagenberg-campus/). It is intended to be used with packages such as [*fhooe/router*](https://github.com/Digital-Media/fhooe-router) or [*fhooe/router-skeleton*](https://github.com/Digital-Media/fhooe-router-skeleton) respectively.

## Installation

Integrate the package into your project using [Composer](https://getcomposer.org/):

```bash
composer require fhooe/twig-extensions
```

## Contents

This package contains the following extensions:

### `RouterExtension`

An extension to access the *fhooe/router* package from within Twig templates. It provides the following functions:
- `url_for("/some/route")`: Returns the full URL for the given route.
- `get_base_path()`: Returns the base path if the application is not in the server's document root.

### `SessionExtension`

Provides the function `session("someKey")`, which returns the value of the given key in the session. That way, not every needed entry in `$_SESSION` (or even the whole superglobal) must be passed to the template.

## Usage

Register the extensions with your Twig environment, then use the provided functions in your templates:

### `RouterExtension`

Register the extension and provide an instance of `Fhooe\Router\Router`.

```php
$twig->addExtension(new Fhooe\Twig\RouterExtension(new Fhooe\Router\Router()));
```

Use the functions:

```twig
{{ url_for("/some/route") }}
{{ get_base_path() }}
```

This will output the full path for the route or a base path (if you need to prefix) static paths for stylesheets or other files.

### `SessionExtension`

Register the extension:

```php
$twig->addExtension(new Fhooe\Twig\SessionExtension());
```

Use the function:

```twig
{{ session("someKey") }}
```

This will output the value of `$_SESSION["someKey"]`. If nothing is stored under that key, sessions are inactive, or the session superglobal is unavailable, an empty string will be returned so that you can use the function safely.

## Contributing

If you'd like to contribute, please refer to [CONTRIBUTING](https://github.com/Digital-Media/fhooe-twig-extensions/blob/main/CONTRIBUTING.md) for details.

## License

*fhooe/twig-extensions* is licensed under the MIT license. See [LICENSE](https://github.com/Digital-Media/fhooe-twig-extensions/blob/main/LICENSE) for more information.
