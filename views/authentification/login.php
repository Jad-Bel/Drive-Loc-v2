<?php 
    require_once "../../models/user.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DRIVE-LOC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF6B00',
                        secondary: '#1E2A4A'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-secondary">
                    Welcome Back
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Or
                    <a href="register.php" class="font-medium text-primary hover:text-primary/80">
                        create a new account
                    </a>
                </p>
            </div>
            <form class="mt-8 space-y-6" id="loginForm" novalidate>
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <input id="email" name="email" type="email" required 
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Email address">
                        <p class="mt-1 text-sm text-red-600 hidden" id="emailError"></p>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <input id="password" name="password" type="password" required
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                            placeholder="Password">
                        <p class="mt-1 text-sm text-red-600 hidden" id="passwordError"></p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-primary hover:text-primary/80">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Reset errors
            document.querySelectorAll('.text-red-600').forEach(el => el.classList.add('hidden'));
            
            // Get form values
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Validation flags
            let isValid = true;
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address';
                document.getElementById('emailError').classList.remove('hidden');
                isValid = false;
            }
            
            // Password validation
            if (password.length < 6) {
                document.getElementById('passwordError').textContent = 'Password must be at least 6 characters long';
                document.getElementById('passwordError').classList.remove('hidden');
                isValid = false;
            }
            
            // If valid, submit form
            if (isValid) {
                // Here you would typically submit the form to your server
                console.log('Form is valid, submitting...');
            }
        });
    </script>
</body>
</html>