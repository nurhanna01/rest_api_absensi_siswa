<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Login Form</title>
</head>
<body>
<form method="" action="">
<div class="container">
  <div class="mb-3">
    <label for="" class="form-label">NIM</label>
    <input name="nim" type="text" class="form-control" id="" aria-describedby="">
  </div>
  <div class="mb-3">
    <label name="password" for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button id="login" type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</body>
</html>

<script type="text/javascript">
    $('#login').click(function () {
        $.ajax({
            type: 'POST',
            url: 'login',
            success: function (data) {
              
            }
        });
    });

</script>