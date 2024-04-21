<?php
require('includes/database.php');
include_once('includes/header.php');
include('helpers/countAge.php');


$totalItems = $pdo->query("SELECT COUNT(*) FROM `users`")->fetchColumn();
$itemsPerPage = 10;
$numPages = ceil($totalItems / $itemsPerPage);

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($currentPage - 1) * $itemsPerPage;

$users = [];
$sql = "SELECT * FROM `users` LIMIT $offset, $itemsPerPage";
$stm = $pdo->prepare($sql);
$stm->execute();
$users = $stm->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="table-responsive container">
    <table class="table table-hover table-striped tm-table-striped-even mt-3 text-nowrap">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fullname</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Birth</th>
                <th scope="col">Age</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($users as $user) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $user['fullname'] ?></td>
                    <td><a href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= $user['date_of_birth'] ?></td>
                    <td><?= countAge($user['date_of_birth']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<nav aria-label="Page navigation example" class="container">
    <ul class="pagination">
        <li class="page-item"><a class="page-link text-dark" href="?page=<?= ($currentPage > 1) ? $currentPage - 1 : $currentPage ?>">Previous</a></li>
        <?php for ($i = 1; $i <= $numPages; $i++) : ?>
            <li class="page-item"><a class="page-link text-dark" href="?page=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor; ?>
        <li class="page-item"><a class="page-link text-dark" href="?page=<?= ($currentPage < $numPages) ? $currentPage + 1 : $currentPage ?>">Next</a></li>
    </ul>
</nav>

<?php
include('includes/footer.php');
?>