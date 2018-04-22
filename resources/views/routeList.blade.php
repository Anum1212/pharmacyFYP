<!DOCTYPE html>
<html lang="en">
{{-- this is just a page to gather all major routes in one place for easy use during development (will be removed in final
version) --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <ul>
                <li>
                    <a href="/index" target="_blank">Search Page</a>
                </li>
                <li>
                    <a href="/admin/login" target="_blank">Admin Login</a>
                </li>
                <li>
                    <a href="/pharmacist/register" target="_blank">Pharmacist Register</a>
                </li>
                <li>
                    <a href="/pharmacist/login" target="_blank">Pharmacist Login</a>
                </li>
                <li>
                    <a href="/register" target="_blank">User Register</a>
                </li>
                <li>
                    <a href="/login" target="_blank">User Login</a>
                </li>
                <li>
                    <a href="/contactUsForm" target="_blank">Contact Admin</a>
                </li>
                <li>
                    <a href="/ratePharmacy" target="_blank">Rate Pharmacy</a>
                </li>
                <li>
                    <a href="http://localhost/phpmyadmin/" target="_blank">PhpMyAdmin</a>
                </li>
                <li>
                    <a href="https://github.com/Anum1212/pharmacyFYP" target="_blank">GitHub</a>
                </li>
                <li>
                    <a href="/test" target="_blank">Test Route</a>
                </li>
            </ul>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>