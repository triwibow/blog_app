<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/app.css')}}">
    <script src="{{asset('assets/js/jquery.js')}}"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="{{route('blog.index')}}">My Application</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item @if($title == 'Blog') active @endif mr-2">
                        <a class="nav-link" href="{{route('blog.index')}}">Home</a>
                    </li>
                    <li class="nav-item @if($title == 'Post') active @endif mr-2">
                        <a class="nav-link" href="{{route('post.index')}}">Post</a>
                    </li>
                    <li class="nav-item @if($title == 'Account') active @endif mr-2">
                        <a class="nav-link" href="{{route('account.index')}}">Akun</a>
                    </li>
                    
                    @if(Session::has('u'))
                    <li class="nav-item  @if($title == 'Login') active @endif mr-2">
                        <a class="nav-link" href="{{route('logout')}}">Logout</a>
                    </li>
                    @else
                    <li class="nav-item  @if($title == 'Login') active @endif mr-2">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>