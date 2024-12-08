<?php

namespace rnr1721\MultilingualCore\Tests;

use PHPUnit\Framework\TestCase;
use rnr1721\MultilingualCore\Language;

class LanguageTest extends TestCase
{
    public function testLanguageCreation(): void
    {
        $language = new Language('en', 'English', 'en_US', false);

        $this->assertEquals('en', $language->getCode());
        $this->assertEquals('English', $language->getName());
        $this->assertEquals('en_US', $language->getLocale());
        $this->assertFalse($language->isRtl());
    }

    public function testRtlLanguage(): void
    {
        $language = new Language('ar', 'Arabic', 'ar_SA', true);

        $this->assertTrue($language->isRtl());
    }
}
