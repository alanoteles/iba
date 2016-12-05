
// ================== crop
window.onload = function() {
    var options =
    {
        imageBox: '.imageBox',
        thumbBox: '.thumbBox',
        spinner: '.spinner',
        imgSrc: 'image.png'
    }
    var cropper;
    document.querySelector('#file').addEventListener('change', function(){
      var reader = new FileReader();
      reader.onload = function(e) {
          options.imgSrc = e.target.result;
          cropper = new cropbox(options);
      }
      reader.readAsDataURL(this.files[0]);

      name_arquivo = this.files[0].name;
      size_arquivo = this.files[0].size;
      size_arquivo = parseInt(size_arquivo)/1000;
      mb = "kb";
      if(size_arquivo > 1000){
        size_arquivo = parseInt(size_arquivo)/1000;
        mb = "mb";
      }
      
      jQuery(".dados-arquivo span").html( name_arquivo + " (" + size_arquivo + mb + ")");
      jQuery(".container-crop-parceiros .action").addClass("active");
      jQuery("#btnCrop").addClass("btn-crop-active");
      jQuery("#btnCropCancelar").addClass("btn-crop-active");
      jQuery(".container-crop-parceiros .imageBox").addClass("cursor-move");
      
      // console.log( name_arquivo + " - " + size_arquivo );

      this.files = [];
    })
    document.querySelector('#btnCrop').addEventListener('click', function(){
      var img = cropper.getAvatar()

      // Adicionar a imagem na galeria
      jQuery(".parceiros-galeria img").attr("src",img);
      //Adicionado dado base64 no campo oculto para salvar
      jQuery("#base64_image").attr("value",img);

      jQuery(".dados-arquivo span").html( "nenhum arquivo selecionado" );
      jQuery(".container-crop-parceiros .action").removeClass("active");
      jQuery("#btnCrop").removeClass("btn-crop-active");
      jQuery("#btnCropCancelar").removeClass("btn-crop-active");
      jQuery(".container-crop-parceiros .imageBox").css({"background":"url('assets/images/fundo-crop-parceiros.png') top center no-repeat"});
      jQuery(".container-crop-parceiros .imageBox").removeClass("cursor-move");
      jQuery("#file").val("");
      /*
      $.ajax({
        type: "POST",
        url: "upload.php",
        data: img1,
        success: function( resultado ){
          alert( resultado );
        }
      });
      */
      
      // document.querySelector('.cropped').innerHTML = '<a href="'+img.replace("image/jpeg", "image/octet-stream")+'" download="image.jpg">download</a>';
    })
    document.querySelector('#btnCropCancelar').addEventListener('click', function(){
      jQuery(".dados-arquivo span").html( "nenhum arquivo selecionado" );
      jQuery(".container-crop-parceiros .action").removeClass("active");
      jQuery("#btnCrop").removeClass("btn-crop-active");
      jQuery("#btnCropCancelar").removeClass("btn-crop-active");
      jQuery(".container-crop-parceiros .imageBox").css({"background":"url('assets/images/fundo-crop-parceiros.png') top center no-repeat"});
      jQuery(".container-crop-parceiros .imageBox").removeClass("cursor-move");
      jQuery("#file").val("");
    })
    document.querySelector('#btnZoomIn').addEventListener('click', function(){
        cropper.zoomIn();
    })
    document.querySelector('#btnZoomOut').addEventListener('click', function(){
        cropper.zoomOut();
    })
};

// function download_image( img ){
//     var image = img.replace("image/jpeg", "image/octet-stream"); // here is the most important part because if you dont replace you will get a DOM 18 exception.
//     window.location.href=image;
// }    

// / ================== Crop

