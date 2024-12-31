<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>3D Pay Hosting Result Page</title>
    <style type="text/css">
        body
        {
            border-style: none;
            color: #6B7983;
            font-family: Tahoma,Arial,Verdana,Sans-Serif;
            font-size: 12px;
            font-weight: normal;
        }
        
        tableClass
        {
            margin: 0;
        }
        td
        {
            color: #6B7983;
            font-family: Tahoma,Arial,Verdana,Sans-Serif;
            font-size: 12px;
            font-weight: normal;
            vertical-align: top;
            background: none repeat scroll 0 0 #FFFFFF;
            border-color: #C3CBD1;
            border-style: solid;
            border-width: 0 1px 1px 0;
            padding: 8px 20px;
        }
        .trHeader td
        {
            color: #FFA92D;
            font-weight: bold;
        }
        span
        {
            margin: 0px 0px 6px 0px;
            font-size: 14px;
            font-weight: bold;
        }
        h3
        {
            margin: 0px 0px 6px 0px;
            font-size: 14px;
            font-weight: bold;
            color: #518ccc;
        }
        h1
        {
            font-family: Calibri, Tahoma, Arial, Verdana, Sans-Serif;
            font-size: 24px;
            font-weight: normal;
            color: #51596a;
        }
    </style>
</head>
<body>
    <?php
        $storekey="Ahlan2006";
    ?>
    <h1>3D Pay Hosting Result Page</h1>
    
	 <h3>Payment Result</h3><br /><br />
	 <table class="tableClass">
	 <tr>
        <td><h3> Payment Result:&nbsp;</h3></td>
        <td>
            <span>
                <?php
                    $servername = "localhost";
                    $username = "antalyatr_db";
                    $password = "!}7vm{xFw^Q.";
                    $dbname = "antalyatr_db";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    $sql = "SELECT * FROM testpayment";
                    
                    $mdStatus=$_POST['mdStatus'];
                    $result = mysqli_query($conn, $query);
                    //$result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $sql = "UPDATE testpayment SET 'status'=".$mdStatus." WHERE id=".$result["id"];
                    }

                    if($mdStatus =="1" || $mdStatus == "2" || $mdStatus == "3" || $mdStatus == "4")
                    {
                    $Response = $_POST["Response"];	
                    if ( $Response == "Approved")
                        {
                            echo "<font color=\"green\">Your payment is approved.</font>";
                        }
                        else			
                        {
                            echo "<font color=\"red\">Your payment is not approved.</font>";
                        }
                    }	
                    else
                    {
                        echo "<font color=\"red\">3D Authentication is not successful.</font>";
                    }	
                ?>
			</span>
		</td>
	</tr>
	</table>   
</body>
</html>