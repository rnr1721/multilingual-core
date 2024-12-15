# Multilingual Core Package
This package provides core functionality for implementing multilingual support across different PHP frameworks. It serves as a base dependency for framework-specific implementations.

## Features:

- Framework-agnostic multilingual support
- PSR-7 compatible
- Simple language switching via URL prefixes
- Support for RTL languages
- Flexible language detection strategies
- Framework-independent locale management

## Requirements:

- PHP 8.1 or higher
- PSR-7 HTTP Message implementation
- PSR-15 HTTP Middleware
- PSR-11 Container

## Installation:
```bash
composer require rnr1721/multilingual-core
```

## Usage:
This package is not intended to be used directly. Instead, use one of the framework-specific implementations:

- rnr1721/multilingual-laravel for Laravel
- rnr1721/multilingual-symfony for Symfony
- rnr1721/multilingual-slim for Slim Framework

For Framework Implementation Developers:
The core package provides several interfaces and base classes:

### LanguageInterface - Represents a language with its properties:

- getCode() - returns language code (e.g., 'en', 'ru')
- getName() - returns language name
- getLocale() - returns locale code (e.g., 'en_US')
- isRtl() - indicates if language is RTL

### LanguageManagerInterface - Manages available languages:

- getDefaultLanguage()
- getCurrentLanguage()
- setCurrentLanguage()
- getAvailableLanguages()
- hasLanguage()
- getLanguage()

### LanguageDetectorInterface - Detects current language from request
### UrlGeneratorInterface - Generates URLs with language prefixes

### LocaleManagerInterface - Framework-specific locale management:

- setLocale() - sets the application locale in framework-specific way

## Implementation example

```php

// Create language instances
$languages = [
    new Language('en', 'English', 'en_US'),
    new Language('ru', 'Russian', 'ru_RU', false)
];

// Implement LocaleManagerInterface for your framework
class MyFrameworkLocaleManager implements LocaleManagerInterface 
{
    public function setLocale(string $locale): void 
    {
        // Framework-specific locale setting
    }
}

// Create language manager
$manager = new LanguageManager(
    new MyFrameworkLocaleManager(),
    $languages,
    'en' // default language
);

// Language switching example
$manager->setCurrentLanguage('ru'); // Will also set framework locale to ru_RU

```

## Testing:
```bash
composer test
```

## Code Style:
```bash
composer cs-check
composer cs-fix
```
## Static Analysis:
```bash
composer phpstan
```

License: MIT

## Contributing:
Feel free to submit issues and pull requests.
For detailed documentation on implementing framework-specific packages, see the examples in our official implementations.

Note: This is a core package and should be used as a dependency for framework-specific implementations rather than directly in projects.
