<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Album App">
  <meta name="author" content="Abdalla Nabil">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="icon" type="image/png" href="/img/favicon.png">
  <link rel="stylesheet" href="/css/magnific-popup.css">
  <link rel="stylesheet" href="/css/dropzone.min.css">
  <link rel="stylesheet" href="/css/jquery.toast.min.css">
  <link rel="stylesheet" href="/css/main.css">
  @yield('css')
</head>

<body>
  @include('components.navbar')

  @yield('page')

  @include('components.footer')
  
  <script src="/js/jquery.min.js"></script>
  <script src="/js/bootstrap.js"></script>
  <script src="/js/jquery.toast.min.js"></script>
  <script src="/js/imagesloaded.pkgd.js"></script>
  <script src="/js/jquery.magnific-popup.js"></script>
  <script src="/js/jquery.inview.js"></script>
  <script src="/js/helpers.js"></script>
  <script src="/js/show-on-scroll.js"></script>
  <script src="/js/navbar.js"></script>
  <script src="/js/others.js"></script>
  <script src="/js/dropzone.min.js"></script>
  <script>
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
    $('.modal .close').click(function(){
      $(this).parents('.modal').modal('hide')
    })
  });
  function b64toBlob(b64Data, contentType, sliceSize) {
      contentType = contentType || '';
      sliceSize = sliceSize || 512;

      var byteCharacters = atob(b64Data);
      var byteArrays = [];

      for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
          var slice = byteCharacters.slice(offset, offset + sliceSize);

          var byteNumbers = new Array(slice.length);
          for (var i = 0; i < slice.length; i++) {
              byteNumbers[i] = slice.charCodeAt(i);
          }

          var byteArray = new Uint8Array(byteNumbers);

          byteArrays.push(byteArray);
      }

      var blob = new Blob(byteArrays, {type: contentType});
      return blob;
    }
  </script>
  @yield('script')
</body>

</html>