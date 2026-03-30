$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
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
                alert(response.success);

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
})


