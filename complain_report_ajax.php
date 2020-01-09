<?php
include("config/config.php");

if (isset($_GET['excel'])) {

	$check = $_GET['check']; 
	$html='';
	
	foreach ($check as $deptname){

    $dep = $deptname;
    $start = $_GET["first"];
    $second = $_GET['second'];


//$dep="Carpenter";
//$start="2019-08-23";
//$second="2019-08-30";


    if ($dep == "All") {


        $query = mysqli_query($con, "SELECT * from complain");

        
        $pending = 0;
        $resolved = 0;
        $progress = 0;
        $total_cost = 0;
        $total_complain = 0;

        $html .= '

  <html xmlns:x="urn:schemas-microsoft-com:office:excel">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--[if gte mso 9]>
    <xml>
    <x:ExcelWorkbook>
    <x:ExcelWorksheets>
    <x:ExcelWorksheet>
    Name of the sheet
    <x:WorksheetOptions>
    <x:Panes>
    </x:Panes>
    </x:WorksheetOptions>
    </x:ExcelWorksheet>
    </x:ExcelWorksheets>
    </x:ExcelWorkbook>
    </xml>
    <![endif]-->
  </head>
  <body>
  <table>
                    ';

        while ($row = mysqli_fetch_array($query)) {
            $date = $row['complaindate'];
            $date = explode(" ", $date);
            // $start = strtotime($start);
            //$second = strtotime($second);

            $check = $date[0];
            //echo $date[0]."   ";

            if ($start <= $check && $check <= $second) {
                // echo "olll";
                $html .= '<tr>
                      <td>' . $row['id'] . '</td>
                      
                      
                      <td>' . $row['description'] . '</td>

                       <td>' . $row['Departmentname'] . '</td>
                      
                      
                      <td>' . $row['complaindate'] . '</td>
                      
                      
                      <td>' . $row['status'] . '</td>
                      
                
                       
                        <td>' . $row['complainantmail'] . '</td>
                        <td>' . $row['cost'] . '</td>
                      </tr>
                      ';
                switch ($row['status']) {
                    case 'Pending':
                        $pending += 1;
                        break;
                    case 'In-Progress':
                        $progress += 1;
                        break;
                    case 'Resolved':
                        $resolved += 1;
                        break;
                }

                $total_cost += $row['cost'];
                $total_complain += 1;

            }


            //$html.=$row['complaindate']."<br>";


        }
        $html .= '</table></body>';
       


    } else {
        $query = mysqli_query($con, "SELECT * from complain where Departmentname='$dep'");

        
        $pending = 0;
        $resolved = 0;
        $progress = 0;
        $total_cost = 0;
        $total_complain = 0;

        $html .= '

			  <html xmlns:x="urn:schemas-microsoft-com:office:excel">
			  <head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<!--[if gte mso 9]>
				<xml>
				<x:ExcelWorkbook>
				<x:ExcelWorksheets>
				<x:ExcelWorksheet>
				Name of the sheet
				<x:WorksheetOptions>
				<x:Panes>
				</x:Panes>
				</x:WorksheetOptions>
				</x:ExcelWorksheet>
				</x:ExcelWorksheets>
				</x:ExcelWorkbook>
				</xml>
				<![endif]-->
			  </head>
			  <body>
			  <table>
                    ';

        while ($row = mysqli_fetch_array($query)) {
            $date = $row['complaindate'];
            $date = explode(" ", $date);
            // $start = strtotime($start);
            //$second = strtotime($second);

            $check = $date[0];
            //echo $date[0]."   ";

            if ($start <= $check && $check <= $second) {
                // echo "olll";
                $html .= '<tr>
                      <td>' . $row['id'] . '</td>
                      
                      
                      <td>' . $row['description'] . '</td>
                      
                      
                      <td>' . $row['complaindate'] . '</td>
                      
                      
                      <td>' . $row['status'] . '</td>
                      
                
                       
                        <td>' . $row['complainantmail'] . '</td>
                        <td>' . $row['cost'] . '</td>
                      </tr>
                      ';
                switch ($row['status']) {
                    case 'Pending':
                        $pending += 1;
                        break;
                    case 'In-Progress':
                        $progress += 1;
                        break;
                    case 'Resolved':
                        $resolved += 1;
                        break;
                }

                $total_cost += $row['cost'];
                $total_complain += 1;

            }


            //$html.=$row['complaindate']."<br>";


        }


        $html .= '</table></body>';
	
       
    }
	
	}
		header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $html;

}


?>
