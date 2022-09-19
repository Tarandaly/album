@extends('layout.main')

@section('title') Album {{$album->name}} Images @endsection

@section('css')
<style>
  .card_btn_c{
    z-index: 999;
  }
  .card_btn_c:hover{
    box-shadow: 0px 1px 8px #000;
  }
</style>
@endsection
@section('page')
<div class="content-wrap">
  <div class="pt-120 pb-10 bg-gray-light callToActionPrev">
    <div class="container">
      <div class="row mb-90">
        <div class="col-12 text-center">
          <h2 class="m-0 animated" data-show="startbox" data-show-delay="100"
            style="transform: translateY(0px); transition-duration: 500ms; opacity: 1;">Album "{{$album->name}}" Images</h2>
            
        </div>
      </div>
      
    </div>
  </div>
</div>

<form id="upload-widget" method="post" action="/dashboard/{{$album->id}}/store_images" class="dropzone text-center" enctype="multipart/form-data">
  @csrf
  {{-- @foreach ($images as $image)
  <div class="dz-preview dz-processing dz-image-preview dz-complete">
    <div class="dz-image"><img data-dz-thumbnail="" alt="4237762-backgrounds.jpg" src="/usres/{{$uid}}/albums/{{$album->id.'/'.$image->name.'.'.$image->ext}}"></div>
    <div class="dz-details">
      <div class="dz-size"><span data-dz-size=""><strong>0.8</strong> MB</span></div> <div class="dz-filename"><span data-dz-name="">4237762-backgrounds.jpg</span></div> </div> <div class="dz-progress"> <span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span> </div> <div class="dz-error-message"><span data-dz-errormessage=""></span></div> <div class="dz-success-mark"> <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>Check</title> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF"></path> </g> </svg> </div> <div class="dz-error-mark"> <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <title>Error</title> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475"> <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"></path> </g> </g> </svg> </div> <a class="dz-remove" href="javascript:undefined;" data-dz-remove="">Remove file</a></div>
  @endforeach --}}
</form>

{{-- modals --}}
<div class="modal fade" id="showImageModal" tabindex="-1" role="dialog" aria-labelledby="showImageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header p-25">
        <h5 class="modal-title" id="showImageModalLabel">New Album</h5>
        <button type="button" class="close btn p-1 fs-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-25">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center">
              <img src="/img/album.png" class="show_image mw-100">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer p-10 mx-auto">
        <button type="button" class="btn btn-danger close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  
  Dropzone.autoDiscover = false;
$(document).ready(function(){
  var myDropzone = new Dropzone("#upload-widget", {
    maxFilesize: 12,
    url: "/dashboard/{{$album->id}}/store_images",
    paramName: "image",
    parallelUploads: 10,
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time+file.name;
    },
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.svg",
    addRemoveLinks: true,
    timeout: 5000,
    removedfile: function(file) {
      var name = file.name;
      // return console.log(file)
      $.ajax({
        type: 'POST',
        url: '{{ url("dashboard/".$album->id."/delete_image") }}',
        data: {
          img_name: name
        },
        success: function (data){
          console.log("File has been successfully removed!!");
        },
        error: function(e) {
          console.log(e);
        }
      });
      var fileRef;
      return (fileRef = file.previewElement) != null ? 
      fileRef.parentNode.removeChild(file.previewElement) : void 0;
    },
    success: function(file, response) 
    {
        console.log(response);
        $(".dz-preview").last().click(function(){
          $(".show_image").attr('src','/usres/{{$uid}}/albums/{{$album->id}}/' + response.success)
          $("#showImageModal").modal('show')
        })
        
    },
    error: function(file, response)
    {
        return false;
    }
  });
  
  var img_info_array = {};

  @foreach ($images as $image)
  var mockFile = { name: "{{$image->name}}", size: {{ filesize(file_exists(public_path('usres/'.$uid.'/albums/'.$album->id.'/'.$image->name.'.'.$image->ext))?public_path('usres/'.$uid.'/albums/'.$album->id.'/'.$image->name.'.'.$image->ext):null) + 0 }} };
  myDropzone.displayExistingFile(mockFile, "/usres/{{$uid}}/albums/{{$album->id.'/'.$image->name.'.'.$image->ext}}",null,null,true);
  img_info_array['{{$image->name}}'] = '{{$image->ext}}'
  
  @endforeach
  console.log(img_info_array)

  $(".dz-preview").click(function(){
    $(".show_image").attr('src', '/usres/{{$uid}}/albums/{{$album->id}}/' + $(this).children('.dz-image').children('img').attr('alt') + '.' + img_info_array[$(this).children('.dz-image').children('img').attr('alt')])
    $("#showImageModal").modal('show')
  })
})


</script>
@endsection