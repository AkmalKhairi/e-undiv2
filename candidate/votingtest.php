<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Voters</li>
            </ol>
        </section>

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Election List
                </h1>

            </section>
            <!-- Main content -->
            <section class="content">
                <?php
                if(isset($_SESSION['error'])){
                    echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
                    unset($_SESSION['error']);
                }
                if(isset($_SESSION['success'])){
                    echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
                    unset($_SESSION['success']);
                }
                ?>
                <div class="row">
<!--                    <div class="box-header with-border">
                        <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat pull-right "><i class="fa fa-plus"></i> New</a>
                    </div>-->
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                    <th style="text-align: center;">Voting Title</th>
                                    <th style="text-align: center;">Tools</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT description FROM positions";
                                    $query = $conn->query($sql);
                                    while($row = $query->fetch_assoc()){
                                        echo "
                        <tr>
                          <td style='text-transform: uppercase; padding-left: 100px;'>".$row['description']."</td>
                          <td>
                            <button style=' border-radius: 15px; width: 70%; font-size: 20px;' class=' btn btn-success btn-sm voting btn-flat' data-id='".$row['description']."'><i class='fa fa-check-square'></i> Join </button>

                          </td>
                        </tr>
                      ";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/voters_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
    $(function(){
        <!-- Edit button Function -->
        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            $('#edit').modal('show');
            var id = $(this).data('id');
            getRow(id);
        });
        <!-- Delete button Function -->

        $(document).on('click', '.addnew', function(e){
            e.preventDefault();
            $('#addnew').modal('show');
            var description = $(this).data('description');
            getRow(description);
        });
        <!-- Approve button Function -->

        $(document).on('click', '.voting', function(e){
            e.preventDefault();
            $('#voting').modal('show');
            var description = $(this).data('description');
            getRow(description);
        });

        $(document).on('click', '.photo', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            getRow(id);
        });

        var addNumeration = function(cl){
            var table = document.querySelector('table.' + cl)
            var trs = table.querySelectorAll('tr')
            var counter = 1

            Array.prototype.forEach.call(trs, function(x,i){
                var firstChild = x.children[0]
                if (firstChild.tagName === 'TD') {
                    var cell = document.createElement('td')
                    cell.textContent = counter ++
                    x.insertBefore(cell,firstChild)
                } else {
                    firstChild.setAttribute('colspan',2)
                }
            })
        }

        addNumeration("table")


    });

    function getRow(id){
        $.ajax({
            type: 'POST',
            url: 'voters_row.php',
            data: {id:id},
            dataType: 'json',
            success: function(response){
                $('.id').val(response.id);
                $('#edit_firstname').val(response.firstname);
                $('#edit_lastname').val(response.lastname);
                $('#edit_password').val(response.password);
                $('.fullname').html(response.firstname+' '+response.lastname);
                $('.description').val(response.description);
            }
        });
    }

</script>
</body>
</html>
