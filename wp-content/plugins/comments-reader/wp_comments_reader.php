<?php
/*
*   Plugin Name: WP Comments Reader
*   Description: plugin to read the MySQL DB comments table row data (4 columns)
*   Version: 2.0 
*   Author: Mr. Michael H Chase
*   File: wp-comments-reader.php
*   Folder to create: comments-reader
*   Short code: [wp-comments-reader-shortcode]
*/
   
  add_shortcode( 'wp-comments-reader-shortcode', 'wp_comments_reader_entry_point' );


function wp_comments_reader_entry_point( $attributes ) {
	
	global $wpdb;
	//
	// PLEASE NOTE
	//    comments, the is the database table name without the prefix
	//    *** YOU MUST add the prefix before the table name***
	//    ***  We will use the $wpdb object prefix value ***
	//   
	
	//Echo out the Database table prefix as retrieved form the $wpdb object
	//
	//echo $wpdb->prefix . "<br>";
	
	//Use the concatinaiton operator to join the table prefix to the word comments
	// to create the correct db prefix + table name
	//
	$tableName =   $wpdb->prefix . "comments"; 
	
	//Echo out the $tablename varaible, which is the db prefix + table name
	//
	//echo $tableName . "<br>";
	 
	//Query the vomments table and assign the returned array of table row objects
	// to the $result variable
	//
	$result = $wpdb->get_results( "SELECT * FROM $tableName");

    //Echo out a table header using start string values
    //
	$output = "";

	$output .= "<table border=\"1\">";
	
	$output .= "<tr>";
	$output .= "<th>"  . "Comment Post ID"  . "</th>" 
		    . "<th>" . "Comment Author"     . "</th>" 
		    . "<th>" . "Comment Date"       . "</th>" 
		    . "<th>" . "Comment Content"    . "</th>";
	$output .= "</tr>";

	//Iterate the array of DB row objects and put them in HTML table cells
	// 
	foreach($result as $row)  {
	 
	 echo "<tr>";
	 
	 //Each table row column data item is accessed using it's column name 
	 //
	 $output .=   "<td>" . $row->comment_post_ID . "</td>"
		  . "<td>" . $row->comment_author    . "</td>"
		  . "<td>" . $row->comment_date      . "</td>"
		  . "<td>" . $row->comment_content   . "</td>";
		  
	 $output .= "</tr>";
	}

	$output .= "</table>";
	
	return $output;
}
?>