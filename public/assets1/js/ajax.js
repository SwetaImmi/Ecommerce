(function ($) {

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function btnAddCart(param) {
        var product_id = param;
        var url = "{{ route('cart.add') }}";
        $.ajax({
          type: "POST",
          url: url,
          data: { product_id: product_id },
          success: function (data) {
            console.log(data);
          },
          error: function (data) {
            console.log('Error:', data);
          }
        });
      };

    function update(){
        var id = id1;
        var quantity = quantity;
        var relative =relative;
       var value =value;
        alert("enterd " + id);
        document.getElementById(".update-cart").innerHTML = "hi";
        $.ajax({
            url: "update-cart ",
            method: "POST", // First change type to method here    
            data: {
                item_id: id,quantity:quantity,value:value,relative:relative,
            },
            success: function(response) {
                document.getElementById("disp").innerHTML = response;
            },
            error: function(error) {
                alert("error" + error);
            }
        });   

    }

    function cart(id1) {
        var id = id1;
        alert("enterd " + id);
        document.getElementById("disp").innerHTML = "hi";
        $.ajax({
            url: "/add.php ",
            method: "POST", // First change type to method here    
            data: {
                item_id: id,
            },
            success: function(response) {
                document.getElementById("disp").innerHTML = response;
            },
            error: function(error) {
                alert("error" + error);
            }
        });    
    }
})