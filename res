
useer
<style>
/* Center the loader */


#loader {
  	position: relative;
	top: 50%;
	margin: 0px auto auto auto;
  border:5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


#myDiv {
  display: none;
  text-align: center;
}
</style>
//loader style close


//get dept name
$sqlt = "SELECT name from user WHERE email like '%" . $_SESSION['email'] . "%'";
            $result1 = mysqli_query($con, $sqlt);
            $deptnamearr = array();
            while ($row1 = mysqli_fetch_array($result1)) {
                $deptnamearr[] = $row1['name'];
            }
//Emergency
  if ( $row['dname'] == 'Emergency') {
                            continue;
                        }
    $sql = "SELECT * FROM department WHERE dname='Emergency'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    echo '     <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header "style="background: #f44336;">';

                    echo "<form method='POST' action='' id=" . $row['id'] . ">";
                    echo " <input type='hidden' name='department' value=" . $row['dname'] . ">";
                    echo '		</br>
                  <h3 class="card-title text-center" style="    color: white;" name="' . $row["dname"] . '"><b>' . $row["dname"] . '</b></h3>
				</br>
				<a href="#complain" class="btn btn-info btn-block" name="' . $row["dname"] . '" onClick="scrollToBottom(event)">Complain</a>

				</form>
				</div>
              </div>
            </div>';

<div id="emergency_dept"></div>
var em = document.getElementById("emergency_dept");

        var dname = event.target.name;

        var cmp = dname.localeCompare("Emergency");
        if (cmp == 0) {
            em.innerHTML = '  <div class="col-md-8 offset-md-2">\n' +
                '                        <div class="card">\n' +
                '                            <div class="card-header card-header-danger" style="margin: 0;">\n' +
                '                                <h4 class="card-title" id="emergency_dept">Please DO NOT complain here unless your complain required urgent attenction.</h4>\n' +
                '                                <p class="card-category"> Your mail id, name and other details will be recorded </p>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>  ';
        } else {
            em.innerHTML = '';
        }