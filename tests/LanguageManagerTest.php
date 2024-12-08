<?php

namespace rnr1721\MultilingualCore\Tests;

use PHPUnit\Framework\TestCase;
use rnr1721\MultilingualCore\{Language, LanguageManager};
use InvalidArgumentException;

class LanguageManagerTest extends TestCase
{
    private LanguageManager $manager;
    private array $languages;

    protected function setUp(): void
    {
        $this->languages = [
            new Language('en', 'English', 'en_US'),
            new Language('ru', 'Russian', 'ru_RU')
        ];
        $this->manager = new LanguageManager($this->languages, 'en');
    }

    public function testDefaultLanguage(): void
    {
        $this->assertEquals('en', $this->manager->getDefaultLanguage()->getCode());
    }

    public function testCurrentLanguage(): void
    {
        $this->assertEquals('en', $this->manager->getCurrentLanguage()->getCode());

        $this->manager->setCurrentLanguage('ru');
        $this->assertEquals('ru', $this->manager->getCurrentLanguage()->getCode());
    }

    public function testInvalidDefaultLanguage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new LanguageManager($this->languages, 'fr');
    }

    public function testInvalidCurrentLanguage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->manager->setCurrentLanguage('fr');
    }

    public function testGetAvailableLanguages(): void
    {
        $languages = $this->manager->getAvailableLanguages();
        $this->assertCount(2, $languages);
        $this->assertEquals('en', $languages[0]->getCode());
        $this->assertEquals('ru', $languages[1]->getCode());
    }

    public function testHasLanguage(): void
    {
        $this->assertTrue($this->manager->hasLanguage('en'));
        $this->assertTrue($this->manager->hasLanguage('ru'));
        $this->assertFalse($this->manager->hasLanguage('fr'));
    }

    public function testGetLanguage(): void
    {
        $this->assertNotNull($this->manager->getLanguage('en'));
        $this->assertNull($this->manager->getLanguage('fr'));
    }
}
