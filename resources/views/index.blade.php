@extends('layout.main')

@section('title') Album @endsection

@section('css')
<style>
  .social_icon svg {
    transform: scale(1.5);
  }

  .bg-linear-gradient {
    background-image: -webkit-linear-gradient(180deg, #d6cffb 0%, rgb(255 255 255 / 0%) 100%));
    background-image: linear-gradient(180deg, #d6cffb 0%, rgb(255 255 255 / 0%) 100%);
  }

  .area {
    position: fixed;
    top: 0;
    width: 100%;
    height: 100vh;
  }

  .circles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }

  .circles li {
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: #539eff47;
    animation: animate 25s linear infinite;
    bottom: -150px;

  }

  .circles li:nth-child(1) {
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
  }


  .circles li:nth-child(2) {
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
  }

  .circles li:nth-child(3) {
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
  }

  .circles li:nth-child(4) {
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
  }

  .circles li:nth-child(5) {
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
  }

  .circles li:nth-child(6) {
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
  }

  .circles li:nth-child(7) {
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
  }

  .circles li:nth-child(8) {
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
  }

  .circles li:nth-child(9) {
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
  }

  .circles li:nth-child(10) {
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
  }



  @keyframes animate {

    0% {
      transform: translateY(0) rotate(0deg);
      opacity: 1;
      border-radius: 0;
    }

    100% {
      transform: translateY(-1000px) rotate(720deg);
      opacity: 0;
      border-radius: 50%;
    }

  }

  .m-llla {
    color: #3a70b5;
  }
</style>
@endsection
@section('page')
<!-- Shape-->
<div class="area">
  <ul class="circles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>
</div>
<div class="content-wrap">
  <div class="pt-180 bg-linear-gradient shape-parent text-center" style="padding-bottom: 220px;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <h1 class="mb-30 px-lg-30" data-show="startbox">
            <span class="highligh"> <span class="m-llla">M</span>y <span class="m-llla">A</span>lbum </span>
          </h1>
        </div>
      </div>
    </div>
  </div>
  <div class="pb-130 mt-n180 text-center">
    <div class="container">
      <div class="row gy-50">
        <div class="isotope-item col-12 col-md-6 col-lg-4 mx-auto" data-show="startbox">
          <a class="card card-portfolio card-overlay card-hover-appearance text-white text-center rounded-4"
            href="/login">
            <span class="card-img" data-img-height style="--img-height: 100%;">
              <img loading="lazy" src="/img/album.png" alt="" />
              <span class="background-color" style="--background-color: rgba(240, 31, 75, 0.9);"></span>
            </span>
            <span class="card-img-overlay">
              <span class="card-title h4">Create Album</span>
              <!-- <span class="card-category subtitle">Marketing</span> -->
            </span>
          </a>
        </div>
        <div class="isotope-item col-12 col-md-6 col-lg-4 mx-auto" data-show="startbox">
          <a class="card card-portfolio card-overlay card-hover-appearance text-white text-center rounded-4"
            href="/login">
            <span class="card-img" data-img-height style="--img-height: 100%;">
              <img loading="lazy" src="/img/uimage.png" alt="" />
              <span class="background-color" style="--background-color: rgba(240, 31, 75, 0.9);"></span>
            </span>
            <span class="card-img-overlay">
              <span class="card-title h4">Ubload Images</span>
              <!-- <span class="card-category subtitle">Marketing</span> -->
            </span>
          </a>
        </div>
      </div>
      <div class="text-center mt-70" data-show="startbox">
        <!-- Button-->
        <a class="btn btn-lg btn-accent-1" href="/login">Try It Now</a>
      </div>
    </div>
  </div>
</div>
@endsection