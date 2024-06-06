<?php
session_start();

if (!isset($_SESSION['name'])) {
    echo "<script>alert('Please login first'); window.location.href='index.html';</script>";
}

include 'Database.php';
include 'User.php';

// Create an instance of the Database class and get the connection
$database = new Database();
$db = $database->getConnection();

// Create an instance of the User class
$user = new User($db);
$result = $user->getUsers();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div>
        <p class="ms-3"><?php echo "Hello " . $_SESSION['name'] . "!" ?></p>
    </div>

    <div class="d-flex justify-content-center align-items-center mt-3">
        <div class="card w-50">
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Matric</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        // Fetch each row from the result set
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["matric"]; ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["role"]; ?></td>
                                <td><a href="update_form.php?matric=<?php echo $row["matric"]; ?>"
                                        class="btn btn-primary d-flex justify-content-center">Update</a></td>
                                <td><a href="delete.php?matric=<?php echo $row["matric"]; ?>"
                                        class="btn btn-primary d-flex justify-content-center">Delete</a>
                                </td>

                            </tr>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='3'>No users found</td></tr>";
                    }
                    // Close connection
                    $db->close();
                    ?>
                </table>

            </div>
        </div>



    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>