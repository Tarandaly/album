@extends('layout.main')

@section('title') Album @endsection

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
  <div class="pt-120 pb-100 bg-gray-light callToActionPrev">
    <div class="container">
      <div class="row mb-90">
        <div class="col-lg-4 offset-lg-4 text-center"><span class="badge bg-light text-dark mb-20 animated"
            data-show="startbox" style="transform: translateY(0px); transition-duration: 500ms; opacity: 1;">Albums</span>
          <h2 class="m-0 animated" data-show="startbox" data-show-delay="100"
            style="transform: translateY(0px); transition-duration: 500ms; opacity: 1;">All Albums You Have</h2>
        </div>
      </div>
      <div class="row mb-30">
        @foreach($albums as $album)
        <div class="col-12 col-md-6 col-lg-4 animated" data-show="startbox"
          style="transform: translateY(0px); transition-duration: 500ms; opacity: 1;">
          <div class="service-case lift rounded-4 bg-white shadow overflow-hidden"><a class="service-case-image"
              href="/dashboard/{{$album->id}}" data-img-height="" style="--img-height: 64%;"><img loading="lazy"
                src="/img/album.png" alt=""></a>
            <div class="service-case-body position-relative">
              <a
                href="javascript:;"
                class="circle-icon circle-icon-sm text-white bg-accent-1 position-absolute me-50 top-0 end-0 translate-middle-y card_btn_c"
                data-bs-toggle="modal"
                data-bs-target="#editAlbumModal"
                data-album_name="{{$album->name}}"
                data-album_id="{{$album->id}}"
                >
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="36" fill="none">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.3" d="M19 34h17M27.5 3.161a4.044 4.044 0 0 1 5.667 0c.372.368.667.805.868 1.287a3.93 3.93 0 0 1-.868 4.32L9.556 32.131 2 34l1.889-7.476L27.5 3.16Z"></path>
                </svg>
              </a>
              <h4 class="service-case-title mb-15">{{$album->name}}</h4>
              <p class="service-case-text font-size-15 mb-30">Images Count: {{$album->img_count}}</p><a class="service-case-arrow stretched-link" href="/dashboard/{{$album->id}}"><svg
                  xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                  <path stroke="currentColor" stroke-width="1.7" d="M0 7h18m0 0-6.75-6M18 7l-6.75 6"></path>
                </svg></a>
            </div>
          </div>
        </div>
        @endforeach
        <div class="col-12 col-md-6 col-lg-4 animated" data-show="startbox"
          style="transform: translateY(0px); transition-duration: 500ms; opacity: 1;">
          <div class="service-case lift rounded-4 bg-white shadow overflow-hidden" data-bs-toggle="modal"
          data-bs-target="#newAlbumModal"><a class="service-case-image"
              href="javascript:;" data-img-height="" style="--img-height: 64%;"><img loading="lazy"
                src="/img/orange-plus-icon-3.png" alt=""></a>
            <div class="service-case-body position-relative">
              <h4 class="service-case-title mb-15">New Album 33</h4>
              <a class="service-case-arrow stretched-link" href="javascript:;"><svg
                  xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                  <path stroke="currentColor" stroke-width="1.7" d="M0 7h18m0 0-6.75-6M18 7l-6.75 6"></path>
                </svg></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <form method="post" action="upload.php" class="dropzone" enctype="multipart/form-data">
  @csrf
</form> --}}

{{-- modals --}}
<div class="modal fade" id="editAlbumModal" tabindex="-1" role="dialog" aria-labelledby="editAlbumModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header p-25">
        <h5 class="modal-title" id="editAlbumModalLabel">Modal title</h5>
        <button type="button" class="close btn p-1 fs-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-25">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-10 mx-auto">
              <input class="form-control album_name_input fs-5" type="text" placeholder="Album Name *" maxlength="50">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer p-10 mx-auto">
        <button type="button" class="btn btn-danger close ms-auto" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary me-auto" id="update_album">Save changes</button>
        <hr class="w-100">
        <button type="button" class="btn btn-primary mx-auto" id="create_new_album">Create</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="newAlbumModal" tabindex="-1" role="dialog" aria-labelledby="newAlbumModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header p-25">
        <h5 class="modal-title" id="newAlbumModalLabel">New Album</h5>
        <button type="button" class="close btn p-1 fs-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-25">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-10 mx-auto">
              <input class="form-control new_album_name_input fs-5" type="text" placeholder="Album Name *" maxlength="50">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer p-10 mx-auto">
        <button type="button" class="btn btn-danger close" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="create_new_album">Create</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
  var album_id;
  $('#editAlbumModal').on('show.bs.modal', function (event) {
    console.log(event)
    var button = $(event.relatedTarget)
    var album_name = button.data('album_name')
    album_id = button.data('album_id')
    var modal = $(this)
    modal.find('.modal-title').text('Edit ' + album_name + ' Album')
    modal.find('.modal-body .album_name_input').val(album_name)
  })

  $("#update_album").click(function(){
    $.ajax({
      url: "/dashboard/" + album_id,
      type: "post",
      data: {
        album_name: $(".album_name_input").val()
      },
      success: data=>{
        console.log(data)
        if(data == 'success!'){
          window.location.reload();
        }
      }
    })
  })

  $("#create_new_album").click(function(){
    $.ajax({
      url: "/new_album",
      type: "post",
      data: {
        album_name: $(".new_album_name_input").val()
      },
      success: data=>{
        console.log(data)
        if(data == 'success!'){
          window.location.reload();
        }
      }
    })
  })
})

Dropzone.options.dropzone = {
  maxFilesize: 12,
  paramName: "image",
  renameFile: function(file) {
      var dt = new Date();
      var time = dt.getTime();
      return time+file.name;
  },
  acceptedFiles: ".jpeg,.jpg,.png,.gif",
  addRemoveLinks: true,
  timeout: 5000,
  maxFiles:1,
  init: function() {
    this.on('addedfile', function(file) {
      if (this.files.length > 1) {
        this.removeFile(this.files[0]);
      }
    });
  },
  removedfile: function(file) {
    var name = file.upload.filename;
    $.ajax({
      type: 'POST',
      url: '{{ url("image/delete") }}',
      data: {
        filename: name
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
  },
  error: function(file, response)
  {
      return false;
  }
};
</script>
@endsection