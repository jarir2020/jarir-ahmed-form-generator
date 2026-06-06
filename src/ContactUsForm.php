<?php
namespace JarirAhmed\FormGenerator;

class ContactUsForm
{
    use FormSupport;

    /**
     * @param array $options action, method, csrfToken, csrfFieldName, submitText,
     *                       values[name|email|message], styles (bool)
     */
    public static function render(array $options = []): string
    {
        $action = self::e($options['action'] ?? '/contact');
        $method = self::method($options);
        $submit = self::e($options['submitText'] ?? 'Send Message');
        $styles = ($options['styles'] ?? true) ? self::styles() : '';
        $csrf = self::csrfField($options);
        $name = self::value($options, 'name');
        $email = self::value($options, 'email');
        $message = self::value($options, 'message');

        return $styles . '
            <form class="contact-form" method="' . $method . '" action="' . $action . '">
                ' . $csrf . '
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="' . $name . '" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="' . $email . '" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required>' . $message . '</textarea>

                <button type="submit">' . $submit . '</button>
            </form>
        ';
    }

    private static function styles(): string
    {
        return '
            <style>
                .contact-form { max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; }
                .contact-form label { display: block; margin-bottom: 8px; font-weight: bold; }
                .contact-form input, .contact-form textarea { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; font-size: 16px; }
                .contact-form button { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
                .contact-form button:hover { background-color: #45a049; }
            </style>';
    }
}
