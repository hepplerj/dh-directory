<html>
<head>
<title>Digital History Directory Search Results</title>
</head>
<body>
<?php 
    $host = 'localhost';
	$user = '';
	$pw = '';
	$db = 'dhistory';

	$last_name = $_GET['last_name'];
	
	$searching = $_GET['searching'];

if ($searching == "yes")

	{
	echo "<h2>Results:</h2><p>";

//If they did not enter a search term we give them an error

//if ($last_name == "")

//	{
//	echo "<p>You forgot to enter a search term";
//	exit;
//	}

	mysql_connect($host, $user, $pw)
		or die(mysql_error);
		mysql_select_db($db);

// We preform a bit of filtering
	$last_name = strtoupper($last_name);
	$last_name = strip_tags($last_name);
	$last_name = trim ($last_name); 
	
	
	$myresults = mysql_query("SELECT * FROM directory WHERE last_name LIKE '%$last_name%'");
	if (!$myresults) {
		echo 'Could not run query: ' . mysql_error();
		exit;
	}
	
	$numrows = mysql_num_rows($myresults);


	// Printing results in HTML
	print "<b>There are $numrows records.</b>";
	print "<table border=0 cellpadding=10 cellspacing=5 width=100%";
	print "<tr><th>First Name</th><th>Last Name</th><th>Collaborators</th><th>Institution</th><th>Department</th><th>Projects</th><th>Summary</th><th>Fields</th><th>Email</th></tr>";

	$odd = false;
	while($row = mysql_fetch_row($myresults)){
	$odd = !$odd;
		print "

<tr" . (($odd) ? ' class="odd"' : '') . ">
<td>$row[2] </td>
<td>$row[1] </td>
<td>$row[4] </td>
<td>$row[5]</td>
<td>$row[6]</td>
<td>$row[8]</td>
<td>$row[10]</td>
<td>$row[11]</td>
<td>$row[12]</td>
</tr>";
	}
	
	print("</table>");
	
print "<p>Please submit corrections and additions to Douglas Seefeldt at: <a href="mailto:seefeldt@unl.edu">seefeldt@unl.edu</a></p>";


mysql_close();
	}

?>
</body>
</html>
