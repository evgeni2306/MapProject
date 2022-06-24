<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <title>Select</title>
</head>
<body>
  <select class="js-example-tags form-control" multiple="multiple">
    <option selected="selected">оранжевый</option>
    <option>белый</option>
    <option selected="selected">пурпурный</option>
  </select>
  </div>
  <script type="text/javascript">
    $(function(){
      $('select').select2();
    });
    $(".js-example-tags").select2({
      tags: true
    });
</script>
</body>
</html>