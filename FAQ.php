<!DOCTYPE html>
<html>
<head>
	<title>FAQ Page</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="icon" href="images/mict-logo4.jpg">
</head>
<style>
body {
	font-family: 'Roboto', sans-serif;
	margin: 0;
	padding: 0;
}

.container {
	max-width: 800px;
	margin: 0 auto;
	padding: 20px;
}

.header {
	text-align: center;
	margin-bottom: 20px;
}

.faq-item {
	margin-bottom: 20px;
}

.faq-toggle {
	background-color: #f9f9f9;
	padding: 10px;
	border: none;
	width: 100%;
	cursor: pointer;
}

.faq-content {
	padding: 10px;
	display: none;
}



</style>
<body>
	<div class="container">
		<h1 class="header">Frequently Asked Questions</h1>
		<div class="faq-item">
			<button class="faq-toggle">How do I create an accordion?</button>
			<div class="faq-content">
				<p>You can use the <code>&lt;details&gt;</code> and <code>&lt;summary&gt;</code> elements to create an accordion.</p>
			</div>
		</div>
		<!-- Add more faq-item divs for additional questions -->
	</div>
	<script src="script.js">




    </script>
</body>
</html>