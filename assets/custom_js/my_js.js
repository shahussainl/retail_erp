//var inputLocalFont = document.getElementById("product_images");
//      inputLocalFont.addEventListener("change",previewImages,false); //bind the function to the input
//
//      function previewImages(){
//          var fileList = this.files;
//
//          var anyWindow = window.URL || window.webkitURL;
//
//              for(var i = 0; i < fileList.length; i++){
//                //get a blob to play with
//                var objectUrl = anyWindow.createObjectURL(fileList[i]);
//                // for the next line to work, you need something class="preview-area" in your html
//                $('.preview-area').append('<div class="col-md-4"><img src="' + objectUrl + '" /><input type="text" class="form-control" name="title[]" /><div class="custom-control custom-checkbox"><input class="custom-control-input" id="'+i+'" type="checkbox" name="profile_pic" value="'+i+'"><label class="custom-control-label" for="'+i+'">Make It Profile Picture <span></span> </label></div></div>');
//                // get rid of the blob
//                window.URL.revokeObjectURL(fileList[i]);
//              }
//
//
//      }