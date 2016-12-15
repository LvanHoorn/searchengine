<?php
	
require_once 'app/init.php';

if(!empty($_POST)){
		
		if (isset($_POST['title'], $_POST['body'], $_POST['keywords'])) {
				
				$title = $_POST['title'];
				$body = $_POST['body'];
				$keywords = explode(', ', $_POST['keywords']);

				$indexed = $es->index([
						'index' => 'articles',
						'type' => 'article',
						'body' => [
								'title' => $title,
								'body' => $body,
								'keywords' => $keywords
						]
				]);

				if($indexed) {
						print_r($indexed);
				}

		}
}

?>

<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Add | ES</title>

			<link rel="stylesheet" type="text/css" href="css/main.css">
		</head>
		<body>
			<form action="add.php" method="post" autocomplete="off">
					<label>
							Title
							<input type="text" name="title">
					</label>
					<label>
							Body
							<textarea name="body" rows="8"></textarea>
					</label>
					<label>
							Keyword
							<textarea type="text" name="keywords" placeholder="comme, separate"></textarea>
					</label>

					<input type="Submit" name="Add">
			</form>
		</body>
</html>