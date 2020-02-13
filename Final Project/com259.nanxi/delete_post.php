<?php
// Start the session.
session_start() ;
// Redirect if not logged in.
if ( !isset( $_SESSION[ 'member_id' ] ) )
{ header("Location: login.php");
exit(); }
$menu = 7;
?>

<?php
try { 
	// Check for a valid user ID, through GET:
	if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
		// From view_posts.php
		$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
	}  else { // No valid ID
		//return to view_posts
		header("Location: view_posts.php");
		exit();
	}
	require ('mysqli_connect.php');
	// Check if the request has been accepted:                                              
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		 // Delete the record.
		$q = mysqli_stmt_init($dbcon);
	    mysqli_stmt_prepare($q, 'DELETE FROM forum WHERE post_id=? LIMIT 1');

	    // bind $id to SQL Statement
	    mysqli_stmt_bind_param($q, "s", $id);

	    // execute query
	    mysqli_stmt_execute($q);
		if (mysqli_stmt_affected_rows($q) == 1) { 
				// It ran OK, return to view posts
				header("Location: view_posts.php");	
			}
		} else {
			//if the delete did not succeed, still go back to view_posts page
			header("Location: view_posts.php");
		}
		//close the sql connection
		mysqli_stmt_close($q);
		mysqli_close($dbcon );
}
	catch(Exception $e)
	{
		print "The system is busy. Please try again.";
	}catch(Error $e)
	{
		print "The system is currently busy. Please try again soon.";
	}

?>
