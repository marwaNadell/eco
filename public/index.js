$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    $('.innercatchy').click(function () {
        var id=$(this).attr("id")
        var qty = $(this).val();
       


        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/cartedit",
            data: {id,qty},
            success: function(res){
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
               alert("some error");
            }
          });



          $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/carttotal",
            
            success: function(res){
               //  alert(res.total)
               $(".total").html(`<span>${res.total}</span>`);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
             console.log("error.....");
            }
          });
    });
    




    
    
    $('.innercatchy').keyup(function(){
        

        var id=$(this).attr("id")
        var qty = $(this).val();
       


        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/cartedit",
            data: {id,qty},
            success: function(res){
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
             console.log("error.....");
            }
          });

          $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/carttotal",
            
            success: function(res){
               //  alert(res.total)
               $(".total").html(`<span>${res.total}</span>`);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
             console.log("error.....");
            }
          });


      });


      $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "http://127.0.0.1:8000/carttotal",
            
            success: function(res){
               //  alert(res.total)
               $(".total").html(`<span>${res.total}</span>`);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
             console.log("error.....");
            }
          });
      });