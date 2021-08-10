var url = 'http://instagram-mini.test';

window.addEventListener("load", function() {

    //Seleccionamos el html clickado con name = like
    $('[name="like"]').click(function(){
        console.log('item clicked'+ $(this));

     //Comprobamos si tiene clase off u on y lo cambiamos

    if($(this).hasClass( "off" )){

        $(this).addClass('on').removeClass('off')
        $(this).attr('src',url+'/img/heart-red.png')

        $.ajax({
            url: url+'/like/'+$(this).data('id'),
            type: 'GET',
            success: function(response){
                if(response.like){
                    console.log('Has dado like a la publicacion');
                }else{
                   console.log('Error al dar like'); 
                }
            }
        });

    }else{

        $(this).addClass('off').removeClass('on')     
        $(this).attr('src',url+'/img/heart-black.png')

        $.ajax({
            url: url+'/dislike/'+$(this).data('id'),
            type: 'GET',
            success: function(response){
                if(response.like){
                    console.log('Has dado dislike a la publicacion');
                }else{
                   console.log('Error al dar dislike'); 
                }
                
            }
        });
    }

    });

});

$('#edit').on('show.bs.modal', function(event){
    console.log('modal editar');
    var button = $(event.relatedTarget)
    
    var image_id    = button.data('imageId')
    var imagen      = button.data('nombre')
    var description = button.data('description')

    var modal = $(this)

    modal.find('.modal-body #image_id').val(image_id);
    modal.find('.modal-body #image_path').val(imagen);
    modal.find('.modal-body #description').val(description);
})

$('#delete').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)

    var cat_id = button.data('catid')
    var modal = $(this)

    modal.find('.modal-body #cat_id').val(cat_id);
})

$('#submit-prevent-form').on('submit', function(event){
    $('.submit-prevent-button').attr('disabled', 'true');  
    $('.spinner').show();
})
