<?php

namespace rnr1721\MultilingualCore\Tests;

use PHPUnit\Framework\TestCase;
use rnr1721\MultilingualCore\{Language, LanguageManager};
use InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use rnr1721\MultilingualCore\Contracts\LocaleManagerInterface;

class LanguageManagerTest extends TestCase
{
    private LanguageManager $manager;
    private array $languages;
    private LocaleManagerInterface|MockObject $localeManager;

    protected function setUp(): void
    {
        $this->languages = [
            new Language('en', 'English', 'en_US'),
            new Language('ru', 'Russian', 'ru_RU')
        ];

        // Создаем мок без ожиданий для общего использования
        $this->localeManager = $this->createMock(LocaleManagerInterface::class);
        $this->manager = new LanguageManager(
            $this->localeManager,
            $this->languages,
            'en'
        );
    }

    public function testDefaultLanguage(): void
    {
        // Создаем новый мок специально для этого теста
        $localeManager = $this->createMock(LocaleManagerInterface::class);
        $localeManager
            ->expects($this->once())
            ->method('setLocale')
            ->with('en_US');

        new LanguageManager($localeManager, $this->languages, 'en');

        $this->assertEquals('en', $this->manager->getDefaultLanguage()->getCode());
    }

    public function testCurrentLanguage(): void
    {
        $localeManager = $this->createMock(LocaleManagerInterface::class);
        $localeManager
            ->expects($this->exactly(2))
            ->method('setLocale')
            ->willReturnCallback(function ($locale) {
                static $count = 0;
                $expected = ['en_US', 'ru_RU'];
                $this->assertEquals($expected[$count], $locale);
                $count++;
            });

        $manager = new LanguageManager($localeManager, $this->languages, 'en');
        $this->assertEquals('en', $manager->getCurrentLanguage()->getCode());

        $manager->setCurrentLanguage('ru');
        $this->assertEquals('ru', $manager->getCurrentLanguage()->getCode());
    }

    public function testLocaleChangeOnLanguageSwitch(): void
    {
        $actualCalls = [];
        $localeManager = $this->createMock(LocaleManagerInterface::class);
        $localeManager
            ->expects($this->exactly(2))
            ->method('setLocale')
            ->willReturnCallback(function ($locale) use (&$actualCalls) {
                $actualCalls[] = $locale;
            });

        $manager = new LanguageManager($localeManager, $this->languages, 'en');
        $manager->setCurrentLanguage('ru');

        $this->assertEquals(['en_US', 'ru_RU'], $actualCalls);
    }

    public function testInvalidDefaultLanguage(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new LanguageManager($this->localeManager, $this->languages, 'fr');
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
