<?php

namespace rnr1721\MultilingualCore;

use rnr1721\MultilingualCore\Contracts\LanguageInterface;
use rnr1721\MultilingualCore\Contracts\LanguageManagerInterface;

/**
* Main implementation of the LanguageManager
*
* This class manages multiple languages in the application, handling
* default and current language states, and providing access to all
* available languages. It maintains a registry of language instances
* and ensures proper language switching functionality.
*/
class LanguageManager implements LanguageManagerInterface
{
    /**
     * Registry of all available languages
     *
     * @var array<string, LanguageInterface> Array of languages indexed by language code
     */
    private array $languages = [];

    /**
     * The default language instance
     *
     * @var LanguageInterface
     */
    private LanguageInterface $defaultLanguage;

    /**
     * The current active language instance
     *
     * @var LanguageInterface
     */
    private LanguageInterface $currentLanguage;

    /**
     * Initialize the language manager
     *
     * @param array<LanguageInterface> $languages Array of language instances
     * @param string $defaultLanguageCode Code of the default language
     *
     * @throws \InvalidArgumentException If any language doesn't implement LanguageInterface
     * @throws \InvalidArgumentException If default language is not in available languages
     */
    public function __construct(array $languages, string $defaultLanguageCode)
    {
        foreach ($languages as $language) {
            if (!$language instanceof LanguageInterface) {
                throw new \InvalidArgumentException('Language must implement LanguageInterface');
            }
            $this->languages[$language->getCode()] = $language;
        }

        if (!isset($this->languages[$defaultLanguageCode])) {
            throw new \InvalidArgumentException('Default language must be in available languages');
        }

        $this->defaultLanguage = $this->languages[$defaultLanguageCode];
        $this->currentLanguage = $this->defaultLanguage;
    }

    /**
     * @inheritDoc
     */
    public function getDefaultLanguage(): LanguageInterface
    {
        return $this->defaultLanguage;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentLanguage(): LanguageInterface
    {
        return $this->currentLanguage;
    }

    /**
     * @inheritDoc
     */
    public function setCurrentLanguage(string $code): void
    {
        if (!$this->hasLanguage($code)) {
            throw new \InvalidArgumentException("Language {$code} is not available");
        }
        $this->currentLanguage = $this->languages[$code];
    }

    /**
     * @inheritDoc
     */
    public function getAvailableLanguages(): array
    {
        return array_values($this->languages);
    }

    /**
     * @inheritDoc
     */
    public function hasLanguage(string $code): bool
    {
        return isset($this->languages[$code]);
    }

    /**
     * @inheritDoc
     */
    public function getLanguage(string $code): ?LanguageInterface
    {
        return $this->languages[$code] ?? null;
    }
}
