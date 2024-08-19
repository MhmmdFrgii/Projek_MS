@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<body class="leading-normal tracking-normal text-indigo-400 m-6 bg-cover bg-fixed" style="background-image: url('/assets/images/header.png')">
    <div class="h-full">

      <!--Main-->
      <div class="container md:pt-36 flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ml-24">
          <h1 class="my-4 text-3xl md:text-5xl text-white opacity-75 font-bold leading-tight text-left md:text-left">
            Selamat
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">
              Datang Di Website
            </span>
            Manajemen Sekolah
          </h1>
          <p class="leading-normal text-base md:text-xl mb-8 text-left md:text-left text-slate-300">
            Sistem Manajemen Sekolah kami adalah solusi komprehensif untuk mengelola seluruh aspek administrasi sekolah dengan efisiensi dan kemudahan.
          </p>
        </div>

        <!--Right Col-->
        <div class="w-full xl:w-1/3 p-12 ml-40 overflow-hidden">
          <img class="mx-auto w-full md:w-4/5 transform -rotate-6 transition hover:scale-105 duration-700 ease-in-out hover:rotate-6" src="/assets/images/logo.png" />
        </div>
      </div>
    </div>
  </body>

  @endsection
