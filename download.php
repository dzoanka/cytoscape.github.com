<?php

include "download_config.php";

####################################################
# Generate download page if input values are valid.
####################################################
function ProcessSuccess($download_log) {

	# Get User URL Parameters
	# Assume these values are validated in client script.
	$name = $_REQUEST["name"];
	$org = $_REQUEST["org"];
	$email = $_REQUEST["email"];
	$contact = $_REQUEST["contact"];

	# Add to the log
	$now = date("F j, Y, g:i a");  
	$ip = getenv(REMOTE_ADDR);

	$contactStr = "NO_EMAIL";
	if (isset($contact)) {
		$contactStr = "YES_EMAIL";
	}
	$newEntry = "$now\t$ip\t$file\t$name\t$org\t$email\t$contactStr\n";

	$fr = fopen($download_log, 'a');
	fputs($fr, $newEntry);
	fclose($fr);

	return $newEntry;
}

# Process
$submit = $_REQUEST["submit"];
if (isset($submit)) {
	$test = ProcessSuccess($download_log);
	$files["gz"] = $latest_dist_gz;
	$files["zip"] = $latest_dist_zip;
	$files["mac"] = $latest_mac; 
	$files["win32"] = $latest_windows_32;
	$files["win64"] = $latest_windows_64; 
	$files["linux"] = $latest_linux; 

	$files3x["gz"] = $latest_3x_dist_gz;
	$files3x["zip"] = $latest_3x_dist_zip;
	$files3x["mac"] = $latest_3x_mac; 
	$files3x["win32"] = $latest_3x_windows_32;
	$files3x["win64"] = $latest_3x_windows_64; 
	$files3x["linux"] = $latest_3x_linux; 

	if(strlen($beta_2x) == 0) {
		$beta_link = "";
	} else {
		$beta_link = "<li><a href=".$beta_2x.">Beta Version</a></li>";
	}
} else {
	echo "cannot process";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/main.css" type="text/css" rel="stylesheet" media="screen">

<title>Thank you!</title>

<script type="text/javascript" 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/global_variables.js"></script>
<script type="text/javascript" src="js/menu_generator.js"></script>
</head>

<body>
<div id="container"> 
	<script src="js/header.js"></script>
	<div id="download">
		<div class="blockleft">
			<!-- 3.x Series Download -->
			<h1>ADD2 = <?=$test ?></h1>
			<h2>Download Latest 3.x Series:
				<?=$latest_3x_version?>
			</h2>
			<ol>
				<li>
					<h3>Platform Specific Installers</h3>
				</li>
				<ul>
                    <li>
                        <a href="<?=$files3x["mac"]?>">Mac OS X</a>
                    </li>
					<li><a href="<?=$files3x["win32"]?>">Windows 32bit</a></li>
					<li><a href="<?=$files3x["win64"]?>">Windows 64bit</a></li>
					<li><a href="<?=$files3x["linux"]?>">Linux</a></li>
				</ul>
				<li>
					<h3>Archived Distribution Files</h3>
					<ul>
						<li><a href="<?=$files3x["zip"]?>">Zip Archive ( for Windows )</a></li>
						<li><a href="<?=$files3x["gz"]?>">GZIP Archive ( for Mac/Unix Systems )</a></li>
					</ul>
				</li>
			</ol>
			
			<h2>Download Latest 2.x Series:
				<?=$latest_version?>
			</h2>
			<ol>
				<li>
					<h3>Platform Specific Installers</h3>
				</li>
				<ul>
					<li><a href="<?=$files["mac"]?>">Mac OS X</a></li>
					<li><a href="<?=$files["win32"]?>">Windows 32bit</a></li>
					<li><a href="<?=$files["win64"]?>">Windows 64bit</a></li>
					<li><a href="<?=$files["linux"]?>">Linux</a></li>
				</ul>
				<li>
					<h3>Archived Distribution Files</h3>
					<ul>
						<li><a href="<?=$files["zip"]?>">Zip Archive ( for Windows )</a></li>
						<li><a href="<?=$files["gz"]?>">GZIP Archive ( for Mac/Unix Systems )</a></li>
					</ul>
				</li>
			</ol>
		</div>

		<div class="blockright">
				<h2>Latest Development Versions</h2>
				<ul>
					<li>
						<a href="http://code.cytoscape.org/jenkins/job/cytoscape-3-gui-distribution/lastSuccessfulBuild/org.cytoscape.distribution$cytoscape/">
							Latest Successful Build
						</a>
					</li>
				</ul>

				<hr />

				<h2>Older Versions</h2>
				<ul>
					<?
						while(list($tKey,$tValue)=each($older_versions)) {
							print '<li><a href="'.$tValue.'">'.$tKey.'</a></li>';
						}
					?>
				</ul>
		</div>
	</div>

	<!-- Google Code for Cytoscape downloaded Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1026957401;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "-cK5CJPKiwIQ2cDY6QM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1026957401/?label=-cK5CJPKiwIQ2cDY6QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

	<script src="js/footer.js"></script> 
</div>
</body>
</html>
