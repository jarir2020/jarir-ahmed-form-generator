<?php
namespace JarirAhmed\FormGenerator;

class ContactUsForm
{
    public function render()
    {
        return '
            <style>
                .contact-form {
                    max-width: 500px;
                    margin: auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                }

                .contact-form label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: bold;
                }

                .contact-form input,
                .contact-form textarea {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    font-size: 16px;
                }

                .contact-form button {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                }

                .contact-form button:hover {
                    background-color: #45a049;
                }
            </style>

            <form class="contact-form" method="POST" action="/contact">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        ';
    }
}
