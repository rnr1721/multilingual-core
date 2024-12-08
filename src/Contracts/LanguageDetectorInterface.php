<?php

namespace rnr1721\MultilingualCore\Contracts;

use Psr\Http\Message\ServerRequestInterface;

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
     * @param ServerRequestInterface $request PSR-7 server request instance
     *
     * @return string|null Returns language code (e.g. 'en', 'ru') if detected,
     *                     or null if no language could be detected
     */
    public function detect(ServerRequestInterface $request): ?string;
}
