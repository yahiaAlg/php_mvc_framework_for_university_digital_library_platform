<?php

class I18n
{
    private static ?I18n $instance = null;
    private string $currentLanguage = 'en';
    private array $translations = [];
    private string $translationsPath;

    private function __construct()
    {
        $this->translationsPath = __DIR__ . '/../lang/';
        $this->loadTranslations();
    }

    public static function getInstance(): I18n
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setLanguage(string $language): void
    {
        $supportedLanguages = ['en', 'ar', 'fr'];

        if (in_array($language, $supportedLanguages)) {
            $this->currentLanguage = $language;
            $this->loadTranslations();

            // Store in session if available
            global $app;
            if ($app !== null && $app->getSession() !== null) {
                $app->getSession()->set('language', $language);
            }
        }
    }

    public function getCurrentLanguage(): string
    {
        return $this->currentLanguage;
    }

    public function getSupportedLanguages(): array
    {
        return [
            'en' => ['name' => 'English', 'flag' => '🇺🇸', 'rtl' => false],
            'ar' => ['name' => 'العربية', 'flag' => '🇩🇿', 'rtl' => true],
            'fr' => ['name' => 'Français', 'flag' => '🇫🇷', 'rtl' => false]
        ];
    }

    public function isRtl(): bool
    {
        return $this->getSupportedLanguages()[$this->currentLanguage]['rtl'] ?? false;
    }

    private function loadTranslations(): void
    {
        $filePath = $this->translationsPath . $this->currentLanguage . '.php';

        if (file_exists($filePath)) {
            $this->translations = require $filePath;
        } else {
            // Fallback to English
            $fallbackPath = $this->translationsPath . 'en.php';
            if (file_exists($fallbackPath)) {
                $this->translations = require $fallbackPath;
            }
        }
    }

    public function translate(string $key, array $params = []): string
    {
        $translation = $this->getNestedValue($this->translations, $key);

        if ($translation === null) {
            return $key; // Return key if translation not found
        }

        // Replace parameters
        foreach ($params as $param => $value) {
            $translation = str_replace(':' . $param, $value, $translation);
        }

        return $translation;
    }

    private function getNestedValue(array $array, string $key): ?string
    {
        $keys = explode('.', $key);
        $value = $array;

        foreach ($keys as $k) {
            if (!is_array($value) || !isset($value[$k])) {
                return null;
            }
            $value = $value[$k];
        }

        return is_string($value) ? $value : null;
    }

    public function initializeFromSession(): void
    {
        global $app;
        $sessionLanguage = $app->getSession()->get('language');

        if ($sessionLanguage) {
            $this->setLanguage($sessionLanguage);
        } else {
            // Detect language from browser
            $browserLanguage = $this->detectBrowserLanguage();
            $this->setLanguage($browserLanguage);
        }
    }

    private function detectBrowserLanguage(): string
    {
        if (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            return 'en';
        }

        $languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        $supportedLanguages = array_keys($this->getSupportedLanguages());

        foreach ($languages as $language) {
            $lang = substr(trim($language), 0, 2);
            if (in_array($lang, $supportedLanguages)) {
                return $lang;
            }
        }

        return 'en';
    }
}

// Helper function
function __($key, $params = [])
{
    return I18n::getInstance()->translate($key, $params);
}
