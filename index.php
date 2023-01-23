<!DOCTYPE html>
<html>
<title> pie-chart </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
    <div class="w3-sidebar w3-bar-block w3-light-grey w3-card" style="width:150px">
        <h5 class="w3-bar-item">Admin Panel</h5>
        <button class="w3-bar-item tablink" onclick="opendata(event, 'revenue')"> Revenue </button>
        <button class="w3-bar-item tablink" onclick="opendata(event, 'department')"> Department </button>
        <button class="w3-bar-item tablink" onclick="opendata(event, 'empdep')"> Employee Detail </button>
    </div>
    <div style="margin-left:150px">
        <br>
        <!-- pie-chart -->
        <div id="revenue" class="w3-container data">
            <div class="text-center">
                <from>From:</from>
                <input type="date" id="fromdate" name="fromdate" />
                <from>To:</from>
                <input type="date" id="todate" name="todate" />
                <button id="search" class="btn-danger">Search</button>

                <div id="piechart" style="width: 900px; height: 500px;"></div>
                <div id="piechart1" style="width: 900px; height: 500px;"></div>

                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $.ajax({
                            url: 'allpiechart.php',
                            type: 'POST',
                            dataType: 'json',
                            success: function(data) {
                                google.charts.load('current', {
                                    'packages': ['corechart']
                                });
                                google.charts.setOnLoadCallback(function() {
                                    drawPieChart(data);
                                });
                            }
                        });

                        function drawPieChart(data) {
                            var dataArray = [];
                            $.each(data, function(key, value) {
                                dataArray.push([key, parseInt(value)]);
                            });
                            var data = new google.visualization.arrayToDataTable(dataArray, true);

                            var options = {
                                title: 'Different Departments Revenue',
                                'width': 800,
                                'height': 500

                            };
                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                            chart.draw(data, options);
                        }
                        $("#search").click(function() {
                            google.charts.load('current', {
                                'packages': ['corechart']
                            });
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Department Name');
                                data.addColumn('number', 'Revenue');
                                $.ajax({
                                    url: 'pieconfig.php',
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data: {
                                        fromdate: $('#fromdate').val(),
                                        todate: $('#todate').val()
                                    },
                                    success: function(response) {
                                        for (var i in response) {
                                            data.addRow([response[i].dname, parseInt(response[i].revenue)]);
                                        }
                                        var options = {
                                            'title': 'Different Departments Revenue',
                                            'width': 800,
                                            'height': 500
                                        };
                                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                        chart.draw(data, options);
                                    }
                                });
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <!-- department -->
        <div id="department" class="w3-container data" style="display:none">
            <div class="row">
                <div class="col-10"></div>
                <div class="col-2">
                    <button class="btn-info m-1" data-toggle="modal" data-target="#newdep">
                        <i class="fa fa-plus"></i> New Department</button>
                </div>
            </div>
            <br>
            <table class="table table-bordered table-striped active" id="department">
                <thead class="text align-center">
                    <tr>
                        <th>Department </th>
                        <th>Revenue </th>
                        <th>Total employees </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="dep">
                </tbody>
            </table>
        </div>
        <!-- employee -->
        <div id="empdep" class="w3-container data" style="display:none">
            <select class="center m-3" id="departmentt">
                <option value="">select by department </option>
            </select>
            <tr>
                <td>
                    <input type="text" id="myInput" placeholder="search by name" />
                </td>
            </tr>
            <td>
                <input type="submit" id="viewall" value="View All" />
            </td>
            <button class="btn btn-info btn-lg float-right" data-toggle="modal" data-target="#newemp">
                <i class="fa fa-plus"></i> Add New Employee</button>
            <br>
            <table class="table table-bordered table-striped active" id="employee">
                <thead class="text align-center">
                    <tr> </tr>
                </thead>
                <tbody id="emp">
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="newdep">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Department </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td> Department Id: </td>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="depid" placeholder="Enter id " />
                            </td>
                            <td id="id_error"></td>
                        </tr>
                        <tr>
                            <td> Department Name </td>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="dname" placeholder="Enter Department" />
                            </td>
                            <td id="name_error"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="savedep"> Save </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <form id="employee"> -->
    <form id="validateForm">
        <div class="modal" tabindex="-1" role="dialog" id="newemp">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Employee </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td> empid </td>
                                <td>
                                    <input type="text" class="form-control" id="empid" name="empid" placeholder="Enter empid" /><br>
                                </td>
                            </tr>
                            <tr>
                                <td> Name </td>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="empname" name="empname" placeholder="Enter Your Name" /><br>
                                </td>
                            </tr>
                            <tr>
                                <td> Address </td>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="empadd" name="empadd" placeholder="Enter Your Address" /><br>
                                </td>
                            </tr>
                            <tr>
                                <td> Department </td>
                                <td>
                                    <?php
                                    $conn = mysqli_connect('localhost', 'root', '', 'piechart');
                                    $qry = "select * from dep";
                                    $res = mysqli_query($conn, $qry);
                                    echo "<select class='form-control' id='departments' name='departments'>";
                                    echo "<option value=''>Select Your Department </option>";
                                    while ($r = mysqli_fetch_array($res)) {
                                        echo "<option  value=$r[depid]>$r[dname]</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td> Salary </td>
                                <td>
                                    <input type="text" class="form-control" id="empsal" name="empsal" placeholder="Enter Your Salary" /><br>
                                </td>
                            </tr>
                            <tr>
                                <td> Email </td>
                                </td>
                                <td>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your email" /><br>
                                </td>
                            </tr>
                            <tr>
                                <td> Mobile </td>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Your number" /><br>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="savedata"> Save </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- </form> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="validation.js "></script>
    <script>
        let tablinks, x;
        window.onload = function() {
            tablinks = document.getElementsByClassName("tablink");
            x = document.getElementsByClassName("data");
            for (let i = 0; i < x.length; i++) {
                x[i].style.display = "none";
                tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
            }
            let pageName = window.location.href.split("#")[1];
            if (pageName) {
                opendata(event, pageName);
            } else {
                opendata(event, "revenue");
            }
        }

        function opendata(evt, dataName) {
            for (let i = 0; i < x.length; i++) {
                x[i].style.display = "none";
                tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
            }
            document.getElementById(dataName).style.display = "block";
            evt.currentTarget.className += " w3-red";
            window.history.pushState(null, null, "#" + dataName);
        }
        //search bar
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#employee tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        //department 
        var department = $("#department").val();
        console.log(department);
        $.ajax({
            url: "depconfig.php",
            method: "POST",
            data: {
                department: department,
            },
            success: function(data) {
                $('#dep').html(data);
            }
        });
        //employee detail
        var employee = $("#employee").val();
        console.log(department);
        $.ajax({
            url: "empconfig.php",
            method: "POST",
            data: {
                employee: employee,
            },
            success: function(data) {
                $('#emp').html(data);
            }
        });
        //dropdown data
        $.ajax({
            url: "drop.php",
            success: function(data) {
                var dep = JSON.parse(data);
                $.each(dep, function(key, value) {
                    $("#departmentt").append("<option value='" + value.depid + "'>" + value.dname + "</option>");
                })
            }
        });
        //dropdown employee data
        $("#departmentt").on('change', function() {
            var depid = $(this).val();
            $.ajax({
                url: "dropemp.php",
                method: "POST",
                data: {
                    depid: depid,
                },
                success: function(data) {
                    console.log(data);
                    var response = JSON.parse(data);
                    $("#emp").empty();
                    $.each(response, function(key, value) {
                        $("#emp").append('<tr>' +
                            '<td>' + value['empname'] + '</td>\
                        <td>' + value['empadd'] + '</td>\
                        <td>' + value['dname'] + '</td>\
                        <td>' + value['empsal'] + '</td>\
                        </tr>');
                    });
                }
            });
        });
        $("#viewall").on('click', function() {
            var employee = $("#empdep").val();
            console.log(employee);
            $.ajax({
                url: "empconfig.php",
                method: "POST",
                data: {
                    employee: employee,
                },
                success: function(data) {
                    $('#emp').html(data);
                }
            });

        });
        $("#savedata").click(function() {
            var empid = $("#empid").val();
            var empname = $("#empname").val();
            var empadd = $("#empadd").val();
            var department = $("#departments option:selected").val();
            var empsal = $("#empsal").val();
            var email = $("#email").val();
            var mobile = $("#mobile").val();
            if (empid != "" && empname != "" && empadd != "" && department != "" && empsal != "" && email != "" && mobile != "") {
                $.ajax({
                    url: "saveemp.php",
                    data: {
                        'empid': empid,
                        'empname': empname,
                        'empadd': empadd,
                        'department': department,
                        'empsal': empsal,
                        'email': email,
                        'mobile': mobile
                    },
                    type: 'POST',
                    dataType: "html",
                    success: function(data) {
                        alert(data);
                        $("#newemp").modal("hide");
                        $("#newemp").trigger("reset");
                        location.reload();
                    }
                });
            } else {
                alert("Please fill all the fields");
            }
        });
        //department
        $("#savedep").click(function() {
            var depid = $("#depid").val();
            var dname = $("#dname").val();
            console.log(depid)
            console.log(dname)
            if (depid != "" && dname != "") {
                $.ajax({
                    url: "savedep.php",
                    data: {
                        'depid': depid,
                        'dname': dname
                    },
                    type: 'POST',
                    dataType: "html",
                    success: function(data) {
                        alert(data);
                        $("#newdep").modal("hide");
                        location.reload();
                    }
                });
            } else {
                if (depid == "") {
                    $("#id_error").html(" Enter Depid ");
                }
                if (dname == "") {
                    $("#name_error").html(" Enter Department Name ");
                }
            }
        });
        //delete 
        function deleteData(depid) {
            $.ajax({
                url: 'deletedep.php',
                type: 'post',
                data: {
                    depid: depid
                },
                success: function(data) {
                    console.log(data);
                    alert(data);
                    location.reload();
                }
            });
        }
    </script>
</body>

</html>