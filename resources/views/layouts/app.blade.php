<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Task') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased bg-light">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="d-flex py-3 bg-white shadow-sm border-bottom">
            <div class="container">
                @yield('title')
            </div>
        </header>

        <!-- Page Content -->
        <main class="container my-5">
            @include('partial.flash')
            @yield('content')
        </main>
        <script src="{{asset('assets\plugins\jquery\jquery.min.js')}}"></script>
        <script>
            $('.delete').click(function (e) {
                e.preventDefault();

                let confirm=window.confirm('Are you sure you want to delete');

                if (confirm)
                {
                   let confirm_image=window.confirm('Are You Want To Delete Images');
                   if(confirm_image)
                    e.target.closest('form').submit();
                   else
                   {
                       // let xxxxx=$('#move');
                       // console.log(xxxxx);
                       // $('#move').trigger('click');
                       @if(isset($album))
                       window.location.href='{{route('albums.moveImage',$album)}}';
                       @endif
                   }

                }

            });
            $('.image').change(function (){
                if(this.files&&this.files[0]){
                    let reader=new FileReader();
                    reader.onload=function (e){
                        $('.image-preview').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            })

        </script>
    </body>
</html>
