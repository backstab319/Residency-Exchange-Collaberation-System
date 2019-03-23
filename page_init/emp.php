<div class="container text-center col-md-4 col-lg-4 mb-2">
        <h1 class="display-5">View Employees</h1>
        <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
        <tr>
        <th>Employee Name</th>
        <th>Employee Phone number</th>
        </tr>
        </thead>
        <?php
            $result;
            checkemployees();
            function checkemployees(){
                global $conn,$bus_name,$owner_name,$result;
                $sql = "SELECT * FROM recs_employees_details WHERE bus_name = '$bus_name' AND owner_name = '$owner_name'";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    displayemployees();
                }else{
                    echo "</table>You have not hired any employees yet!";
                }
            }
            function displayemployees(){
                global $result;
                while($row = $result->fetch_assoc()){
                    echo "<tr><td>".$row["emp_name"]."</td><td>".$row["emp_phone"]."</td></tr>";
                }
                echo "</table>";
            }
        ?>
    </div>

    <div class="container text-center form-group col-md-4 col-lg-4 mb-2">
        <h1 class="display-5">Add Employees</h1>
        <div class="form-group">
            <form method="POST" action="<?php $cpanel;?>">
            <input class="form-control mb-2" type="text" name="emp" placeholder="Employee Name">
            <input class="form-control mb-2" type="text" name="emp-phone" placeholder="Employee phone number">
            <input type="submit" value="Add" class="btn btn-outline-dark mb-2" name="add">
            </form>
        </div>
    </div>

    <div class="container text-center form-group col-md-4 col-lg-4 mb-2">
        <h1 class="display-5">Delete Employees</h1>
        <div class="form-group">
            <form method="POST" action="<?php $cpanel;?>">
            <label for="selectemp">Select Employee</label>
                    <select class="form-control mb-2" name="selectemp" id="selectemp">
                        <?php
                            selectemp();
                            function selectemp(){
                                global $conn,$bus_name,$owner_name,$result;
                                $sql = "SELECT emp_name FROM recs_employees_details WHERE bus_name = '$bus_name' AND owner_name = '$owner_name'";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    selectempdisplay();
                                }else{
                                    dispemperror();
                                }
                            }
                            function selectempdisplay(){
                                global $result;
                                while($row = $result->fetch_assoc()){
                                    echo "<option value='".$row['emp_name']."'>".$row['emp_name']."</option>";
                                }
                            }
                        ?>
                    </select>
                    <?php
                        function dispemperror(){
                            echo "There are no employees to delete.";
                        }
                    ?>
            <input type="submit" value="Delete" class="btn btn-outline-dark mb-2" name="delete">
            </form>
        </div>
    </div>

    <div class="container text-center form-group col-md-4 col-lg-4 mb-2">
        <h1 class="display-5">Edit employee data</h1>
        <div class="form-group">
        <form method="POST" action="<?php $cpanel;?>">
            <select class="form-control mb-2" name="change">
                <option value="emp_name">Employee name</option>
                <option value="emp_phone">Employee phone</option>
            </select>
            <input class="form-control mb-2" type="text" name="data" placeholder="Data to be edited">
            <input class="form-control mb-2" type="text" name="replace" placeholder="Data to be edited to">
            <input type="submit" value="Change" class="btn btn-outline-dark mb-2" name="edit">
            </form>
        </div>
    </div>