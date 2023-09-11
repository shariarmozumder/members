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
                                    <h6 class="m-0 font-weight-bold text-primary">Submit Request Under IDP</h6>
                                    </div>
                                <!-- Card Body -->
                                <div class="card-body">
                              <?php 
if(isset($_POST['request'])) {
    // Escape user input to prevent SQL injection
    $demand = mysqli_real_escape_string($conn, $_POST['demand']);
    $ecost = mysqli_real_escape_string($conn, $_POST['ecost']);
    $qat = mysqli_real_escape_string($conn, $_POST['qat']);
    
    // Check if QAT status is Fail
    if($qat === 'Fail') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-triangle"></i>
                You are not eligible to apply under IDP Program. Please read <a href="infra-tors.php">TORs of IDP </a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    } else {
        // Check if request already exists for this user
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
            // Prepare SQL statement
            $sql = "INSERT INTO request (scid, apply_for, demand, expected_amount, remarks, year, qat_status, status)
                    VALUES ('$user_id', 'IDP', '$demand', '$ecost', 'Waiting for visit','$year', '$qat', 'Pending')";

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
        }
    }

    mysqli_close($conn);
}
?>
                     <form class="user" method="post">
                                         <div class="form-group">
<label for="cars">Select Project:</label>
<select class="form-control" name="demand" >
  <optgroup label="Repairning Project:">
    <option value="Repairing of Wall">Repairing of Wall</option>
    <option value="Repairing of Toilet">Repairing of Toilet</option>
    <option value="Repairing of Room">Repairing of Room</option>
    <option value="Repairing of Floor">Repairing of Floor</option>
    <option value="Repairing of Roof">Repairing of Roof</option>
    <option value="Playster Required">Playster Required</option>
  </optgroup>
  <optgroup label="New Construction:">
    <option value="New Room">New Room</option>
   <option value="New Toilet">New Toilet</option>
      <option value="New Wall">New Wall</option>
   <option value="Roof of Room">Roof of Room</option>
   <optgroup label="Furniture & Renovation:">
   <option value="Renovation of Room">Renovation of Room</option>
   <option value="Renovation of School">Renovation of School</option>
   <option value="Furniture for Class">Furniture for Class</option>
   <optgroup label="Sanitation and Hygiene:">
   <option value="Water Filter">Water Filter</option>
   <option value="Dangue Spray">Dangue Spray</option>
  </optgroup>
</select>
                                        </div>
                                        <div class="form-group">
                                        <label for="cars">Estimated Cost</label>
                                            <input type="number" class="form-control form-control-user"
                                                id="exampleInputPassword" name="ecost" autofocus required>
                                        </div>
                                         <div class="form-group">
                                        <label for="cars">Last QAT Status:</label>
<select class="form-control" name="qat" >
    <option value="Fail">Fail</option>
    <option value="Pass">Pass</option>
    <option value="Non PEF">Non PEF</option>
  </select>
                                        </div>
                                         <div class="form-group">
                                         <label for="cars">Your District:</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputPassword" value="<?php echo $dist;?>" readonly>
                                        </div>
                                        <div class="form-group">
                                         <label for="cars">Your Contact:</label>
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
                            <h6 class="m-0 font-weight-bold text-primary">TORs of IDP</h6>
                        </div>
                        <div class="card-body">
                     <p> <B> Yor are applying under Infra Development Program for <u><?php echo $school;?></u> situated at <u><?php echo $address;?></u></b></p>
                          <h6 class="m-0 font-weight-bold text-primary">Eligibility Criteria:</h6>
The school must be a registered educational institution and have a proven track record of providing
quality education to its students. The school must be in economical crises or have been affected by a natural
disaster. School must be PEF partner from 3 years and has PASS status of last QAT conducted by PEF.
<br><br>
<h6 class="m-0 font-weight-bold text-primary">Needs Assessment:</h6>
The school must undergo a needs assessment to determine the infrastructure development projects
required. This assessment will be conducted by district coordinator of TEI in consultation with the school's
management
<br><br>
<h6 class="m-0 font-weight-bold text-primary">Project Proposal:</h6>
Based on the needs assessment, the school must prepare a detailed project proposal that outlines the
infrastructure development project(s) required, including estimated costs, timelines, and any other relevant
information.
<br><br>
<h6 class="m-0 font-weight-bold text-primary">Funding Approval:</h6>
TEI Core committee will review the project proposal and, if approved, will provide funding (by online
transaction) to the school to undertake the infrastructure development project.<br><br>
<h6 class="m-0 font-weight-bold text-primary">Technical Support:</h6>
TEI will provide technical support and guidance to the school throughout the project, including advice
on building codes and regulations, guidance on selecting materials and suppliers, and project management
assistance to ensure that projects are completed on time and within budget.<br><br>
<h6 class="m-0 font-weight-bold text-primary">Monitoring and Evaluation:</h6>
TEI may conduct evaluation visits to ensure that the infrastructure development project is progressing
as planned and that the funds are being used effectively.<br><br>
 <a href="Details-of-IDP.pdf" target="_blank" class="btn btn-primary btn-icon-split">
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