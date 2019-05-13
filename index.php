<?php
//in the name of god
if( count( $_GET ) == 0 )
{
	header("Location: ./?action=getParametrs");
	exit();
}
else
{
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>Post form submission</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>
	<div class="container">
		<h1 class="page-header">Post form submission</h1>
<?php
	$Form = '<form action="FORMACTION" method="FORMMETHOD">'; //?action=FORMACTION
	switch( $_GET['action'] )
	{
		case "getParametrs":
			setformAction( );
			setFormMethod( "GET" );

			$Form .='
			<div class="form-group">
	<label for="comment">Url:</label>
	<textarea name=url placeholder="Example: http://test.com/" class="form-control" rows="4" id="comment" name=params placeholder="Example: firstname=john&lastname=wick"></textarea>
</div>
			<div class="form-group">
	<label for="comment">Post Data:</label>
	<textarea class="form-control" rows="10" id="comment" name=params placeholder="Example: firstname=john&lastname=wick"></textarea>
</div>
<div class="checkbox hidden">
	<label><input type="checkbox" name="HEADER" value="1" data-toggle="collapse" data-target="#demo">Include HEADER</label>
</div>
<div class="form-group collapse" id="demo">
	<label for="comment">HTTP HEADER:</label>
	<textarea class="form-control" rows="10" id="comment" name=headers placeholder="Example: User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.89 Safari/537.36"></textarea>
</div>
			<input name=action value=showForm type=hidden>
			';

		break;

		case "showForm":
			if( isset( $_GET['HEADER'] ) )
			{
				setformAction( "./?action=test" );
				setFormMethod( "GET" );
			}
			else
			{
				setformAction( $_GET['url'] );
				setFormMethod( "POST" );
			}



			$params = explode( "&", $_GET['params'] );
			foreach( $params as $param )
			{
				$input = explode( "=", $param );
				$input[0] = urldecode( $input[0] );
				$Form .= "{$input[0]} <input name='{$input[0]}' value='{$input[1]}' style='padding:10px; width:100%; margin: 3px'/><br />";
			}

		break;

		case 'test':
				echo "hi";
			break;

		default:
			header("Location: ./?action=getParametrs");
			exit();
	}

	echo $Form;
	?>
	<br />
	<input type=submit value=GO id="section2" class="btn btn-default container-fluid">
	</form>
	<?php
}

function setFormMethod( $method )
{
	global $Form;
	$Form = str_replace( "FORMMETHOD", $method, $Form );
	return $Form;
}
function setFormAction( $action = "" )
{
	global $Form;
	$Form = str_replace( "FORMACTION", ($action == "" ? './' : $action), $Form );
	return $Form;
}
?>
	</div>
</body>
</html>
