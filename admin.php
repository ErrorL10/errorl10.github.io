<?php
    include 'dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.css"/>
    <title>Yukidesu Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="admin.css">


</head>

<body>
    <div class="container">
        <div class="navContainer">
            <div class="navbar">
                <h1>Yukidesu Admin Panel</h1>
                <ul>
                    <li ><a href="admin.php">Reservations</a></li>
                    <li><a href="admin_users.php">Staff</a></li>
                </ul>
        </div>
    </div>

    <h1 class="header">Reservations</h1>

    <div class="table_container">
        <table table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                <th scope="col"><div class="table-header" ><p>ID</p></div></th>
                <th scope="col"><div class="table-header" ><p> Name</p></div></th>
                <th scope="col"><div class="table-header" ><p> </p>Table For</div></th>
                <th scope="col"><div class="table-header" ><p> </p>Reservation Date</div></th>
                <th scope="col"><div class="table-header" ><p>Reservation Time</p></div></th>
                <th scope="col"><div class="table-header" ><p>Contact Number</p></div></th>
                <th scope="col"><div class="table-header" ><p> Update</p></div></th>
                <th scope="col"><div class="table-header" ><p> Delete</p></div></th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $sql="SELECT * FROM reservations";
                    $stmt=$con->prepare($sql);
                    $stmt->execute();
                    $result=$stmt->get_result();
                    while($row=$result->fetch_assoc()){
                ?>
                <tr>
                <td><?php echo $row['reservation_id']; ?></td>
                <td><?php echo $row['full_name']; ?></td>
                <td><?php echo $row['table_for']; ?></td>
                <td><?php echo $row['reservation_date']; ?></td>
                <td><?php echo $row['reservation_time']; ?></td>
                <td><?php echo $row['contact_no']; ?></td>

                <td>
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#updatemodal-<?php echo $row['reservation_id']; ?>">Update</button>
                    </div>
                    
                </td>
                <td>
                    <div style="display: flex; align-items: center; justify-content: center;">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletemodal-<?php echo $row['reservation_id']; ?>">Delete</button>
                    </div>
                    
                </td>
                </tr>

                <!-- Update Modal -->
                <div class="modal fade" id="updatemodal-<?php echo $row['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                
                    <form action="controller_reservation.php" method="POST">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['reservation_id']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Fullname:</label>
                                        <input type="text" class="form-control" value="<?php echo $row['full_name']; ?>" id="name" name="name">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="table-select">Table for (Persons)</label>
                                        <select name="table-select" value="<?php echo $row['table_for']; ?>" id="table-select"> 
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="4">4</option>
                                            <option value="8">8</option>
                                            <option value="16">16</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="date">Reservation Date</label>
                                        <input type="date" value="<?php echo $row['reservation_date']; ?>" id="date" name="date">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="time">Reservation Time</label> 
                                        <input type="time" value="<?php echo $row['reservation_time']; ?>" id="time" name="time">
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="contact">Contact No.</label>
                                        <input type="number" value="<?php echo $row['contact_no']; ?>" id="contact" name="contact">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="hidden" class="form-control" value="<?php echo $row['reservation_id']; ?>" id="id" name="id">
                                <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deletemodal-<?php echo $row['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <form action="controller_reservation.php" method="POST">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['reservation_id']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <div class="modal-body">
                            <h4> Do you want to delete this data?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <input type="hidden" class="form-control" value="<?php echo $row['reservation_id']; ?>" id="id" name="id">
                                <button type="submit" name="delete" class="btn btn-primary">Continue</button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <?php } ?>
            </tbody>
        </table>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function(){
            $('#example').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
        </script>


    <footer id="contact">
        <h1 class="header">Contact Us</h1>
        <div class="contact-details">
            <details>
                <summary>Tarlac City, Tarlac</summary>
                 <ul>
                     <li>Contact no: 09091236789</li>
                    <li>Email: yukidesuTCT@gmail.com</li>
                </ul>
             </details>
             <details>
                <summary>Capas, Tarlac</summary>
                <ul>
                    <li>Contact no: 09097891234</li>
                    <li>Email: yukidesuCT@gmail.com</li>
                </ul>
            </details>
            <details>
                <summary>Gerona, Tarlac</summary>
                <ul>
                    <li>Contact no: 09153456969</li>
                    <li>Email: yukidesuGT@gmail.com</li>
                </ul>
            </details>
            <details>
                <summary>Mabalacat, Pampanga</summary>
                <ul>
                    <li>Contact no: 09694201234</li>
                    <li>Email: yukidesuMP@gmail.com</li>
                </ul>
            </details>
            <details>
                <summary>Meycauayan, Bulacan</summary>
                <ul>
                    <li>Contact no: 09421352468</li>
                    <li>Email: yukidesuMB@gmail.com</li>
                </ul>
            </details>
        </div>
        <p>© 2023 Yukidesu - All Rights Reserved. || Designed by: Errol</p>
    </footer>
    
</body>
</html>