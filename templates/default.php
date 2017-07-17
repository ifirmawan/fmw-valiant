<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Myfmw</title>
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/bootstrap/dist/css/bootstrap.min.css');?>" />
</head>
<body>
<?php echo (isset($content))? $content : 'no content laoded';?>
</body>
<script type="text/javascript" src="<?php echo site_url('assets/jquery/dist/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/bootstrap/dist/js/bootstrap.min.js');?>"></script>
</html>
