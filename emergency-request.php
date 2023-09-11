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
                                    <h6 class="m-0 font-weight-bold text-primary">Submit Emergency Request</h6>
                                    </div>
                                <!-- Card Body -->
                                <div class="card-body">
                              <?php 
                                  if(isset($_POST['request'])) {
    // Escape user input to prevent SQL injection
    $demand = mysqli_real_escape_string($conn, $_POST['emergency']);
    $ecost = mysqli_real_escape_string($conn, $_POST['ecost']);
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
        $sql = "INSERT INTO request (scid, apply_for, demand, expected_amount, remarks, year, month, status)
                    VALUES ('$user_id', 'Emergency', '$demand', '$ecost', 'Waiting for visit','$year', '$month', 'Pending')";

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
<label for="cars">Select Emergency:</label>
<select class="form-control" name="emergency" >
    <option value="Flood Efected">Flood Efected</option>
    <option value="Earthquake Efected">Earthquake Efected</option>
    <option value="Heavy Rain">Heavy Rain</option>
</select>
                                        </div>
                                        <div class="form-group">
                                        <label for="cars">Estimated Cost</label>
                                            <input type="number" class="form-control form-control-user"
                                                id="exampleInputPassword" name="ecost" autofocus required>
                                        </div>
                                         <div class="form-group">
                                         <label for="cars">Your District:</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputPassword" value="<?php echo $dist;?>" readonly>
                                        </div>
                                        <div class="form-group">
                                         <label for="cars">Contact Number:</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputPassword" value="<?php echo $contact;?>" readonly>
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
                            <h6 class="m-0 font-weight-bold text-primary">TORs of Emergency Fund</h6>
                        </div>
                        <div class="card-body">
                     <p> <B> Yor are applying under Emergency Fund for <u><?php echo $school;?></u> situated at <u><?php echo $address;?></u></b></p>
                          <h6 class="m-0 font-weight-bold text-primary">Eligibility Criteria:</h6>
The school must be a registered educational institution and have a proven track record of
providing quality education to its students. The school must PEF Partner from 3 years and has PASS
status of 2 QATs conducted by Punjab Education Foundation. Last QAT failure schools are eligible for emergency fund program.
<br><br>
<h6 class="m-0 font-weight-bold text-primary">Application Process:</h6>
The school must submit an online application to TEI, which should include the following information:<br><br>
1. Details of the emergency situation that has affected the school.<br>
2. A detailed plan on how the funds will be utilized to support the recovery of the school.<br>
3. The expected impact of the funds on the school and its students.<br>
4. Contact information of the school and the person responsible for managing the funds
<br><br>
<h6 class="m-0 font-weight-bold text-primary">Needs Assessment:</h6>
Our team will conduct an assessment of the school's needs to determine the amount of funds
required to support the recovery efforts. The needs assessment will take into consideration the
following factors:<br><br>
1. The extent of damage caused by the emergency situation.<br>
2. The number of students affected by the emergency situation.<br>
3. The resources available to the school to support the recovery efforts.
<br><br>
<h6 class="m-0 font-weight-bold text-primary">Funding Approval:</h6>
TEI Core committee will review the request and, if approved, will provide required funds to the school to promote quality education.<br><br>
<h6 class="m-0 font-weight-bold text-primary">Monitoring and Evaluation:</h6>
Our team will conduct periodic monitoring visits to the school to ensure that the funds are being
utilized effectively and efficiently.<br><br>
 <a href="emergency-fund.pdf" target="_blank" class="btn btn-primary btn-icon-split">
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