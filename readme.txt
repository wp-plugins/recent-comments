Instructions:
Place the function call wherever you want the recent comments to appear.
<?php get_recent_comments(); ?>

Configuration:
You may pass parameters when calling the function to configure some of the options.
Example: get_recent_comments(10, 7, '', '<br />', true, 1)

The parameters:
$no_comments - sets the number of recent comments to display
$comment_lenth - the number of words to display as a comment excerpt
$before - text to be displayed before the link to the recent comment
$after - text to be displayed after the link to the recent comment
$show_pass_post - whether or not to display comments from password protected posts
$comment_style - sets the style of comment to be used
	1 = "CommentorName on PostTitle" with CommentorName being a link to the comment
	0 = "CommentorName: WordsOfComment" with WordsOfComment being a link to the comment