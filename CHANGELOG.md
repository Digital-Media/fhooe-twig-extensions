# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
### Changed
### Deprecated
### Removed
### Fixed
### Security

## [3.0.0] - 2026-03-24

### Changed

- Switched to PHP 8.5 as a minimum requirement.
- Requires `fhooe/router` 3.0.0.
- `get_base_path` now reads the public `basePath` property directly (replaces the removed `getBasePath()` method).
- Added PHP-CS-Fixer (`@PER-CS`) and `cs-check`/`cs-fix` scripts.
- Updated all dependencies.

## [2.0.0] - 2025-03-26

### Added

- Added more and better tests.

### Changed

- Requires `Router` 2.0.0.
- `Router` property in `RouterExtension` is now `readonly`.
- Switched to PHP 8.4 as a minimum requirement.
- Updated all dependencies.

## [1.0.0] - 2024-02-05

### Added

- Initial release.
- Added `RouterExtension` that allows to use paths from the router in Twig templates.
- Added `SessionExtension` that allows to easily access `$_SESSION` in Twig templates.
- Added unit tests with Pest.
- Added [phpstan](https://packagist.org/packages/phpstan/phpstan) for code analysis.
- Added `README.md`.
- Added notes on Contributing.
- Added this changelog.

[Unreleased]: https://github.com/Digital-Media/fhooe-twig-extensions/compare/v3.0.0...HEAD
[3.0.0]: https://github.com/Digital-Media/fhooe-twig-extensions/compare/v2.0.0...v3.0.0
[2.0.0]: https://github.com/Digital-Media/fhooe-twig-extensions/compare/v1.0.0...v2.0.0
[1.0.0]: https://github.com/Digital-Media/fhooe-twig-extensions/releases/tag/v1.0.0
