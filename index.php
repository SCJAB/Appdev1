<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en" class="scrollbar-hide">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./dist/output.css">
    <title>Home</title>
</head>
<body class="bg-[#b9b9b8] z-0">
    <?php 
        include './components/navbar.php';
    ?>

    <div class="w-full h-screen bg-image flex flex-col justify-center z-0 fade-in">
        <div class="mx-5 md:mx-none fade-in">
            <div class="md:mb-20 md:pb-10 md:ml-[2.75rem] fade-in">
                <h1 class="md:text-5xl max-w-[38rem] mt-40 font-bold bg-clip-text text-transparent bg-gradient-to-l from-yellow-600 to-[#864A27] mb-10">If you feel comfortable, you can take our depression test to know more about yourself.</h1>
                <a href="./components/visibility.php" class="md:text-3xl bg-yellow-700 text-white font-bold py-2 px-4 rounded">Get Started</a>
            </div>
            <div class="md:items-start md:ml-[2.75rem] fade-in">
                <p class="md:text-lg font-semibold md:mb-5 text-[#99562C] italic">Depression is being colorblind and constantly <br class="hidden md:block">told how colorful the world is." </p>
                <p class="text-xs md:text-lg text-[#864A27] font-bold">-Atticus Poetry </p>
            </div>
        </div>
    </div>

    <?php 
        include './components/footer.php';    
    ?>

    <style>
        .bg-image {
            background-image: url('./img/gloom2.png');
            background-size: cover;
            background-position:370px;
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
</body>
</html>