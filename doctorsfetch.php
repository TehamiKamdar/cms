<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <div class="container mt-5">
            <h2>Doctors List</h2>
            <div class="row">
                <?php
                    include("partials/dbconnect.php");
                    $sql = "SELECT * FROM doctors INNER JOIN `specialization` ON `doctors`.`specialization_id` = `specialization`.`specialization_id`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data in Bootstrap cards
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="data:<?php echo $row['mime_type']; ?>;base64,<?php echo base64_encode($row['data']); ?>" class="card-img-top" alt="Doctor Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['doctor_name']; ?></h5>
                                <p class="card-text">Email: <?php echo $row['doctor_email']; ?></p>
                                <p class="card-text">DOB: <?php echo $row['d_o_b']; ?></p>
                                <p class="card-text">Gender: <?php echo $row['gender']; ?></p>
                                <p class="card-text">Specialization: <?php echo $row['specialization']; ?></p>
                                <button class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No doctors found.";
            }

            $conn->close();
                ?>
            </div>
        </div>


        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
