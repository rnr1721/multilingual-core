<?php

namespace rnr1721\MultilingualCore;

use rnr1721\MultilingualCore\Contracts\LanguageInterface;

/**
* Base implementation of a language entity
*
* This class represents a single language in the system with its basic properties
* like code, name, locale and RTL status. It provides a simple and immutable
* implementation of the LanguageInterface.
*
* @example
* $language = new Language('en', 'English', 'en_US');
* $rtlLanguage = new Language('ar', 'Arabic', 'ar_SA', true);
*/
class Language implements LanguageInterface
{
    /**
     * ISO language code
     *
     * @var string
     */
    private string $code;

    /**
     * Human-readable language name
     *
     * @var string
     */
    private string $name;

    /**
     * Locale code in format language_TERRITORY
     *
     * @var string
     */
    private string $locale;

    /**
     * RTL (Right-to-Left) status
     *
     * @var bool
     */
    private bool $isRtl;

    /**
     * Initialize a new language instance
     *
     * @param string $code ISO language code (e.g., 'en', 'ru')
     * @param string $name Human-readable name (e.g., 'English', 'Русский')
     * @param string $locale Locale code (e.g., 'en_US', 'ru_RU')
     * @param bool $isRtl Whether the language is RTL, defaults to false
     */
    public function __construct(
        string $code,
        string $name,
        string $locale,
        bool $isRtl = false
    ) {
        $this->code = $code;
        $this->name = $name;
        $this->locale = $locale;
        $this->isRtl = $isRtl;
    }

    /**
     * @inheritDoc
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @inheritDoc
     */
    public function isRtl(): bool
    {
        return $this->isRtl;
    }
}
