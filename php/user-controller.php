<?php
require_once 'user-model.php';
require_once 'interpret-depression.php';

class UserController {
    public function viewUser($id) {
        $userModel = new UserModel();
        return $userModel->viewUser($id);
    }

    public function deleteUser($id) {
        $userModel = new UserModel();
        $success = $userModel->deleteUser($id);
        $destination = $success ? 'success' : 'failed';
        header("location: ../admin?page=list&delete-$destination=true");
    }

    public function createUser($type, $first_name, $last_name, $email, $age, $total_score) {
        $user = UserFactory::getDetails($type, $first_name, $last_name, $email, $age, $total_score);

        $userModel = new UserModel();
        $success = $userModel->createUser($user);

        // array to be used for display in results
        $userData = [
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "age" => $user->getAge(),
            "email" => $user->getEmail(),
            "totalScore" => $user->getTotalScore(),
            "depressionLevel" => $user->getDepressionLvl(),
        ];
        
        // encode the array to be used as a URL parameter
        $userDataEncoded = base64_encode(json_encode($userData));

        $destination = $success ? 'success' : 'failed';
        header("location: ../components/result.php?create-$destination=true&user=$userDataEncoded&visibility=" . $_SESSION['visibility'] );
    }
}

// simplifies routing
function handleRequest() {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

    $controller = new UserController();

    switch ($action) {
        case 'update':
            handleUpdate($controller);
            break;
        case 'create':
            handleCreate($controller);
            break;
        case 'delete':
            handleDelete($controller, $id);
            break;
        default:
            echo "Invalid action";
            break;
    }
}

function redirectToEdit($id) {
    header("location: ../admin/edit.php?id=$id&action=update");
    exit;
}

function handleUpdate($controller) {
    if (isset($_POST["id"])) {
        $id = $_POST["id"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $age = $_POST["age"];
        $email = $_POST["email"];
        $score = $_POST["score"];
        $depression_level = $_POST["depression_level"];
        $controller->updateUser($id, $first_name, $last_name, $age, $email, $score, $depression_level);
    } else {
        header("location: ../admin?update-failed=true");
    }
}

function handleCreate($controller) {
    $visibility = isset($_SESSION['visibility']) ? $_SESSION['visibility'] : '';
    $first_name = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
    $last_name = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '';
    $age = isset($_SESSION['age']) ? $_SESSION['age'] : 0;
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $total_score = isset($_SESSION['totalScore']) ? $_SESSION['totalScore'] : 0;

    $controller->createUser($visibility, $first_name, $last_name, $email, $age, $total_score);
}

function handleDelete($controller, $id) {
    $controller->deleteUser($id);
}

// calls the request handler
handleRequest();