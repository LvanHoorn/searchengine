<?php
	
require_once 'app/init.php';

if(isset($_GET['q'])) {
		
		$q = $_GET['q'];

		$query = $es->search([
				'body' => [
						'query' => [
								'bool' => [
										'should' => [
												'match' => ['title' => $q],
												'match' => ['body' => $q],
												'match' => ['keywords' => $q]
										]
								]
						]
				]
		]);

		if ($query['hits']['total'] >=1) {
				$results = $query['hits']['hits'];
		}
}
?>

<!DOCTYPE html>
	<html>
		<head>

			<meta charset="utf-8">
			<title>Search | ES</title>
			
			<link rel="stylesheet" type="text/css" href="css/main.css">
		</head>

		<body>
			<form action="index.php" method="get" autocomplete="off">
					<label>
							Search Something
							<input type="text" name="q">
					</label>

					<input type="Submit" name="Search">
			</form>

				<?php 

						if (isset($results)) {
								foreach ($results as $r) {
						?>

								<div class="result">
										<a href="<?php echo $r['_id']; ?>"><?php echo $r['_source']['title']; ?></a>
										<div class="result-keywords"><?php echo implode(', ', $r['_source']['keywords']); ?></div>
								</div>

						<?php 
								}
						}

					?>

		</body>
</html>

