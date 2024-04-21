<?php
require('includes/database.php');
include_once('includes/header.php');

$errors = [];
if (isset($_POST['store_btn'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];

    if (empty($fullname) || empty($email) || empty($phone) || empty($date_of_birth)) {
        $errors[] = "Please fill all fields.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (count($errors) === 0) {
        $sql = "INSERT INTO `users`(`fullname`, `email`, `phone`, `date_of_birth`) VALUES (?, ?, ?, ?)";
        $stm = $pdo->prepare($sql);
        if ($stm->execute([$fullname, $email, $phone, $date_of_birth])) {
            header('Location: users.php');
        }
    }
}
?>

<div class="container w-25 my-5">
    <main class="form-signin w-100 m-auto">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <?php if (count($errors) > 0) : ?>
                <ul class="list-group m-3">
                    <?php foreach ($errors as $error) : ?>
                        <li class="text-danger"><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="John Smith">
                <label for="fullname">Fullname</label>
            </div>
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-2">
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="000-000-000">
                <label for="phone">Phone</label>
            </div>
            <div class="form-floating mb-2">
                <input type="date" class="form-control" name="date_of_birth" id="date_of_birth">
                <label for="date_of_birth">Date Of Birth</label>
            </div>
            <button class="btn btn-outline-dark" name="store_btn" type="submit">Submit</button>
        </form>
    </main>
</div>

<?php
include('includes/footer.php');
?>