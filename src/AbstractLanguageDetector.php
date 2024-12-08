<?php

namespace rnr1721\MultilingualCore;

use rnr1721\MultilingualCore\Contracts\LanguageManagerInterface;
use rnr1721\MultilingualCore\Contracts\LanguageDetectorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Abstract base class for language detection
 *
 * Provides a foundation for framework-specific language detectors.
 * This class implements basic language detection logic while allowing
 * specific frameworks to implement their own detection strategies.
 *
 * The implementing classes should focus on framework-specific request
 * handling and path analysis.
 */
abstract class AbstractLanguageDetector implements LanguageDetectorInterface
{
    /**
     * Language manager instance
     *
     * @var LanguageManagerInterface
     */
    protected LanguageManagerInterface $languageManager;

    /**
     * Initialize the language detector
     *
     * @param LanguageManagerInterface $languageManager The language manager instance
     */
    public function __construct(LanguageManagerInterface $languageManager)
    {
        $this->languageManager = $languageManager;
    }

    /**
     * Detect language from request
     *
     * Framework-specific implementations should:
     * 1. Check for root path and return default language
     * 2. Check URL prefix for language code
     * 3. Return default language for non-language URLs
     *
     * Example implementation:
     * - / -> default language
     * - /ru/page -> 'ru'
     * - /about -> default language
     *
     * @param ServerRequestInterface $request PSR-7 server request
     * @return string|null Language code if detected, null otherwise
     */
    abstract public function detect(ServerRequestInterface $request): ?string;
}
