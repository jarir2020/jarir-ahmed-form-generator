<style>
                .registration-form {
                    max-width: 400px;
                    margin: auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                }

                .registration-form label {
                    display: block;
                    margin-bottom: 8px;
                    font-weight: bold;
                }

                .registration-form input {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    font-size: 16px;
                }

                .registration-form button {
                    background-color: #28a745;
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                }

                .registration-form button:hover {
                    background-color: #218838;
                }
            </style>

            <form class="registration-form" method="POST" action="/register">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Register</button>
            </form>