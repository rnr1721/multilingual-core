<?php

namespace rnr1721\MultilingualCore\Contracts;

/**
* Interface for detecting the current language from HTTP request
*
* This interface defines a contract for language detection strategies.
* Implementations should analyze the request and determine which language
* should be used based on various factors like URL, headers, cookies, etc.
*/
interface LanguageDetectorInterface
{
    /**
     * Detects language from the given request
     *
     * @return string Returns language code (e.g. 'en', 'ru') if detected,
     *                     or default language if no language could be detected
     */
    public function detect(): string;
}
