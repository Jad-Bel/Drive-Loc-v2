<?php 
// require_once __DIR__ . "/../../config/database.php";
    require_once "../../../models/user.php";

session_start();

$errors = [];
$user = new user();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $result = $user->register(
            htmlspecialchars($_POST['firstName']),
            htmlspecialchars($_POST['lastName']),
            htmlspecialchars($_POST['email']),
            password_hash($_POST['password'], PASSWORD_BCRYPT),
            2 // Role ID    
            );

        if ($result) {
            $_SESSION['success'] = "Registration successful! Please login.";
            header('Location: login.php');
            echo 3;
            die;
            // exit();
        } else {
            $errors[] = "Registration failed. Please try again.";
            echo 2;
        }
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DRIVE-LOC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    Create your account
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Or
                    <a href="login.php" class="font-medium text-primary hover:text-primary/80">
                        sign in to your account
                    </a>
                </p>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                <?php echo implode('<br>', $errors); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form class="mt-8 space-y-6" id="registerForm" method="POST" novalidate>
                <div class="rounded-md shadow-sm space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="role" value="2" hidden>
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700">
                                First name
                            </label>
                            <input id="firstName" name="firstName" type="text" required
                                value="<?php echo htmlspecialchars($_POST['firstName'] ?? ''); ?>"
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                                placeholder="First name">
                            <p class="mt-1 text-sm text-red-600 hidden" id="firstNameError"></p>
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700">
                                Last name
                            </label>
                            <input id="lastName" name="lastName" type="text" required
                                value="<?php echo htmlspecialchars($_POST['lastName'] ?? ''); ?>"
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary sm:text-sm"
                                placeholder="Last name">
                            <p class="mt-1 text-sm text-red-600 hidden" id="lastNameError"></p>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <input id="email" name="email" type="email" required
                            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
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

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Create account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let isValid = true;
            const errors = [];
            
            document.querySelectorAll('.text-red-600').forEach(el => el.classList.add('hidden'));
            
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            
            const nameRegex = /^[a-zA-ZÀ-ÿ\s]{2,}$/;
            if (!nameRegex.test(firstName)) {
                document.getElementById('firstNameError').textContent = 'Please enter a valid first name (minimum 2 characters)';
                document.getElementById('firstNameError').classList.remove('hidden');
                errors.push('Invalid first name');
                isValid = false;
            }
            
            if (!nameRegex.test(lastName)) {
                document.getElementById('lastNameError').textContent = 'Please enter a valid last name (minimum 2 characters)';
                document.getElementById('lastNameError').classList.remove('hidden');
                errors.push('Invalid last name');
                isValid = false;
            }
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                document.getElementById('emailError').textContent = 'Please enter a valid email address';
                document.getElementById('emailError').classList.remove('hidden');
                errors.push('Invalid email');
                isValid = false;
            }
            
            const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
            if (!passwordRegex.test(password)) {
                document.getElementById('passwordError').textContent = 
                    'Password must be at least 6 characters long and contain at least one letter and one number';
                document.getElementById('passwordError').classList.remove('hidden');
                errors.push('Invalid password');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: errors.join('<br>'),
                    confirmButtonColor: '#FF6B00'
                });
            }
        });

        <?php if (isset($_SESSION['success'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: <?php echo json_encode($_SESSION['success']); ?>,
            confirmButtonColor: '#FF6B00'
        });
        <?php unset($_SESSION['success']); endif; ?>
    </script>
</body>
</html>