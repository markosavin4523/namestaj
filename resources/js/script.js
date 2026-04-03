$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(window).on('load', function() {
    $('#loader-wrapper').fadeOut('slow', function() {
        $(this).remove();
    });
});
$(document).ready(function (){

    //Dropwdown profile menu
    $("#header_username").click(function (e) {
        e.stopPropagation();
        $("#header_dropDown_profileMenu").toggle();

        $("#header_arrow").toggleClass("rotate");
    });

    $(document).click(function () {
        $("#header_dropDown_profileMenu").hide();
        $("#header_arrow").removeClass("rotate");
    });

    $("#header_dropDown_profileMenu").click(function (e) {
        e.stopPropagation();
    });

    //like
    $(document).on('click','.btn-like', function(e) {
        e.preventDefault();
        e.stopPropagation();
        let btn = $(this);
        let productId = $(this).data('id');

        let url = `/product/${productId}/like`;
        console.log("kliknuti");
        $.ajax({
            url: url,
            method: "POST",
            success: function(response) {
                if(response.status === 'liked') {
                    btn.addClass('bi-heart-fill').removeClass('bi-heart');
                    Swal.fire({
                        icon: 'success',
                        title: 'Sacuvali ste proizvod!',
                        text: response.success,
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    btn.addClass('bi-heart').removeClass('bi-heart-fill');
                }
                $('#like-count').text(response.count);

            },
            error: function (xhr){
                console.log(xhr)
            }

        })
    });
    $(document).on('click','#btn-cart', function(e) {
        e.preventDefault();
        e.stopPropagation();

        let productId = $(this).data('id');
        let quantity = $("#cart_quantity").val();
        if (quantity < 1 || quantity > 10)
        {
            alert("Ne mozete uneti kolicinu menju od 1 i vecu od 10")
            return;
        }
        let url = `/product/${productId}/add-to-cart`;
        $.ajax({
            url: url,
            method: "POST",
            data:{
                quantity: quantity
            },
            success: function(response) {
                $('#cart-count').text(response.count);
                Swal.fire({
                    icon: 'success',
                    title: 'Uspešno!',
                    text: response.success,
                    timer: 2000,
                    showConfirmButton: false
                });

            },
            error: function (xhr){
                console.log(xhr)
            }

        })
    });
    //filter-bar range
    let price=$("#priceRange").val();
    if (price > 0){
        $("#priceDisplay").html("do "+price+" RSD");
    }


    $("#priceRange").on("input",function (){
        if (this.value > 0){
            $("#priceDisplay").html("do "+this.value+" RSD");
        }
        else {
            $("#priceDisplay").html("");
        }
    })

    //category dropdown list

    function loadCategoryDropdown(){
        let id = $("#main_category").val();
        let options = $("#subcategory-options option");
        options.addClass("d-none");
        $(`.parent${id}`).removeClass("d-none");

    }
    loadCategoryDropdown();
    $("#main_category").on("change",function (){
        loadCategoryDropdown();
        $("#sub_category").val("");
    });

    $('#updateQuantityBtn').on("click",function (){
        let value = $("#addToQuantity").val();
        let quantity = $("#updateQuantity");

        quantity.val(Number(quantity.val()) + Number(value));
        $("#addToQuantity").val("");
    });

    //Reviews

    let selectedRating = 0;
    $('.star').on('mouseenter', function () {
        const rating = $(this).data('value');
        updateStars(rating);
    });

    $('.star').on('mouseleave', function () {
        updateStars(selectedRating);
    });

    $('.star').on('click', function () {
        selectedRating = $(this).data('value');
        $('#rating').val(selectedRating);
        updateStars(selectedRating);
    });

    function updateStars(rating) {
        $('.star').each(function () {
            const value = $(this).data('value');
            if (value <= rating) {
                $(this)
                    .removeClass('bi-star')
                    .addClass('bi-star-fill');
            } else {
                $(this)
                    .removeClass('bi-star-fill')
                    .addClass('bi-star');
            }
        });
    }

})


