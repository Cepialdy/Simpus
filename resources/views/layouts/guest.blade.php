<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    @vite('resources/sass/app.scss')

    <!-- Custom Styling -->
    <style>
        /* Soft and Elegant Styling */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            overflow: hidden;
            color: #333;
        }

        .full-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .auth-cover-wrapper,
        .signin-wrapper {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-cover-wrapper .auth-cover .shape-image {
            position: absolute;
            bottom: 25%;
            width: 80%;
            opacity: 0.8;
        }

        /* Smooth animations */
        .fade-in {
            animation: fadeIn ease 1s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .full-screen {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body class="fade-in">

<div class="row g-0 auth-row">
    <div class="full-screen">
        @yield('content')
    </div>
</div>

</body>
</html>
