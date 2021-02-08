{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Email</title>
</head>
<body>
    <table>
        <tr>
            <td>Dear {{ $name }} </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                Your Account has been registered to CCERMS. <br>
                Your Account information is as below:
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Email: {{ $email }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Password: {{ $password }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Login to <a href="http://ccerms.online/login">ccerms</a>.</td></tr>
    </table>
</body>
</html> --}}
@component('mail::message')

<table>
    <tr>
        <td>Dear {{ $data['name'] }} </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
        <td>
            Your Account has been registered to CCERMS. <br>
            Your Account information is as below:
        </td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Email: {{ $data['email'] }}</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>Password: {{ $data['password'] }}</td></tr>
    <tr><td>&nbsp;</td></tr>
</table>

@endcomponent
