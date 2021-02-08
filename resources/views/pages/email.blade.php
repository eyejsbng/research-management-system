{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Email</title>
</head>
<body>
    @if ($type == 'approval')
    <table>
        <tr>
            <td>Dear {{ $name }} </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                Your Account has been
                @if ($us_id == 1)
                    Approved to CCERMS. <br>
                    Your Account information is as below:
                @else
                    Disapproved. Looks like RC doesnt recall your email as valid. <br>
                    If this is your valid email, Go to RC directly and tell to approve your email.
                @endif
            </td>
        </tr>
        @if ($us_id == 1)
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: {{ $email }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Your Password will be the password that you take in the registration</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Login to <a href="http://ccerms.online/login">ccerms</a>.</td></tr>
        @endif
    </table>
    @else
    <table>
        <tr>
            <td>Dear {{ $name }} </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                Your Account has been
                Updated by the Research Coordinator. <br>
                Your Account information is as below:
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Email: {{ $email }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            @if ($password == '')
            <td>Your Password are not updated.</td>
            @else
            <td>Password: {{ $password }}</td>
            @endif

        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Login to <a href="http://ccerms.online/login">ccerms</a>.</td></tr>
    </table>
    @endif

</body>
</html> --}}

@component('mail::message')
@if ($data['type'] == 'approval')
    <table>
        <tr>
            <td>Dear {{ $data['name'] }} </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                Your Account has been
                @if ($data['us_id'] == 1)
                    Approved to CCERMS. <br>
                    Your Account information is as below:
                @else
                    Disapproved. Looks like RC doesnt recall your email as valid. <br>
                    If this is your valid email, Go to RC directly and tell to approve your email.
                @endif
            </td>
        </tr>
        @if ($data['us_id'] == 1)
            <tr><td>&nbsp;</td></tr>
            <tr><td>Email: {{ $data['email'] }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Your Password will be the password that you take in the registration</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td>Login to <a href="http://ccerms.online/login">ccerms</a>.</td></tr>
        @endif
    </table>
    @else
    <table>
        <tr>
            <td>Dear {{ $data['name'] }} </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>
                Your Account has been
                Updated by the Research Coordinator. <br>
                Your Account information is as below:
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Email: {{ $data['email'] }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            @if ($data['password'] == '')
            <td>Your Password are not updated.</td>
            @else
            <td>Password: {{ $data['password'] }}</td>
            @endif

        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Login to <a href="http://ccerms.online/login">ccerms</a>.</td></tr>
    </table>
    @endif

@endcomponent
