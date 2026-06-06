<?php
namespace JarirAhmed\FormGenerator;

class RegistrationForm
{
    use FormSupport;

    /**
     * @param array $options action, method, csrfToken, csrfFieldName, submitText,
     *                       values[name|email], styles (bool)
     */
    public static function render(array $options = []): string
    {
        $action = self::e($options['action'] ?? '/register');
        $method = self::method($options);
        $submit = self::e($options['submitText'] ?? 'Register');
        $styles = ($options['styles'] ?? true) ? self::styles() : '';
        $csrf = self::csrfField($options);
        $name = self::value($options, 'name');
        $email = self::value($options, 'email');

        return $styles . '
            <form class="registration-form" method="' . $method . '" action="' . $action . '">
                ' . $csrf . '
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="' . $name . '" required autocomplete="name">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="' . $email . '" required autocomplete="email">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required minlength="8" autocomplete="new-password">

                <button type="submit">' . $submit . '</button>
            </form>
        ';
    }

    private static function styles(): string
    {
        return '
            <style>
                .registration-form { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; }
                .registration-form label { display: block; margin-bottom: 8px; font-weight: bold; }
                .registration-form input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px; }
                .registration-form button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
                .registration-form button:hover { background-color: #218838; }
            </style>';
    }
}
