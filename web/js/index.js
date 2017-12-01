// Toggle sidebar menu
$(function () {
    $('.navbar-toggle-sidebar').click(function () {
        $('.navbar-nav').toggleClass('slide-in');
        $('.side-body').toggleClass('body-slide-in');
        $('#search').removeClass('in').addClass('collapse').slideUp(200);
    });

    $('#search-trigger').click(function () {
        $('.navbar-nav').removeClass('slide-in');
        $('.side-body').removeClass('body-slide-in');
        $('.search-input').focus();
    });
});

// Chosen selection
$(document).ready(function(){
    $(".chosen-select").chosen({
        placeholder_text_multiple: "Selecteer de onderdelen",
        no_results_text: "Niks gevonden..",
        width: "40%"
    })
});

// Search in ul and li tags.
$(function(){
    $("#target").keyup(function(){
        var searchText = $(this).val();
        $('ul > li').each(function(){
            var currentLiText = $(this).text(),
                showCurrentLi = currentLiText.indexOf(searchText) !== -1;
            $(this).toggle(showCurrentLi);
        });
    });
});

// Frame upload handling
var canvas = new fabric.Canvas('imageCanvas', {
    backgroundColor: 'rgb(255,255,255)'
});

var imageLoader = document.getElementById('imageLoader');
imageLoader.addEventListener('change', handleImage, false);

function handleImage(e) {
    var reader = new FileReader();
    reader.onload = function (event) {
        var img = new Image();
        img.onload = function () {
            var imgInstance = new fabric.Image(img, {
                scaleX: 0.8,
                scaleY: 0.8
            })
            canvas.add(imgInstance);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
}

var imageSaver = document.getElementById('imageSaver');
imageSaver.addEventListener('click', saveImage, false);

// Remove selected object
$('#remove').click(function(){
    var object = canvas.getActiveObject();
    if (!object){
        alert('Selecteer een afbeelding om te verwijderen.');
        return '';
    }
    canvas.remove(object);
});