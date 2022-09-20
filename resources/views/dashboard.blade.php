@extends('layout.main')

@section('title') Album - Dashboard @endsection

@section('css')
<style>
  .card_btn_c{
    z-index: 999;
  }
  .card_btn_c:hover{
    box-shadow: 0px 1px 8px #000;
  }
  .as-centar{
    align-self: center;
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
                data-album_has_img="{{($album->img_count > 0) ? 'true':'false'}}"
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
              <h4 class="service-case-title mb-15">New Album</h4>
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
        <button type="button" class="btn btn-warning close ms-auto" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary me-auto" id="update_album">Save changes</button>
        <hr class="w-100">
        <button type="button" class="btn btn-danger mx-auto" id="check_delete_album">Delete Album</button>
      </div>
    </div>
  </div>
</div>

{{-- confirm Delete Album Modal --}}
<div class="modal fade" id="confirmDeleteAlbumModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteAlbumModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header p-25">
        <h5 class="modal-title" id="confirmDeleteAlbumModalLabel">Attention!</h5>
        <button type="button" class="close btn p-1 fs-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-25">
        <div class="container">
          <div class="row">
            <div class="col-12 mx-auto text-center">
              <h3 class="delete_album_msg mb-10"></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer p-0 mx-auto" style="justify-content:space-evenly;">
        <button type="button" class="btn btn-danger" id="delete_album_and_images">Delete Album And All Images Inside</button>
        <button type="button" class="btn btn-danger" id="delete_album">Delete Album</button>
        <button type="button" class="btn btn-warning close" id="delete_album_and_transfer_images" data-dismiss="modal">Delete Album And Transfer Album Images To Another Albom</button>
        <button type="button" class="btn btn-primary close" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

{{-- chose another album --}}
<div class="modal fade" id="choseAnotherAlbumModal" tabindex="-1" role="dialog" aria-labelledby="choseAnotherAlbumModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header p-25">
        <h5 class="modal-title" id="choseAnotherAlbumModalLabel">Attention!</h5>
        <button type="button" class="close btn p-1 fs-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-25">
        <div class="container">
          <div class="row chose_album_div">
            
          </div>
        </div>
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
  var all_albums = @json($albums);
$(document).ready(function(){
  var album_id;
  var album_has_img;
  var another_album_id;
  $('#editAlbumModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var album_name = button.data('album_name')
    album_id = button.data('album_id')
    album_has_img = button.data('album_has_img')
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
        if(data == 'success!'){
          window.location.reload();
        }
      }
    })
  });


  //confirm delete album->>>>>>
  $("#check_delete_album").click(function(){
    $("#editAlbumModal").modal('hide')
    $("#confirmDeleteAlbumModal").modal('show')

    if(album_has_img){
      console.log('album_has_img')
      $(".delete_album_msg").text('This album contains Images!')
      $("#delete_album_and_images,#delete_album_and_transfer_images").show()
      $("#delete_album").hide()


    }else{
      $(".delete_album_msg").text('Are you sure you want to clear this Album!');
      $("#delete_album_and_images,#delete_album_and_transfer_images").hide()
      $("#delete_album").show()
    }

  });

  $("#delete_album_and_images,#delete_album").click(function(){
    $.ajax({
      url: '/delete_album_and_images/'+album_id,
      type: 'post',
      success: data =>{
        window.location.reload()
      }
    })
  });
  $("#delete_album_and_transfer_images").click(function(){
    $("#choseAnotherAlbumModal").modal('show')


    
  });

  $('#choseAnotherAlbumModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    $(".chose_album_div").html('')
    for(var alb = 0; alb < all_albums.length; alb++){
      if(all_albums[alb].id != album_id){
        $(".chose_album_div").append('<div class="col animated" data-show="startbox" data-show-delay="700" style="transform: translateY(0px); transition-duration: 500ms; opacity: 1;"><a class="brand rounded-2 bg-gray-light text-dark brand-sm chose_album_it" album_id="'+all_albums[alb].id+'" href="javascript:;"><h4 class="as-centar mb-0">'+all_albums[alb].name+'</h4></a></div>')
      }
    }
    if(all_albums.length == 1){
      $(".chose_album_div").append('no albums to chose!')
    }

    $('.chose_album_it').click(function(){
      another_album_id = $(this).attr('album_id')
      $.ajax({
        url: '/delete_album_and_transfer_images/'+album_id,
        type: 'post',
        data: {
          another_album_id: another_album_id
        },
        success: data =>{
          window.location.reload()
        }
      })
    })

    var modal = $(this)
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