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
  #play_area{
    position: fixed;
    bottom: -1000px;
  }
</style>
@endsection
@section('page')
<div class="content-wrap">
  <div class="pt-120 pb-10 bg-gray-light callToActionPrev">
    <div class="container">
      <div class="row mb-50">
        <div class="col-12 text-center">
          <h2 class="m-0 animated" data-show="startbox" data-show-delay="100"
            style="transform: translateY(0px); transition-duration: 500ms; opacity: 1;">Album "{{$album->name}}" Images</h2>
            
        </div>
      </div>
      <div class="row">
        <div class="mx-auto col-8 col-sm-5 col-md-4 col-lg-3">
          <a href="/dashboard" class="swiper-button-prev w-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
              <path fill="currentColor" fill-rule="evenodd" d="m3.96 6.15 5.08-4.515L7.91.365.445 7l7.465 6.635 1.13-1.27L3.96 7.85h15.765v-1.7H3.96Z" clip-rule="evenodd"></path>
            </svg> 
            <span class="ms-5">Back to dashboard</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<form id="upload-widget" method="post" action="/dashboard/{{$album->id}}/store_images" class="dropzone text-center" enctype="multipart/form-data">
  @csrf
</form>

{{-- modals --}}
<div class="modal fade" id="showImageModal" tabindex="-1" role="dialog" aria-labelledby="showImageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header p-25">
        <h5 class="modal-title" id="showImageModalLabel">Show Image</h5>
        <button type="button" class="close btn p-1 fs-5" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-25">
        <div class="container">
          <div class="row mb-10">
            <div class="col-12 col-sm-4 text-end d-flex d-sm-block">
              <label for="#image_name">Image Name: </label>
            </div>
            <div class="col-12 col-sm-8">
              <input class="form-control py-5" type="text" placeholder="Set Name *" id="image_name">
            </div>
          </div>
          <div class="row mb-10">
            <div class="col-12 col-sm-4 text-end d-flex d-sm-block">
              <label for="#image_link">Image Public Link: </label>
            </div>
            <div class="col-12 col-sm-8">
              <input class="form-control py-5" type="text" placeholder="Link" disabled id="image_link">
              <div class="text-center">

                <div id="play_area"><input type="text"/></div>
                <button class="btn btn-sm btn-success" id="copy_img_link" type="button">Copy Link</button>
                <button class="btn btn-sm btn-warning" id="reset_img_token">Reset token</button>
              </div>
            </div>
          </div>
          <div class="row mb-10">
            <div class="col-8 col-sm-4 text-end d-flex d-sm-block">
              <label for="#image_is_public">Image Is Public: </label>
            </div>
            <div class="col-2 col-sm-8">
              <input class="form-check-input" type="checkbox" id="image_is_public">
            </div>
          </div>
          <div class="row">
            <div class="col-12 text-center">
              <img src="/img/album.png" class="show_image mw-100">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer p-10 mx-auto">
        <button type="button" class="btn btn-success close" data-dismiss="modal" id="save_img_changes">Save Changes</button>
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
  var img_info_array = {};
  var selected_img_name,selected_img_ext,selected_img_token,selected_img_is_public;
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
      img_info_array[response.name] = {}
      img_info_array[response.name].ext = response.ext
      img_info_array[response.name].token = response.token
      img_info_array[response.name].is_public = response.is_public

      $(file.previewElement).find('.dz-image img').attr('alt',response.name)
      $(file.previewElement).find('[data-dz-name]').text(response.name)

      
      set_images_set()
    },
    error: function(file, response)
    {
      return false;
    }
  });

  @foreach ($images as $image)
  var mockFile = { name: "{{$image->name}}", size: {{ filesize(file_exists(storage_path('app/users/'.$uid.'/albums/'.$album->id.'/'.$image->name.'.'.$image->ext))?storage_path('app/users/'.$uid.'/albums/'.$album->id.'/'.$image->name.'.'.$image->ext):null) + 0 }} };
  myDropzone.displayExistingFile(mockFile, "/users/{{$uid}}/albums/{{$album->id.'/'.$image->name.'.'.$image->ext}}",null,null,true);
  img_info_array['{{$image->name}}'] = {}
  img_info_array['{{$image->name}}'].ext = '{{$image->ext}}'
  img_info_array['{{$image->name}}'].token = '{{$image->token}}'
  img_info_array['{{$image->name}}'].is_public = '{{$image->is_public}}'
  
  @endforeach

  function set_images_set(){
    $(".dz-preview").off('click')
    $(".dz-preview").on('click',function(){
      selected_img_name = $(this).find('.dz-image img').attr('alt');
      selected_img_ext = img_info_array[selected_img_name].ext
      selected_img_token = img_info_array[selected_img_name].token
      selected_img_is_public = img_info_array[selected_img_name].is_public

      $(".show_image").attr('src', '/users/{{$uid}}/albums/{{$album->id}}/' + selected_img_name + '.' + selected_img_ext)
      $("#showImageModalLabel").text(selected_img_name + '.' + selected_img_ext)
      $("#showImageModal #image_name").val(selected_img_name)
      $("#showImageModal #image_link").val('/public-albums/{{$album->id}}/file/' + selected_img_name + '.' + selected_img_ext + '?token=' + selected_img_token)
      
      $("#showImageModal #image_is_public").prop("checked", parseInt(selected_img_is_public))
      $("#showImageModal").modal('show')
    })
  }
  set_images_set()

  $("#save_img_changes").click(function(){
    $.ajax({
      url: '/dashboard/{{$album->id}}/update_image/'+selected_img_name,
      type: 'post',
      data: {
        new_img_name: $("#showImageModal #image_name").val(),
        is_public: ($("input#image_is_public:checked").val() ? 1 : 0),
      },
      success: data=>{
        var elem = $('[alt="'+data.old_name+'"]').parents('.dz-preview.dz-image-preview')
        delete img_info_array[data.old_name];
        img_info_array[data.new_name] = {}
        img_info_array[data.new_name].ext = data.ext
        img_info_array[data.new_name].token = data.token
        img_info_array[data.new_name].is_public = data.is_public
        elem.find('.dz-image img').attr('alt',data.new_name)
        elem.find('[data-dz-name]').text(data.new_name)

        $.toast({
          heading: 'Saved successfully.',
          icon: 'success'
        })
      }
    });
  })
  $("#copy_img_link").click(function(){
    $('#play_area>input').val(window.location.origin+$('#image_link').val())
    $('#play_area>input').select()
    document.execCommand('copy')
    $.toast({
      heading: 'Copied.',
      icon: 'success'
    })
  })

  $("#reset_img_token").click(function(){
    $.ajax({
      url: '/dashboard/{{$album->id}}/update_image/'+ selected_img_name,
      type: 'post',
      data: {
        _method: 'put'
      },
      success: data=>{
        img_info_array[selected_img_name].token = data.token
        $("#showImageModal #image_link").val('/public-albums/{{$album->id}}/file/' + selected_img_name + '.' + selected_img_ext + '?token=' + data.token)
        $.toast({
          heading: 'Image Token Changed.',
          icon: 'success'
        })
      },
      error: data=>{
        $.toast({
          heading: 'Something went wrong!',
          icon: 'error'
        })
      }
    });
  });
})





</script>
@endsection