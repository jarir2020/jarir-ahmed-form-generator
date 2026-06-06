<?php
namespace JarirAhmed\FormGenerator;

/**
 * Shared helpers for the form builders. Every value that originates from caller-supplied
 * options is escaped here, so enabling configurable actions/values can never introduce XSS.
 */
trait FormSupport
{
    /** HTML-escape a value for use in text or double-quoted attribute context. */
    protected static function e($value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }

    /** Normalize a form method to GET or POST (defaults to POST). */
    protected static function method(array $options): string
    {
        $method = strtoupper((string) ($options['method'] ?? 'POST'));
        return in_array($method, ['GET', 'POST'], true) ? $method : 'POST';
    }

    /** Hidden CSRF field, emitted only when a token is supplied. */
    protected static function csrfField(array $options): string
    {
        $token = $options['csrfToken'] ?? null;
        if ($token === null || $token === '') {
            return '';
        }
        $name = (string) ($options['csrfFieldName'] ?? '_token');
        return '<input type="hidden" name="' . self::e($name) . '" value="' . self::e($token) . '">';
    }

    /** A pre-filled value for an input, escaped; empty string when not provided. */
    protected static function value(array $options, string $field): string
    {
        $values = $options['values'] ?? [];
        return isset($values[$field]) ? self::e($values[$field]) : '';
    }
}
