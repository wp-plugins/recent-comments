<?php
/*
Plugin Name: Recent Comments
Plugin URI: http://dev.wp-plugins.org/browser/recent-comments/
Description: Retrieves a list of the most recent comments.
Version: 1.14
Author: Nick Momrik
Author URI: http://mtdewvirus.com/
*/

function get_recent_comments($no_comments = 5, $comment_lenth = 5, $before = '<li>', $after = '</li>', $show_pass_post = false, $comment_style = 0) {
    global $wpdb, $tablecomments, $tableposts;
    $request = "SELECT ID, comment_ID, comment_content, comment_author, post_title FROM $tablecomments LEFT JOIN $tableposts ON $tableposts.ID=$tablecomments.comment_post_ID WHERE post_status = 'publish' ";
	if(!$show_pass_post) $request .= "AND post_password ='' ";
	$request .= "AND comment_approved = '1' ORDER BY comment_ID DESC LIMIT $no_comments";
	$comments = $wpdb->get_results($request);
    $output = '';
	if ($comments) {
		foreach ($comments as $comment) {
			$comment_author = stripslashes($comment->comment_author);
			if ($comment_author == "")
				$comment_author = "anonymous"; 
			$comment_content = strip_tags($comment->comment_content);
			$comment_content = stripslashes($comment_content);
			$words=split(" ",$comment_content); 
			$comment_excerpt = join(" ",array_slice($words,0,$comment_lenth));
			$permalink = get_permalink($comment->ID)."#comment-".$comment->comment_ID;
			if ($comment_style == 1) {
				$post_title = stripslashes($comment->post_title);
				$output .= $before . '<a href="' . $permalink . '" title="View the entire comment by ';
				$output .= $comment_author.'">' . $comment_author . '</a> on ' . $post_title . '.' . $after;
			}
			else {
				$output .= $before . '<strong>' . $comment_author . ':</strong> <a href="' . $permalink;
				$output .= '" title="View the entire comment by ' . $comment_author.'">' . $comment_excerpt.'</a>' . $after;
			}
		}
		$output = convert_smilies($output);
	} else {
		$output .= $before . "None found" . $after;
	}
    echo $output;
}
?>