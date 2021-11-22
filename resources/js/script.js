$(document).ready(function () {
    $('.navbar-toggler').click(function () {
        $('.icon').toggleClass('fa-times');
        $('.icon').toggleClass('fa-bars');
    });

    $('.messenger').click(function () {
        $('.toggle-class').toggle();
    });

    $('.close').click(function () {
        $('.toggle-class').hide();
    });

    $('.hapo-slide-block').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        prevArrow: $('.prev'),
        nextArrow: $('.next'),
        responsive: [
            {
                breakpoint: 980,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ]
    });

    $('[data-toggle="tooltip"]').tooltip();

    if ($("#exampleModal input").hasClass("is-invalid")) {
        $("#exampleModal").modal("show");
    }

    if ($("#myModal input").hasClass("is-invalid")) {
        $("#myModal").modal("show");
    }

    $(".card-link-more").click(function() {
        $("#loginDefault, #registerDefault").val(
            $(this).next()
                .val()
        );
    });

    $('.btn-edit-mess').click(function(e){
        e.preventDefault();
        var a = $(this).closest('div.hapo-form-review').children('.hapo-review-drop').attr('id');
        var b = $(this).closest('div.hapo-form-review').children('.hapo-content-review').attr('id');
        var c = $(this).closest('div.hapo-form-review').children('.hapo-form-review-hidden').attr('id');

        document.getElementById(a).style.display = 'none';
        document.getElementById(b).style.display = 'none';
        document.getElementById(c).style.display = 'block';

        $('.cancelLesson').click (function (event) {
            event.preventDefault();
            document.getElementById(a).style.display = 'block';
            document.getElementById(b).style.display = 'block';
            document.getElementById(c).style.display = 'none';
        })
    });

    // search filter
    $(document).ready(function() {
        $('#myInput').on('keyup', function(event) {
            event.preventDefault();
            var key = $(this).val().toLowerCase();
            $('#myTable tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(key)>-1);
            });
        });
    });

    var fullRating = $('#fiveStarVal').val();
    var fourStar = $('#fourStarVal').val();
    var threeStar = $('#threeStarVal').val();
    var twoStar = $('#twoStarVal').val();
    var oneStar = $('#oneStarVal').val();
    $('#fiveStar').width(fullRating);
    $('#fourStar').width(fourStar);
    $('#threeStar').width(threeStar);
    $('#twoStar').width(twoStar);
    $('#oneStar').width(oneStar);

    $(document).ready(function(){
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#nav-tab a[href="' + activeTab + '"]').tab('show');
        }
    });

    setTimeout(function() {
        $('#myAlert').fadeOut('slow');
    }, 5000);

    function preview_image(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('#output_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#avatar").change(function() {
        preview_image(this);
        $('#output_image').removeClass('d-none').addClass('d-block');
    });

    $( ".filter-show" ).hide();

    $('.filter-toggle').click(function () {
        $('.filter-show').toggle();
    });
});
