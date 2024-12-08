<?php

namespace rnr1721\MultilingualCore\Contracts;

/**
* Interface for managing languages in a multilingual application
*
* This interface defines methods for handling multiple languages,
* including default language settings, current language state,
* and available language management. It serves as the central
* point for language-related operations in the application.
*/
interface LanguageManagerInterface
{
    /**
     * Get the default language
     *
     * Returns the language configured as the system default.
     * This is typically used as a fallback when no specific
     * language is requested or detected.
     *
     * @return LanguageInterface The default language instance
     */
    public function getDefaultLanguage(): LanguageInterface;

    /**
     * Get the current active language
     *
     * Returns the currently active language in the application.
     * This might be different from the default language based
     * on user selection or auto-detection.
     *
     * @return LanguageInterface The current language instance
     */
    public function getCurrentLanguage(): LanguageInterface;

    /**
     * Set the current active language
     *
     * Changes the current language to the specified one.
     * The language code must correspond to an available language.
     *
     * @param string $code Language code (e.g., 'en', 'ru')
     * @throws \InvalidArgumentException If the language code is not available
     */
    public function setCurrentLanguage(string $code): void;

    /**
     * Get all available languages
     *
     * Returns an array of all languages configured in the system.
     *
     * @return array<LanguageInterface> Array of available language instances
     */
    public function getAvailableLanguages(): array;

    /**
     * Check if a language is available
     *
     * Verifies whether a language with the given code exists
     * in the system.
     *
     * @param string $code Language code to check
     * @return bool True if language exists, false otherwise
     */
    public function hasLanguage(string $code): bool;

    /**
     * Get a specific language by its code
     *
     * Retrieves a language instance by its code if available.
     *
     * @param string $code Language code to retrieve
     * @return LanguageInterface|null Language instance or null if not found
     */
    public function getLanguage(string $code): ?LanguageInterface;
}
