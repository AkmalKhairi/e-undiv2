<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <script type="text/javascript">
                    var onloadCallback = function() {
                        grecaptcha.render('html_element', {
                            'sitekey' : '6LeLeuEbAAAAAI6nJayhyVYG7t6sk3fMxGVlWWYZ'
                        });
                    };
                </script>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Admin Registration</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="admin_add.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                        <div class="col-sm-9">
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="firstname" name="firstname" onkeypress="return onlyAlphabetKey(event)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                        <div class="col-sm-9">
                            <input style="text-transform: uppercase;" type="text" class="form-control" id="lastname" name="lastname" onkeypress="return onlyAlphabetKey(event)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nric" class="col-sm-3 control-label">NRIC</label>

                        <div class="col-sm-9">
                            <input placeholder="987654321011" minlength="12" maxlength="12" type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="admin_id" name="admin_id" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-3 control-label">Phone Number</label>

                        <div class="col-sm-9">
                            <input placeholder="0123456789" minlength="10" maxlength="12" type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>

                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" required>
                        </div>

                        <div class="col-sm-9" id="html_element"></div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="add"><i class="fa fa-check"></i> Register</button>
                </form>
                <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
                        async defer>
                </script>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Edit Admin</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="voters_edit.php">
                    <input type="hidden" class="id" name="id">
                    <div class="form-group">
                        <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_firstname" name="firstname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_lastname" name="lastname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_password" class="col-sm-3 control-label">Password</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="edit_password" name="password">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="voters_delete.php">
                    <input type="hidden" class="id" name="id">
                    <div class="text-center">
                        <p>DELETE</p>
                        <h2 class="bold fullname"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="voters_photo.php" enctype="multipart/form-data">
                    <input type="hidden" class="id" name="id">
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>

                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Description -->
<div class="modal fade" id="platform">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="title"></span></b></h4>
            </div>
            <div class="modal-body">
                <?php
                $userid = 0;
                if(isset($_POST['id'])){
                    $userid = mysqli_real_escape_string($conn,$_POST['id']);
                }
                $sql = "SELECT *, candidates.photo AS cantho , candidates.firstname AS canfirst, candidates.lastname AS canlast FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id WHERE id='.$userid' ORDER BY positions.priority ASC";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc()){
                    $image = (!empty($row['cantho'])) ? '../images/'.$row['cantho'] : '../images/profile.jpg';
                    echo "
                <div class='row votelist'>
                    <span style='padding-left: 50px;' class='col-sm-4'> <img src='".$image."' width='100px' height='100px'> </span>
                    <span style='padding-left: 70px; font-size: 30px;' class='col-sm-8'><b>".$row['canfirst']." ".$row['canlast']."</b></span>
                </div>
                ";
                }
                ?>
            </div>
            <div class="modal-footer">
<!--                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
-->            </div>
        </div>
    </div>
</div>

<!-- RESULT -->
<div class="modal fade" id="result">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="title"></span></b></h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <table id="example1" class="table table-bordered">
                        <!--<thead>
                        <th style="text-align: center;">Voting Title</th>
                        <th style="text-align: center;">Candidates</th>
                        <th style="text-align: center;">Result</th>
                        </thead>-->
                        <tbody>
                        <?php
                        $sql = "SELECT * FROM positions ORDER BY priority ASC";
                        $query = $conn->query($sql);
                        while($row = $query->fetch_assoc()){
                            $id = $row['id'];
                            echo "
        		<tr>
        			<td colspan='2' align='center' style='font-size:15px;'><b>".$row['description']."</b></td>
        		</tr>
        		<tr>
        			<th width='80%'><b>Candidates</b></th>
        			<th width='20%'><b>Votes</b></th>
        		</tr>
        	";

                            $sql = "SELECT * FROM candidates WHERE position_id = '$id' ORDER BY firstname ASC";
                            $cquery = $conn->query($sql);
                            while($crow = $cquery->fetch_assoc()){
                                $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
                                $vquery = $conn->query($sql);
                                $votes = $vquery->num_rows;

                                echo"
      				<tr>
      					<td>".$crow['lastname'].", ".$crow['firstname']."</td>
      					<td>".$votes."</td>
      				</tr>
      			";

                            }

                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!--                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                -->            </div>
        </div>
    </div>
</div>


<script>
    function onlyNumberKey(evt) {

        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    function onlyAlphabetKey(alp){
        return (event.charCode > 64 &&
            event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)
    }
</script>



