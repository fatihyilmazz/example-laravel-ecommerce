jQuery(document).ready(function() {
    $(".page--loading").fadeOut("slow");
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// When perPage input changed submit filter form for new data
function submitFilterForm() {
    $( ".filter-form" ).submit();
}
