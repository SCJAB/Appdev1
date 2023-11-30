<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="../dist/output.css">
    <title>login</title>
</head>
<body class="bg-image">
    <section class="min-h-screen flex items-center justify-center fade-in">

        <div class="bg-orange-300 bg-opacity-20 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">

            <div class="sm:w-1/2 px-8">
                <h2 class="font-bold text-2xl text-[#1F0805]">Login</h2>
                <p class="text-sm mt-4 text-[#1F0805]">If you're already a member, easily log in</p>

                <form class="flex flex-col gap-4"  action="../php/login-user.php" method="post" novalidate>
                    <?php
                        if(isset($_GET['login']) == 'false'){
                            echo '<h1 id="validator" class="text-red-600">Incorrect user or password</h1>';
                        }
                    ?>
                    <input class="p-2 mt-8 rounded-2xl border" type="email" name="email" placeholder="Email">
                    <div class="relative ">
                        <input class="p-2 rounded-2xl border w-full" type="password" name="pass_word" placeholder="Password">
                        <ion-icon class="absolute top-1/2 right-5 -translate-y-1/2 text-lg" name="eye-outline"></ion-icon>
                    </div>
                    <button class="bg-[#1F0805] rounded-full text-white py-2 hover:scale-105 duration-400" type="submit">Login</button>
                </form>

                <div class="mt-10 grid grid-cols-3 items-center text-gray-600">
                    <hr class="text-gray-600">
                    <p class="text-center">OR</p>
                    <hr class="text-gray-600">
                </div>

                <button class="bg-white border py-2 w-full rounded-xl mt-5 flex justify-center items-center text-lg hover:scale-105 duration-400">
                    <ion-icon class="h-[25px] w-[25px] mr-3" name="logo-google"></ion-icon>
                    Login with Google
                </button>

                <div class="border-b">
                    <button type="button" class="mt-5 text-xs py-4 hover:text-red-500">Forgot your password?</button>
                </div>

                <div class="mt-3 text-xs flex justify-between items-center">
                    <p> don't have an account?</p>
                    <button class="py-2 px-5 bg-white border rounded-xl hover:scale-105 duration-400"><a href="../components/registration.php">Register</a></button>
                </div>
            </div>

            <div class="hidden md:block w-1/2">
                <a href="../index.php"><img class="hover:scale-110 duration-150 rounded-2xl" src="../img/mental_health.jpg" alt=""></a>
            </div>
        </div>
    </section>

    <style>
        .bg-image {
            background-image: url('../img/help.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
        .fade-in {
            opacity: 0;
            animation: fadeIn 2s ease forwards;
        }

        @keyframes fadeIn {
            from {
            opacity: 0;
            }
            to {
            opacity: 1;
            }
        }
        
    </style>
    <script>
        const validator = document.getElementById('validator');

        // Set a timeout to change the color
        setTimeout(() => {
        validator.classList.add('hidden');
        }, 5000);
    </script>
</body>
</html>