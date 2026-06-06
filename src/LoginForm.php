<?php
namespace JarirAhmed\FormGenerator;

class LoginForm
{
    use FormSupport;

    /**
     * @param array $options action, method, csrfToken, csrfFieldName, submitText,
     *                       values[email], styles (bool)
     */
    public static function render(array $options = []): string
    {
        $action = self::e($options['action'] ?? '/login');
        $method = self::method($options);
        $submit = self::e($options['submitText'] ?? 'Login');
        $styles = ($options['styles'] ?? true) ? self::styles() : '';
        $csrf = self::csrfField($options);
        $email = self::value($options, 'email');

        return $styles . '
            <form class="login-form" method="' . $method . '" action="' . $action . '">
                ' . $csrf . '
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="' . $email . '" required autocomplete="username">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">

                <button type="submit">' . $submit . '</button>
            </form>
        ';
    }

    private static function styles(): string
    {
        return '
            <style>
                .login-form { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; }
                .login-form label { display: block; margin-bottom: 8px; font-weight: bold; }
                .login-form input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px; }
                .login-form button { background-color: #007BFF; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
                .login-form button:hover { background-color: #0056b3; }
            </style>';
    }
}
