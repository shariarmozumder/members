<?php
include"header.php";
?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                        <!-- Pie Chart -->
                        <div class="row">
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Submit Request Under LAP</h6>
                                    </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <?php 
                                  if(isset($_POST['request'])) {
    // Escape user input to prevent SQL injection
    $demand = mysqli_real_escape_string($conn, $_POST['demand']);
    // Prepare SQL statement
    $check_sql = "SELECT * FROM request WHERE scid='$user_id' and status='Pending'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // Request already exists for this user
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><i class="fas fa-info-circle"></i>
                    A request has already been submitted. Please check <a href="tracking.php">Tracking..</a>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        } else {
        $sql = "INSERT INTO request (scid, apply_for, demand, remarks, year, status)
                    VALUES ('$user_id', 'IDP', '$demand', 'Waiting for visit','$year', 'Pending')";

            if (mysqli_query($conn, $sql)) {
              $last_id = mysqli_insert_id($conn);
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i> Request added successfully. Track this Request <a href="tracking.php">Tracking..</a>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error: ' . $sql . '<br>' . mysqli_error($conn) . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
    }

    mysqli_close($conn);
}
}
?>
                     <form class="user" method="post">
                                         <div class="form-group">
<label for="cars">Select Demand:</label>
<select class="form-control" name="demand" >
  <optgroup label="Electronic Devices:">
    <option value="Android LED TV">Android LED TV</option>
    <option value="Simple LED TV">Simple LED TV</option>
    <option value="Projector for Lab">Projector for Lab</option>
    <option value="Computer with LED">Computer with LED</option>
    <option value="Printer for Office">Printer for Office</option>
    <option value="Loud Speaker System">Loud Speaker System</option>
  </optgroup>
  <optgroup label="Reference Materials:">
    <option value="Talet for Teachers">Talet for Teachers</option>
   <option value="Charts For Class">Charts For Class</option>
      <option value="Activity Material">Activity Material</option>
   <option value="PlayGroup Classroom Kit">PlayGroup Classroom Kit</option>
      <option value="USB with Soft Data for Class">USB with Soft Data for Class</option>
  </optgroup>
</select>
                                        </div>
                                        <div class="form-group">
                                        <label for="cars">Expected Ammount</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputPassword" name="eamount" autofocus required>
                                        </div>
                                         <div class="form-group">
                                         <label for="cars">Contact Number:</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputPassword" value="<?php echo $contact;?>" readonly>
                                        </div>
                                         <div class="form-group">
                                         <label for="cars">Your District:</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputPassword" value="<?php echo $dist;?>" readonly>
                                        </div>
                                         <div class="form-group">
                                         <label for="cars">Your CNIC:</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputPassword" value="<?php echo $cnic?>" readonly>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" name="request" value="Submit Request">
                                        </a>
                                </div>
                            </div>
          </div>

                    
                                        

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                          <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">TORs of LAP</h6>
                        </div>
                        <div class="card-body">
                     <p> <B> Yor are applying under Learning Aids Program for <u><?php echo $school;?></u> situated at <u><?php echo $address;?></u></b></p>
                          <h6 class="m-0 font-weight-bold text-primary">Eligibility Criteria:</h6>
The school must be a registered educational institution and have a proven track record of
providing quality education to its students. The school must PEF Partner from 3 years and has PASS
status of 2 QATs conducted by Punjab Education Foundation.
<br><br>
<h6 class="m-0 font-weight-bold text-primary">Needs Assessment:</h6>
The school must undergo a needs assessment to determine the learning Aids Program required.
This assessment will be conducted by district coordinator of TEI in consultation with the school's
management.
<br><br>
<h6 class="m-0 font-weight-bold text-primary">Utilizing Plan:</h6>
The school must have a clear plan on how they will utilize the learning aids to improve the learning
experience of their students.
<br><br>
<h6 class="m-0 font-weight-bold text-primary">Funding Approval:</h6>
TEI Core committee will review the request and, if approved, will provide required learning aids
to the school to promote quality education.<br><br>
<h6 class="m-0 font-weight-bold text-primary">Monitoring and Evaluation:</h6>
TEI may conduct evaluation visits to ensure that the Learning Aids are progressing as planned
and that the funds are being used effectively.<br><br>
 <a href="Details-of-LAP.pdf" target="_blank" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-tv"></i>
                                        </span>
                                        <span class="text">Dwnload Budget Document</span>
                                    </a>
                                </div>
                               </div>
                            </div>
                                                </div>
                                                              
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
<?php include"footer.php"; ?>