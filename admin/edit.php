<!DOCTYPE html>
<html lang="en" class="scrollbar-hide">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="../dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white min-h-screen m-5">
    <a href="javascript:history.go(-1)" class="hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 ml-4">
        Back
    </a>
    <div class=" flex flex-col items-center justify-center ">
        
        <h2 class="text-2xl font-semibold text-yellow-400 mb-4">Edit User</h2>

        <?php
        require('../php/user-model.php');
        
        $userRetriever = new UserModel(); 
        $userData = $userRetriever->viewUser($_GET['id']);
        if ($userData !== null) {
        ?>
        <form action="../php/user-controller.php" method="POST" class="bg-gray-800 rounded-lg p-8 text-white w-[28rem] mb-8 overflow-y-auto">
                <div class="mb-2">
                    <label for="first_name" class="text-sm font-bold tracking-wide">First Name</label> <br>
                    <input type="text" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $userData['first_name']; ?>" class="w-full p-2 rounded-xl border border-gray-700 text-gray-900 text-sm focus:outline-none focus:border-yellow-500 mt-2">
                </div>
                <div class="mb-2">
                    <label for="last_name" class="text-sm font-bold tracking-wide">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo $userData['last_name']; ?>" class="w-full p-2 rounded-xl border border-gray-700 text-gray-900 text-sm focus:outline-none focus:border-yellow-500 mt-2">
                </div>
                <div class="mb-2">
                    <label for="age" class="text-sm font-bold tracking-wide">Age</label>
                    <input type="number" id="age" name="age" placeholder="Age" value="<?php echo $userData['age']; ?>" class="w-full p-2 rounded-xl border border-gray-700 text-gray-900 text-sm focus:outline-none focus:border-yellow-500 mt-2">
                </div>
                <div class="mb-2">
                    <label for="email" class="text-sm font-bold tracking-wide">Email</label>
                    <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $userData['email']; ?>" class="w-full p-2 rounded-xl border border-gray-700 text-gray-900 text-sm focus:outline-none focus:border-yellow-500 mt-2">
                </div>
                <div class="mb-8">
                    <label class="text-sm font-bold tracking-wide">Score</label>
                    <input type="number" name="score" placeholder="Score" value="<?php echo $userData['total_score']; ?>" class="w-full p-2 rounded-xl border border-gray-700 text-gray-900 text-sm focus:outline-none focus:border-yellow-500 mt-2">
                </div>
                <div class="text-center mb-16">
                    <label class="text-sm font-bold tracking-wide">Depression Level</label><br>
                    <?php
                    $depressionLevels = ['NORMAL', 'MILD', 'BORDERLINE', 'MODERATE', 'SEVERE', 'EXTREME'];
                    foreach ($depressionLevels as $level) {
                    ?>
                        <label for="<?php echo $level; ?>" class="text-sm mr-6">
                            <input class="mt-4" type="radio" id="<?php echo $level; ?>" name="depression_level" value="<?php echo $level; ?>" <?php if ($userData['depression_level'] == $level) echo 'checked'; ?>>
                            <?php echo ucfirst(strtolower($level)); ?>
                        </label>
                    <?php
                    }
                    ?>
                </div>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
            <div class="text-center">
                <button type="submit" class="hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4">
                    Update
                </button>
            </div>
        </form>

        <?php
        } else {
            // 
            echo "User not found.";
        }
        ?>
    </div>
</body>
</html>  