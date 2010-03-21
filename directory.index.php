<?php include("../header.php"); ?> <!-- header -->

<!-- CONTENT START -->

<h1>Digital History Directory</h1>
   <p>The field of digital history is growing as scholars begin to work with digital technologies to present their work, reach audiences, and test theories. The field is broad, including historians from a wide array of subfields and areas of study. Our goal here is allow historians to get in contact with each other and learn of new work and projects.  Browse the directory or search by last name. </p>

<p>


<form method="GET" action="http://digitalhistory.unl.edu/data/dhistory.search.php">
</p>
<h3>Last Name: <input type="text" name="last_name" size=25 maxlength=25 />
</h3>
</p>

<p>    
    <input type="submit" name="submit" value="Search" />
	<input type="hidden" name="searching" value="yes" />
  </form>
<p>


<?php 
	$host = 'localhost';
	$user = '';
	$pw = '';
	$db = 'dhistory';


	mysql_connect($host, $user, $pw)
		or die(mysql_error);
		mysql_select_db($db);


$myresults = mysql_query("SELECT * FROM directory ORDER BY Last_Name");
	if (!$myresults) {
		echo 'Could not run query: ' . mysql_error();
		exit;
	}

	print "<table border=0 cellpadding=3 cellspacing=3 width=100%";
	print "<tr><th>Name</th><th>Institution</th></tr>";


	$odd = false;
	while($row = mysql_fetch_row($myresults)){
	$odd = !$odd;
		print "

<tr" . (($odd) ? ' class="odd"' : '') . ">
<td><A HREF=\"http://digitalhistory.unl.edu/data/dhistory.search.php?last_name=$row[1]&submit=Search&searching=yes
\">$row[2] $row[1] </A></td>
<td>$row[5]</td>
</tr>";
	}
	
	print("</table>");

mysql_close();

?>

<?php include("../footer.php"); ?> <!-- FOOTER -->

</body>
</html>
