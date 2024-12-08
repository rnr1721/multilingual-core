<?php

namespace rnr1721\MultilingualCore\Contracts;

/**
* Interface representing a language entity
*
* This interface defines the contract for language entities in the system.
* Each language has basic properties like code, name, locale and RTL status.
* Implementations should provide these core language attributes that are
* necessary for multilingual functionality.
*/
interface LanguageInterface
{
    /**
     * Get the language code
     *
     * Returns the ISO language code (e.g. 'en' for English, 'ru' for Russian)
     *
     * @return string Language code in ISO format
     */
    public function getCode(): string;

    /**
     * Get the language name
     *
     * Returns the human-readable name of the language (e.g. 'English', 'Русский')
     *
     * @return string Human-readable language name
     */
    public function getName(): string;

    /**
     * Get the locale code
     *
     * Returns the full locale code (e.g. 'en_US', 'ru_RU')
     * which can be used for locale-specific formatting
     *
     * @return string Locale code in format 'language_TERRITORY'
     */
    public function getLocale(): string;

    /**
     * Check if the language is RTL (Right-to-Left)
     *
     * Indicates whether this language uses right-to-left text direction
     * (e.g. Arabic, Hebrew)
     *
     * @return bool True for RTL languages, false for LTR languages
     */
    public function isRtl(): bool;
}
