# Internationalization (i18n) Implementation Guide

## Overview
This guide explains how to implement internationalization for your PHP MVC Digital Library project to support English, Arabic, and French languages.

## Implementation Steps

### 1. File Structure
Create the following directory structure:

```
project/
├── lang/
│   ├── en.php          # English translations
│   ├── ar.php          # Arabic translations
│   └── fr.php          # French translations
├── core/
│   ├── I18n.php        # Internationalization class
│   ├── Application.php # Updated with i18n support
│   └── Controller.php  # Updated with i18n support
├── controllers/
│   └── LanguageController.php  # Language switching
├── public/
│   └── css/
│       └── rtl.css     # RTL styles for Arabic
└── views/
    └── layouts/
        └── header.php  # Updated with language selector
```

### 2. Core Files to Create/Update

#### 2.1 Create Language Files
- Place the provided language files (`en.php`, `ar.php`, `fr.php`) in the `lang/` directory
- Each file returns an associative array with translation keys and values

#### 2.2 Create I18n Class
- Create `core/I18n.php` with the provided internationalization class
- This handles language detection, switching, and translation

#### 2.3 Update Core Classes
- Update `core/Application.php` to initialize I18n
- Update `core/Controller.php` to include I18n instance and helper

#### 2.4 Create Language Controller
- Create `controllers/LanguageController.php` for handling language switching

### 3. View Updates

#### 3.1 Update Header Template
Replace your existing header with the updated version that includes:
- Language selector dropdown
- RTL support detection
- Proper font loading for Arabic
- Updated navigation with translations

#### 3.2 Update Home View
Replace hardcoded text with translation functions using `__()` helper:
```php
// Before
<h1>Welcome to UniGrad</h1>

// After  
<h1><?php echo __('home.welcome_title'); ?></h1>
```

#### 3.3 Create RTL Stylesheet
- Create `public/css/rtl.css` with the provided RTL styles
- This handles right-to-left layout for Arabic

### 4. Route Updates
Add the language switching route to your routes file:
```php
'/language/switch' => ['LanguageController', 'switch'],
```

### 5. Database Updates (Optional)
If you want to store user language preferences:

```sql
ALTER TABLE users ADD COLUMN preferred_language VARCHAR(5) DEFAULT 'en';
```

## Usage Examples

### In Views
```php
<!-- Simple translation -->
<h1><?php echo __('nav.home'); ?></h1>

<!-- Translation with parameters -->
<p><?php echo __('footer.copyright', ['year' => date('Y')]); ?></p>

<!-- Check if RTL -->
<?php if ($i18n->isRtl()): ?>
    <div class="rtl-content">...</div>
<?php endif; ?>
```

### In Controllers
```php
// Set flash message with translation
$this->session->setFlash('success', __('listings.upload_success'));

// Get current language
$currentLang = $this->i18n->getCurrentLanguage();
```

### Language Switching
The language selector in the header automatically:
- Detects current language from session
- Shows available languages with flags
- Preserves current page when switching
- Stores preference in session

## Features Included

### 1. Automatic Language Detection
- Detects browser language on first visit
- Falls back to English if unsupported language
- Remembers user choice in session

### 2. RTL Support
- Automatic RTL layout for Arabic
- Proper text alignment and direction
- Icon flipping where appropriate
- Responsive RTL design

### 3. Font Support
- Uses Noto Sans Arabic for Arabic text
- Maintains existing fonts for other languages
- Proper font loading and fallbacks

### 4. Language Selector
- Dropdown with language flags and names
- Preserves current page when switching
- Clean, modern design
- Mobile-friendly

### 5. Translation Management
- Organized translation keys by context
- Support for parameterized translations
- Fallback to English for missing translations
- Easy to extend with new languages

## Adding New Languages

To add support for additional languages:

1. Create a new language file in `lang/` directory:
```php
// lang/es.php (Spanish example)
<?php
return [
    'nav' => [
        'home' => 'Inicio',
        'browse' => 'Explorar',
        // ... more translations
    ]
];
```

2. Update the supported languages in `I18n.php`:
```php
public function getSupportedLanguages(): array
{
    return [
        'en' => ['name' => 'English', 'flag' => '🇺🇸', 'rtl' => false],
        'ar' => ['name' => 'العربية', 'flag' => '🇩🇿', 'rtl' => true],
        'fr' => ['name' => 'Français', 'flag' => '🇫🇷', 'rtl' => false],
        'es' => ['name' => 'Español', 'flag' => '🇪🇸', 'rtl' => false], // New
    ];
}
```

## Best Practices

### 1. Translation Keys
- Use descriptive, hierarchical keys: `section.subsection.key`
- Group related translations together
- Use consistent naming conventions

### 2. Parameterized Translations
```php
// In language file
'welcome_message' => 'Welcome, :name! You have :count new messages.'

// In code
echo __('welcome_message', ['name' => $user['name'], 'count' => 5]);
```

### 3. Pluralization (Advanced)
For complex pluralization rules, you can extend the I18n class:
```php
// Simple approach in language files
'item_count' => [
    'zero' => 'No items',
    'one' => 'One item', 
    'other' => ':count items'
]
```

### 4. Date/Time Formatting
Use locale-aware formatting:
```php
// Consider using PHP's IntlDateFormatter for proper localization
$formatter = new IntlDateFormatter($locale, IntlDateFormatter::SHORT, IntlDateFormatter::NONE);
echo $formatter->format($timestamp);
```

## Testing

1. Test language switching functionality
2. Verify RTL layout works correctly in Arabic
3. Check that all text is translated
4. Test on mobile devices
5. Verify fallback behavior for missing translations

## Deployment Notes

1. Ensure `lang/` directory has proper read permissions
2. Clear any PHP opcode cache after updates
3. Test language detection with different browsers
4. Consider CDN implications for RTL CSS

This implementation provides a solid foundation for multilingual support while maintaining clean, maintainable code structure.