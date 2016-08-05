<?php
/**
 * Table creation package pulled from: https://github.com/farshadjahanmanesh/awesomeTableJs
 * This is a open-source project.
 * Visit the link to view copyright specifics.
 */


    if(isset($_POST['reportrange'])){
        $dates=filter_input(INPUT_POST, 'reportrange', FILTER_SANITIZE_STRING);
    }

    $pieces = explode(" - ", $dates);

    $url = 'http://url/awesome-table-mixpanel/fetch/index.php?toDate=' . $pieces[1] . '&fromDate=' . $pieces[0];

?>



<html>

<head>
    <meta charset="UTF-8">
    <title>Awesome Mixpanel Table</title>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/awesome.css" />

</head>

<body>
    <!-- Add another input to prevent IE or goole Chrome from submiting form, after Enter Key pressed -->
    <input type="text" style="display:none"/>
    <br/>
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 col-md-offset-2"></div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="paginationContainer "></div>
        </div>
        <div class="col-md-4 col-md-offset-1">
            <div class="col-md-4 vcenter" >
                Page Count :
            </div>
            <div class="col-md-8  vcenter">
                <div class="pageSizeContainer"></div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="text-center tip">
                <br>
                Click Each Header Element To Sort-By
                <br/>
                <a class="btn btn-block btn-primary" href="index.html">Reset Dates</a>
                <h3>Displaying&nbsp;<? echo($dates) ?></h3>
                <br>
            </div>
        </div>
    </div>

    <div class="awesomeTableContiner">
        <div id="noInfoWarning"></div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/awesomeTableJs.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/transition.js"></script>
    <script src="js/collapse.js"></script>
    <script src="js/bootstrap.js"></script>

    <script>

        var fetchUrl = "<?php echo $url ?>";

        var aweTbl = new awesomeTableJs({
            url: fetchUrl,
            data: "",
            pageSize: 100,
            tableWrapper: ".awesomeTableContiner",
            paginationWrapper: ".paginationContainer",
            pageSizeWrapper: ".pageSizeContainer",
            columnsTypes: {picture: "image", email: "link"},
            updateCallback: function () {
                console.log('updating...');
            }
        });

        aweTbl.createTable();

    </script>

</body>

</html>

