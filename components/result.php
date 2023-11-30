<?php
session_start();

$userEncoded = $_GET['user'];
$user = json_decode(base64_decode(urldecode($userEncoded)), true);

$firstName = $user['firstName'];
$lastName = $user['lastName'];
$age = $user['age'];
$email = $user['email'];
$totalScore = $user['totalScore'];
$depressionLevel = $user['depressionLevel'];
$_SESSION['depression_level'] = $depressionLevel;

if (isset($_GET['visibility']) && $_GET['visibility'] == 'private') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (empty($email)) {
            echo '<div class="absolute top-28 inset-x-[20%] md:inset-x-[38%] md:inset-y-[100%] md:top-24 md:transform">
                <h3 style="color:red" class="bg-white rounded-full text-center text-xs md:font-medium p-2 z-50">Please fill in Email Address before submitting.</h3>
            </div>';
        } else {
            $_SESSION['email'] = $email;
            header("Location: ../php/email-send.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="scrollbar-hide scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../dist/output.css">
    <title>Your Result</title>
</head>
<body class="bg-image">
    <?php
        include '../components/navbar.php';
    ?>

    <div class="h-max">
        <?php
            if (isset($_GET['create-success'])) {
                echo '<div class="absolute inset-x-[38%] inset-y-24 transform fade-in"  id="error_msg">
                        <h3 class="bg-white rounded-full text-green-500 text-center font-medium p-2 z-50 text-xs">Successfully created!</h3>
                    </div>';
            }
        ?>
        <div class="flex justify-center fade-in">
            <div class="mt-44 w-11/12 h-60 flex justify-center rounded-xl md:mt-64 md:w-3/6 md:h-60">
                <div class="p-4 w-full text-white md:px-10 md:space-y-5 flex flex-col items-center">
                    <h1 class="text-center text-base text-[#ffc599] font-bold md:text-3xl">Your Depression Level</h1>
                    <div class="w-11/12 h-5/6 p-4 pb-5 text-xs bg-white bg-opacity-20 rounded-xl grid grid-cols-2 md:text-xl md:w-11/12 md:h-5/6">
                        <p>Name: </p>
                        <div class="text-center text-base font-bold text-yellow-400 md:text-3xl md:text-start"><?php echo $firstName . " " . $lastName; ?></div>
                        <p>Score: </p>
                        <div class="text-center text-base font-bold text-yellow-400 md:text-3xl md:text-start"><?php echo $totalScore; ?></div>
                        <p>Depression Level: </p>
                        <div class="text-center text-base font-bold text-yellow-400 md:text-3xl md:text-start"><?php echo $depressionLevel; ?></div>
                    </div>
                    
                    <div class="mt-10 p-4 w-1/2 text-xs bg-white bg-opacity-20 rounded-xl md:w-6/12">
                        <h2 class="text-center md:text-base">Would you like a copy of your result?</h2>
                        <?php if (isset($_GET['visibility']) && $_GET['visibility'] == 'private') { ?> 
                            <div class="flex justify-center"><button class="text-[#ffc599] font-bold md:text-lg hover:text-green-400 duration-500" onclick="openModal()">Input Email</button></div>
                        <?php } elseif (isset($_GET['visibility']) && $_GET['visibility'] == 'public') { ?>
                            <div class="flex justify-center"><button class="text-[#ffc599] font-bold md:text-lg hover:text-green-400 duration-500" onclick="openModal()">Send Email</button></div>
                        <?php } ?>
                        <div id="myModal" class="modal">
                            <div class="w-56 p-4 mt-64 mx-auto bg-[#99572C] rounded-xl md:w-3/12 md:p-10 md:mt-96 fade-in">
                                <?php if (isset($_GET['visibility']) && $_GET['visibility'] == 'private') { ?>
                                    <form action="" method="POST">
                                        <label for="email" class="text-base font-medium md:text-3xl md:font-bold">Email</label><br>
                                        <input type="email" id="email" name="email" class="mt-4 py-1 px-4 text-black rounded-xl md:w-64"><br>
                                        <input type="submit" value="Send Email" class="mt-4 font-semibold md:text-lg md:font-bold hover:text-green-400 duration-500">
                                    </form>
                                    <button class="text-slate-300 float-right md:text-base md:font-semibold hover:text-red-500 duration-500" onclick="closeModal()">Close</button>
                                <?php } elseif (isset($_GET['visibility']) && $_GET['visibility'] == 'public') { ?>
                                <a href="../php/email-send.php" class="mt-4 font-semibold md:text-lg md:font-bold hover:text-green-400 duration-500">Send Email</a><br />
                                <button class="text-slate-300 float-right md:text-base md:font-semibold hover:text-red-500 duration-500" onclick="closeModal()">Close</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-10 text-white md:mx-40 mt-32 space-y-7 text-justify">
            <h1 class="mb-6 text-3xl font-bold text-yellow-400">Did You Know</h1>
            <div class="p-4 bg-black bg-opacity-60 rounded-xl">
                <h2 class="text-base font-bold text-[#ffc599] md:text-xl">Children (10-14 years):</h2>
                <p class="text-xs md:text-base line-clamp-2 md:line-clamp-none">Depression is estimated to affect around 1.1% of children aged 10-14. While it is rare, it's not unheard of for children in this age group to experience depression.</p>
                <a href="#bargraph" class="text-xs text-lime-300 font-serif italic underline-offset-2 hover:text-white duration-300">Look at Graph</a>
            </div>
            <div class="p-4 bg-black bg-opacity-60 rounded-xl">
                <h2 class="text-base font-bold text-[#ffc599] md:text-xl">Adolescents (15-19 years):</h2>
                <p class="text-xs md:text-base line-clamp-2 md:line-clamp-none">Approximately 2.8% of adolescents aged 15-19 are estimated to experience depression. Suicidal thoughts and behaviors tend to become more prevalent during the teenage years due to the unique challenges adolescents face, some of which may contribute to mental health issues.</p>
                <a href="#bargraph" class="text-xs text-lime-300 font-serif italic underline-offset-2 hover:text-white duration-300">Look at Graph</a>
            </div>
            <div class="p-4 bg-black bg-opacity-60 rounded-xl">
                <h2 class="text-base font-bold text-[#ffc599] md:text-xl">Early Adulthood (20-29 years):</h2>
                <p class="text-xs md:text-base line-clamp-2 md:line-clamp-none">In early adulthood, the prevalence of depression can vary, but it typically falls within the range of 6% to 10%. Suicidal thoughts and behaviors remain a concern in early adulthood due to life transitions and increased responsibilities affecting mental well-being.</p>
                <a href="#bargraph" class="text-xs text-lime-300 font-serif italic underline-offset-2 hover:text-white duration-300">Look at Graph</a>
            </div>
            <div class="p-4 bg-black bg-opacity-60 rounded-xl">
                <h2 class="text-base font-bold text-[#ffc599] md:text-xl">Adulthood (30-64 years):</h2>
                <p class="text-xs md:text-base line-clamp-2 md:line-clamp-none">The prevalence of depression in this age range remains relatively stable, with rates ranging from approximately 6% to 10% or higher, depending on factors like population and diagnostic criteria. Suicidal risk tends to be consistent across these years, with the prevalence of suicidal thoughts and behaviors remaining a concern.</p>
                <a href="#bargraph" class="text-xs text-lime-300 font-serif italic underline-offset-2 hover:text-white duration-300">Look at Graph</a>
            </div>
            <div class="p-4 bg-black bg-opacity-60 rounded-xl">
                <h2 class="text-base font-bold text-[#ffc599] md:text-xl">Older Adults (65-74 years):</h2>
                <p class="text-xs md:text-base line-clamp-2 md:line-clamp-none">Depression rates tend to decrease in older adults compared to earlier adulthood, with an estimated prevalence of around 1-5%. While the risk of suicide decreases among older adults, it can still occur, often associated with factors such as social isolation and health issues.</p>
                <a href="#bargraph" class="text-xs text-lime-300 font-serif italic underline-offset-2 hover:text-white duration-300">Look at Graph</a>
            </div>
            <div class="p-4 bg-black bg-opacity-60 rounded-xl">
                <h2 class="text-base font-bold text-[#ffc599] md:text-xl">Elderly (75-90 years):</h2>
                <p class="text-xs md:text-base line-clamp-2 md:line-clamp-none">Among the very elderly population, the prevalence of depression remains relatively low but can vary. Depression rates for those aged 75-90 tend to range from 1-5%, with variations influenced by factors such as living conditions and physical health. Suicidal thoughts and behaviors may continue to decrease in the very elderly population, but they can still be a concern, especially among those facing significant health problems or bereavement.</p>
            </div>
        </div>

    <div class="flex justify-center mb-10 mt-10" id="bargraph">
        <div class="p-5 bg-white bg-opacity-30 rounded-xl flex justify-center md:p-0 md:w-7/12 md:h-11/12">
            <canvas id="ageChart" width="300" height="150"></canvas>
        </div>
    </div>

    <!-- <p class="text-[5%] text-slate-400 mx-56">References Depression, suicidality and loneliness: Mental health and Australian . (n.d.). https://aifs.gov.au/media/depression-suicidality-and-loneliness-mental-health-and-australian-men MediLexicon International. (n.d.). Why is gen Z depressed?. Medical News Today. https://www.medicalnewstoday.com/articles/why-is-gen-z-depressed World Health Organization. (n.d.). Mental health of adolescents. World Health Organization. https://www.who.int/news-room/fact-sheets/detail/adolescent-mental-health#:~:text=It%20is%20estimated%20that%203.6,and%20unexpected%20changes%20in%20mood.</p> -->

    <?php 
        include '../components/footer.php';
    ?>

    <style>
        .bg-image {
            background-image: url('../img/result1.jpg');
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
        
        .modal {
            display: none;
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.4);
        }
    </style>

    <script>
    // Your age statistics data
    var ageData = {
        "Children (10-14 years)": 1.1,
        "Adolescents (15-19 years)": 2.8,
        "Early Adulthood (20-29 years)": 8,  
        "Adulthood (30-64 years)": 8,        
        "Older Adults (65-74 years)": 3,      
        "Elderly (75-90 years)": 3            
    };

    var ctx = document.getElementById('ageChart').getContext('2d');

    var ageChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(ageData),
            datasets: [{
                label: 'Prevalence of Depression (%)',
                data: Object.values(ageData),
                backgroundColor: 'rgba(153, 87, 44, 1)',
                borderColor: 'rgba(255, 255, 255, 1)',
                borderWidth: 3,
                borderRadius: 5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'white'
                    }
                },
                x: {
                    ticks: {
                        color: 'white'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white'
                    }
                }
            }
        }
    });
    setTimeout(() => {
        error_msg.classList.add('hidden');
    }, 1500);

    function openModal() {
      document.getElementById("myModal").style.display = "block";
    }

    function closeModal() {
      document.getElementById("myModal").style.display = "none";
    }
    </script>
</body>
</html>
