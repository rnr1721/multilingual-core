<?php

namespace rnr1721\MultilingualCore\Contracts;

/**
* Interface for generating URLs with language prefixes
*
* This interface defines the contract for URL generation in a multilingual
* application. It handles the creation of URLs that include language prefixes
* and maintains proper URL structure across different languages.
*/
interface UrlGeneratorInterface
{
    /**
     * Generate a URL with appropriate language prefix
     *
     * Creates a URL for the given route/path with language-specific formatting.
     * If no language code is provided, uses the current language.
     * The URL structure depends on configuration (e.g., whether to include
     * prefix for default language).
     *
     * @param string $route The route name or path to generate URL for
     * @param array $parameters Optional parameters to include in the URL
     *                         (query parameters or route parameters)
     * @param string|null $languageCode Specific language code to generate URL for,
     *                                 or null to use current language
     *
     * @return string Generated URL with appropriate language prefix and parameters
     *
     * Examples:
     * - generateUrl('blog', [], 'en') might return '/blog'
     * - generateUrl('blog', [], 'ru') might return '/ru/blog'
     * - generateUrl('post', ['id' => 1], 'ru') might return '/ru/post?id=1'
     */
    public function generateUrl(string $route, array $parameters = [], string $languageCode = null): string;
}
