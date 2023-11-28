<?php
require $_SERVER["DOCUMENT_ROOT"] . '/Appdev/php/user-model.php';

// Display success notification
if (isset($_GET['update-success']) || isset($_GET['delete-success'])):
    $bgColor = isset($_GET['update-success']) ? 'bg-yellow-700' : 'bg-red-500';
    $message = '';

    if (isset($_GET['update-success'])) {
        $message .= 'Successfully updated';
    }

    if (isset($_GET['delete-success'])) {
        $message .= isset($_GET['update-success']) ? ' and ' : '';
        $message .= 'Successfully deleted';
    }
    ?>
    <div class="<?= $bgColor; ?> text-white font-bold py-2 px-4 rounded mb-4 mt-8">
        <?= $message; ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html>

<body class="bg-gray-900 text-white">
    <div class="w-full">
        <h1 class="text-2xl font-semibold text-yellow-400 mb-4">Users</h1>

        <div class="overflow-x-auto">
            <div class="mx-auto">
                <table class="table-auto min-w-full text-left border border-gray-700">
                    <thead>
                        <tr>
                            <?php
                            $headers = ["ID", "Name", "Age", "Email", "Score", "Depression", "Action"];
                            foreach ($headers as $header) {
                                $headerClass = $header === "Action" ? "text-right" : "";
                                echo '<th class="px-4 py-2 border border-gray-700 ' . $headerClass . '">' . $header . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $userRetriever = new UserModel();
                        $users = $userRetriever->viewUsers();

                        if (!empty($users)) {
                            // Pagination
                            $limit = 15;
                            $page_number = isset($_GET['page_number']) ? $_GET['page_number'] : 1;
                            $offset = ($page_number - 1) * $limit;
                            $allUsers = $userRetriever->viewUsers();
                            $total_pages = ceil(count($allUsers) / $limit);
                            $users = array_slice($allUsers, $offset, $limit);

                            foreach ($users as $user) {
                                echo '<tr>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . $user['id'] . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . $user['first_name'] . ' ' . $user['last_name'] . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . $user['age'] . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . $user['email'] . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . $user['total_score'] . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700">' . ucfirst(strtolower($user['depression_level'])) . '</td>';
                                echo '<td class="px-4 py-2 border border-gray-700 text-right">';
                                echo '<a href="view.php?id=' . $user['id'] . '" class="text-blue-500 hover:underline mr-2">View</a>';
                                echo '<a href="../php/user-controller.php?id=' . $user['id'] . '&action=delete" class="text-red-500 hover:underline">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7" class="px-4 py-2">User not found or Empty Database</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>

                <div class="flex justify-between items-center mt-4">
                    <div>
                        <?php if ($page_number > 1): ?>
                            <a href="?page=list&page_number=<?= $page_number - 1 ?>" class="prev-button hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Previous</a>
                        <?php endif; ?>
                    </div>

                    <div class="flex space-x-2">
                        <?php
                        $start = max(1, $page_number - 10);
                        $end = min($start + 19, $total_pages);

                        for ($i = $start; $i <= $end; $i++) {
                            $currentClass = $i == $page_number ? 'bg-yellow-700' : '';
                            echo '<a href="?page=list&page_number=' . $i . '" class="page-number hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block ' . $currentClass . '">' . $i . '</a>';
                        }
                        ?>
                    </div>

                    <div>
                        <?php if ($page_number < $total_pages): ?>
                            <a href="?page=list&page_number=<?= $page_number + 1 ?>" x-ref="nextButton" class="next-button hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>