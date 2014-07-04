<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>The Village Waterpoints Calculator</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="css/default.css"/>
    </head>
    <body>    
        <form action="process_url.php" class="register" method="POST">
            <h1>Dataset URL submission Form</h1>

            <fieldset class="row3">
		<?php
		if (isset($_GET['error'])) {
		    ?>
                    <p class ="error">Please enter a valid URL</p>
		<?php } ?>

		<div class="infobox"><h4>Helpful Information</h4>
                    <p>Please provide a valid URL here.</p>
                </div>


                <p>&nbsp;</p>
                <p>
                    <label>Dataset URL *
                    </label>
                    <input type="text" name="url"/>


                </p>


		<p>
		    <label>&nbsp;
                    </label>
		    <button class="button">Do some wonders &raquo;</button>
		</p> 
            </fieldset>
            <fieldset class="row3" style="background:#FDFEFA">

		<?php
		if (isset($_SESSION['results'])) {
		    echo "JSON DATA";

		    $data = $_SESSION['results'];

		    echo "<pre>" . print_r($data, true) . "</pre>";

		    echo "ARRAY DATA";
		    echo "<br />";
		    echo "<pre>" . print_r(json_decode($data), true) . "</pre>";
		}

		$_SESSION['results'] = NULL;
		?>
	    </fieldset> 
        </form>
    </body>
</html>





