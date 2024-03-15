<?php
session_start();
include("connection.php");
$page = "post_slider";
?>
<?php require("top.php"); ?>
<title>Add Slider /</title>
<div class="container-fluid position-relative d-flex p-0">
    <?php
    include("sidebar.php");
    ?>
    <!-- Content Start -->
    <div class="content">
        <?php
        include("navbar.php");
        ?>
        <div class="container p-md-5">
            <div class="row m-0 bg-green ">
                <div class="col-md-12">
                    <div class=" p-md-5">
                        <h2 class="mb-2">Add Slider on website</h2>
                        <a href="add_slider_slide.php" class="btn btn-white my-2 ">Add Slide</a>
                        <div class="overflow">
                            <table class="table text-white table-bordered border-white text-center">
                                <thead>
                                    <tr class="table_row bg-white border border-success">
                                        <th class="green">ID</th>
                                        <th class="green">Slider Heading</th>
                                        <th class="green">Slider Massage</th>
                                        <th class="green">Status</th>
                                        <th class="green">Edit Details</th>
                                        <th class="green">Drop Slides</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $insert_query = "SELECT * FROM tbl_slider";
                                    $check_result = mysqli_query($connection, $insert_query);
                                    foreach ($check_result as $row) {
                                        echo "<tr class='table_row'>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['heading'] . "</td>";
                                        echo "<td>" . $row['para'] . "</td>";
                                        echo "<td>";
                                        if ($row['status'] == 'show') {
                                            echo "<a href='hide_slider_slide.php?id=" . $row['id'] . "' class='btn btn-danger'>Hide</a>";
                                        } else {
                                            echo "<a href='show_slider_slide.php?id=" . $row['id'] . "' class='btn btn-success'>Show</a>";
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<a href='edit_slider_slide.php?id=" . $row['id'] . "' class='btn btn-success'>Edit Slide</a>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<a href='delete_slider_slide.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return delete_slider_slide()'>Delete Slide</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->
</div>
<?php require("bottom.php") ?>
