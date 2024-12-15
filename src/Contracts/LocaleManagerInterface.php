<?php

namespace rnr1721\MultilingualCore\Contracts;

/**
 * Contract for framework-specific locale management
 *
 * This interface defines the contract for handling locale changes
 * in specific frameworks (Laravel, Symfony, etc.). Implementations
 * should handle the framework-specific logic for changing the application locale.
 */
interface LocaleManagerInterface
{
    /**
     * Set the application locale
     *
     * Changes the locale in the framework-specific way.
     * For example:
     * - Laravel: app()->setLocale()
     * - Symfony: Request->setLocale()
     * - etc.
     *
     * @param string $locale The locale to set (e.g., 'en_US', 'es_ES')
     *
     * @return void
     *
     * @throws \InvalidArgumentException If locale format is invalid
     */
    public function setLocale(string $locale): void;
}
