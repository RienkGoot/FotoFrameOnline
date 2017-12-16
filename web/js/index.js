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

// Google Translator
function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'nl', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}