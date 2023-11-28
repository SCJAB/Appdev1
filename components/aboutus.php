<!DOCTYPE html>
<html lang="en" class="scrollbar-hide">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> 
    <link href="../dist/output.css" rel="stylesheet">
    <title>About Us</title>
</head>
<body class="bg-image">
    <?php 
        include '../components/navbar.php';
    ?>
    <div class="h-screen flex items-center justify-center md:grid md:grid-cols-2 md:gap-4">
        <h1 class="absolute text-white text-xl font-bold md:text-3xl top-52 left-10 fade-in">About Us</h1>
        <div class="bg-black bg-opacity-50 text-white p-4 rounded-lg shadow-lg shadow-black md:ml-10 fade-in">
            <p class="text-xs md:text-base text-justify ">Welcome to Untangled, your space for understanding and improving your mental health. Our platform offers a simple and anonymous questionnaire to help you gain insights into your emotional well-being. Whether you choose to stay anonymous or share your information, we're here to support you on your path to a healthier, happier you. <br><br>We believe in the power of self-discovery and are dedicated to helping you untangle your thoughts. Your mental health matters, and Untangled is your companion on the journey to emotional well-being.</p>
        </div>
        <div class="hidden md:block">
            <img src="../img/team.jpg" class="w-9/12 h-1/3 rounded-lg md:mx-auto fade-in">
        </div>
    </div>

    <div class="mt-80 flex items-center justify-center h-screen md:mt-0">
        <div class="container p-4 mx-4">
            <h1 class="text-3xl font-semibold mb-6 text-white">Meet Our Team</h1>
            <div class="text-white grid gap-4 justify-center md:flex">
                <?php
                $teamMembers = [
                    ['Ralph', 'Team Leader, Developer & Database Analyst', '../img/Ralph.png'],
                    ['Luis', 'Developer & Database Analyst', '../img/Luis.jpg'],
                    ['Shean', 'Designer', '../img/Shean1.jpg'],
                    ['Marinelle', 'Content Writer', '../img/Mar.jpg'],
                ];

                foreach ($teamMembers as $member) {
                    list($name, $position, $image) = $member;
                ?>
                <div class="bg-black bg-opacity-50 p-4 rounded-lg shadow-lg fade-in w-80">
                    <img src="<?= $image ?>" alt="<?= $name ?>" class="w-32 h-32 rounded-full mx-auto mb-4">
                    <h2 class="text-xl font-semibold"><?= $name ?></h2>
                    <p><?= $position ?></p>
                    <ion-icon name="logo-facebook"></ion-icon>
                    <ion-icon name="logo-github"></ion-icon>
                    <ion-icon name="logo-instagram"></ion-icon>
                    <ion-icon name="logo-twitter"></ion-icon>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <?php 
        echo '<div class="h-80 md:h-0"></div>';
        include '../components/footer.php'
    ?>

    <style>
        .bg-image {
            background-image: url('../img/office.jpg');
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
    </script>
</body>
</html>