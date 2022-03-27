<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr><td>Dear, {{$name}}</td></tr>		
		<tr><td>Please click on below to active your account!</td></tr>	
		<tr><td>&nbsp;</td></tr>		
		<tr><td><a href="{{url('/confirm/'.$code)}}">Confirm Account</a></td></tr>
		<tr><td>&nbsp;</td></tr>		
		<tr><td>Thanks Regard</td></tr>
		<tr><td>E-commerce, Muzaffer</td></tr>	
	</table>
</body>
</html>