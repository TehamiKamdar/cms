<?php
  include("partials/dbconnect.php");

  // Query to fetch data from the specialization table
  $query = "SELECT `specialization_id`,`specialization` FROM `specialization`";
  $result = mysqli_query($conn, $query);

  if (isset($_POST["btn"])) {

    $filename = $_FILES["image"]["name"];
    $filepath = $_FILES["image"]["full_path"];
    $filetype = $_FILES["image"]["type"];
    $filesize = $_FILES["image"]["size"];
    $filedata = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $specialization = $_POST["specialization"];

    $q = "INSERT INTO `doctors`(`doctor_name`, `doctor_email`, `d_o_b`, `gender`, `specialization_id`, `image_name`, `mime_type`, `data`) VALUES(CONCAT('$fname',' ','$lname'),'$email','$dob','$gender','$specialization','$filename','$filetype','$filedata')";

    $r = mysqli_query($conn, $q);

    if ($r) {
      echo "<script>alert('Doctor Registered')</script>";
      header("location: doctorsfetch.php");
    }

  }


?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Doctor Registration Form</h3>
              <form action="./doctoradd.php" method="post" enctype="multipart/form-data">

                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div data-mdb-input-init class="form-outline">
                      <input type="text" id="firstName" name="fname" class="form-control form-control-lg" />
                      <label class="form-label" for="firstName">First Name</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <div data-mdb-input-init class="form-outline">
                      <input type="text" id="lastName" name="lname" class="form-control form-control-lg" />
                      <label class="form-label" for="lastName">Last Name</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div data-mdb-input-init class="form-outline datepicker w-100">
                      <input type="date" name="dob" class="form-control form-control-lg" id="birthdayDate" />
                      <label for="birthdayDate" class="form-label">Date of Birth</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <h6 class="mb-2 pb-1">Gender: </h6>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="gender" type="radio" id="femaleGender"
                        value="Female" checked />
                      <label class="form-check-label" for="femaleGender">Female</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" name="gender" type="radio" id="maleGender"
                        value="Male" />
                      <label class="form-check-label" for="maleGender">Male</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div data-mdb-input-init class="form-outline">
                      <input type="email" id="emailAddress" name="email" class="form-control form-control-lg" />
                      <label class="form-label" for="emailAddress">Email</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div data-mdb-input-init class="form-outline">
                      <input type="tel" id="phoneNumber" name="phone" class="form-control form-control-lg" />
                      <label class="form-label" for="phoneNumber">Phone Number</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-12">

                    <?php
                    if ($result) {
                      // Start HTML select element
                      echo '<select class="select form-control-lg" name="specialization">';
                      
                      // Iterate over fetched rows and generate option elements
                      while ($row = mysqli_fetch_assoc($result)) {
                          $specializationId = $row['specialization_id'];
                          $specializationValue = $row['specialization'];
                          
                          // Output option element
                          echo '<option value="' . $specializationId . '">' . $specializationValue . '</option>';
                      }
                      
                      // Close HTML select element
                      echo '</select>';
                  } else {
                      // Handle query error
                      echo "Error fetching data from database: " . mysqli_error($conn);
                  }
                  
                  // Close database connection
                  mysqli_close($conn);
                  ?>
                    
                    <label class="form-label select-label">Specialization</label>

                  </div>
                </div>

                  <div class="row">
                    <div class="col-12 mt-4">
                      <input type="file" class="btn btn-secondary form-control-lg" name="image" id="">
                    </div>
                  </div>

                <div class="mt-4 pt-2">
                  <input data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg" name="btn" type="submit"
                    value="Submit" />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
</body>

</html>