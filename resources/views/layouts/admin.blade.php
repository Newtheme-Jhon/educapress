@props(['breadcrumb' => []])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dashboard') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!--ckeditor cdn css-->
        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />


        <!--fontawesome-->
        <script src="https://kit.fontawesome.com/e56b8ec04c.js" crossorigin="anonymous"></script>

        <!-- Required Core Stylesheet
        https://glidejs.com/docs/setup/ -->
        <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.core.min.css">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body x-data="{open:false}" :class="{'overflow-hidden': open}" class="sm:overflow-auto bg-gray-50">

      @include('layouts.includes.admin.navbar')
      @include('layouts.includes.admin.sidebar')

      <div class="p-4 sm:ml-64">
        <div class="mt-14">
            @include('layouts.includes.admin.breadcrumb')
            <div class="p-6 bg-white rounded-lg shadow-lg">
                {{$slot}}
            </div>
        </div>
      </div>

      <div x-on:click="open = false" style="display:none" x-show="open" class="bg-gray-900 bg-opacity-50 fixed inset-0 z-30 sm:hidden"></div>

      @stack('modals')

        @livewireScripts

        @stack('js')
    </body>
</html>
