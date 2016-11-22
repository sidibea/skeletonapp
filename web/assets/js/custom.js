$('#searchBtn').on('click',function(e){
    var calender = $('.pickup_datef').val();

        var froms = $("#from").val();
        var to =$("#to").val();
        var dateJ =$("#doj").val();


        window.location.href = base_url+"app/search?from=" + froms + "&to=" + to + "&dateJ=" + dateJ ;

});
   function Login(){
	    if ($('#login').parsley().validate() ) {
			$('.small_loader').show();
			var data=$('#login').serializeArray();
			var url= base_url + "login_check";
			var result = post_ajax(url,data);
			var details = result;
			$('.small_loader').hide();
			$('.login_res').show();
			if(details.success == false){
				$('.login_res').html("<p class='error '>"+ details.message +"</p>");
				setTimeout(function(){$('.login_res').hide(); }, 1500);
				
			}else{
				$('.login_res').html("<p class='success '>"+ details.message +"</p>");
				setTimeout(function(){$('.login_res').hide(),$('#login')[0].reset(); }, 1500);
				location.reload(); 
			}
			
		}
	   
   }
function Recharge(){
    if ($('#recharge').parsley().validate() ) {
        $('.small_loader').show();
        var data=$('#recharge').serializeArray();
        var url= base_url + "app/recharge";
        var result = post_ajax(url,data);
        var details = result;
        $('.small_loader').hide();
        $('.recharge_res').show();
        if(details.success == false){
            $('.recharge_res').html("<p class='error '>"+ details.message +"</p>");
            setTimeout(function(){$('.recharge_res').hide(); }, 1500);

        }else{
            $('.recharge_res').html("<p class='success '>"+ details.message +"</p>");
            setTimeout(function(){$('.recharge_res').hide(),$('#recharge')[0].reset(); }, 1500);
        }

    }

}
function RechargeA(){
    if ($('#accountrecharge').parsley().validate() ) {
        $('.small_loader').show();
        var data=$('#accountrecharge').serializeArray();
        var url= base_url + "app/account-recharge";
        var result = post_ajax(url,data);
        var details = result;
        $('.small_loader').hide();
        $('.recharge_res').show();
        if(details.success == false){
            $('.recharge_res').html("<p class='error '>"+ details.message +"</p>");
            setTimeout(function(){$('.recharge_res').hide(); }, 1500);

        }else{
            $('.recharge_res').html("<p class='success '>"+ details.message +"</p>");
            setTimeout(function(){$('.recharge_res').hide(),$('#accountrecharge')[0].reset(); }, 1500);
            location.reload();
        }

    }

}
function SeatSellerBooking(){
    if ($('#booking').parsley().validate() ) {
        $('.loader').show();
        var data=$('#booking').serializeArray();
        var url= location.target;
        var result = post_ajax(url,data);
        var details = result;
        $('.loader').hide();
        $('.recharge_res').show();
        if(details.success == false){
            $('.alert-danger').show();
            $('.alert-danger').html("<p>"+ details.message +"</p>");
            setTimeout(function(){$('.alert-danger').hide(); }, 1500);

        }else{
            $('.alert-success').show();
            $('.alert-success').html("<p >"+ details.message +"</p>");
            setTimeout(function(){$('.alert-success').hide(),$('#booking')[0].reset(); }, 1500);
            window.setTimeout(function() {
                window.location.href = base_url + 'app/confirmed/'+details.booking;
            }, 5000);
        }

    }

}

function PrintSeatseller(){

    $('.small_loader').show();
    var data=$('#print').serializeArray();
    var url= base_url + "app/print";
    var result = post_ajax(url,data);
    var details = result;
    $('.small_loader').hide();
    $('.print_res').show();
    if(details.success == false){
        $('.print_res').html("<p class='error '>"+ details.message +"</p>");
        setTimeout(function(){$('.print_res').hide(); }, 1500);

    }else{
        $('.print_res').html("<p class='success '>"+ details.message +"</p>");
        setTimeout(function(){$('.print_res').hide(),$('#print')[0].reset(); }, 1500);
        window.setTimeout(function() {
            window.location.href = base_url + 'app/confirmed/'+details.reservation;
        }, 5000);
    }

}
    function Signup(){
        if ($('#signup').parsley().validate() ) {
            $('.small_loader').show();
            var data=$('#signup').serializeArray();
            var url=base_url+"signup";
            var result = post_ajax(url,data);
            var details = result;
            $('.small_loader').hide();
            $('.signup_res').show();
            if(details.status =='failed'){
                $('.signup_res').html("<p class='error '>"+ details.message +"</p>");
                setTimeout(function(){$('.signup_res').hide(); }, 1500);

            }else{
                $('.signup_res').html("<p class='success '>"+ details.message +"</p>");
                setTimeout(function(){$('.signup_res').hide(),$('#signup')[0].reset(); }, 1500);
                location.reload();
            }

        }
	} 
	
	function Forgot(){
		 if ($('#forgot').parsley().validate() ) {
			 $('.small_loader').show();
			var data=$('#forgot').serializeArray();
			var url=base_url+"Login/forgot_password";
			var result = post_ajax(url,data);
			var details = JSON.parse(result);
			$('.small_loader').hide();
			$('.forgot_res').show();
			if(details.status =='failed'){
                $('.forgot_res').show();
				$('.forgot_res').html("<p class='error '>"+ details.message +"</p>");
				setTimeout(function(){$('.forgot_res').hide(); }, 1500);
				
			}else{
                $('.forgot_res').show();
				$('.forgot_res').html("<p class='success '>"+ details.message +"</p>");
				setTimeout(function(){$('.forgot_res').hide(),$('#forgot')[0].reset(); }, 1500);
				//location.reload(); 
			}
			
		}
	}

 function Confirmation(){
     if ($('#confirmation').parsley().validate() ) {
         $('.small_loader').show();
         var data=$('#confirmation').serializeArray();
         var url=base_url+"mob-confirm";
         var result = post_ajax(url,data);
         var details = JSON.parse(result);
         $('.small_loader').hide();
         $('.forgot_res').show();s
         if(details.status =='failed'){
             $('.forgot_res').html("<p class='error '>"+ details.message +"</p>");
             setTimeout(function(){$('.forgot_res').hide(); }, 1500);

         }else{
             $('.forgot_res').html("<p class='success '>"+ details.message +"</p>");
             setTimeout(function(){$('.forgot_res').hide(),$('#forgot')[0].reset(); }, 1500);
             //location.reload();
         }

     }
 }
	function Resetpass(){
		if ($('#reset-pass').parsley().validate() ) {
		$('.small_loader').show();
		
		var data =$('#reset-pass').serializeArray();
		var url=base_url+"login/reset_password";
			var result = post_ajax(url,data);
			var details = JSON.parse(result);
		
				
           $('.small_loader').hide();
		   $('.reset_res').show();
			if(details.status =='failed'){
				$('.reset_res').html("<p class='error '>"+ details.message +"</p>");
				setTimeout(function(){$('.reset_res').hide(); }, 1500);
				
			}else{
				$('.reset_res').html("<p class='success '>"+ details.message +"</p>");
				setTimeout(function(){$('.reset_res').hide(),$('#reset-pass')[0].reset(); }, 1500);
				//location.reload(); 
			}
		
	
		
	}
	}
  //Login//
  function Mprint(id){
	  var id =$(id).data("id");
	 var newwindow = window.open(base_url+'payment/new_window/'+id, '', 'height=800,width=800,scrollbars=yes');
					if (window.focus) {
						newwindow.focus();
					}
  }
  function Memail(id){
	  $(".loader").show();
	  var id =$(id).data("id");
	  var data ={'id':id,'type':'email'};
			    var url=base_url+"payment/email_notification";
				var result = post_ajax(url,data);
				var details = result;
				$(".loader").hide();
				if(details.status =='success'){
					alert("Details has been send your mail");
				}else{
					alert("email");
				}
  }
  
   function Printticket(){
	   
	    if ($('#bookForm').parsley().validate() ) {
			$(".loader").show();
		  var radioValue = $("input[name='id']:checked").val();
		  var id = $("#TID").val();
		      
			    var data ={'id':id,'type':radioValue};
			    var url=base_url+"printsms";
				var result = post_ajax(url,data);
				
				  
				$(".loader").hide();
				var details = result;
				
				if(details.status =='success'){
					if(radioValue =='email'){
                        $(".result").html('<p class="success ">Les details ont été envoyé à votre email.</p>');
                        setTimeout(function(){$('.result').hide(); }, 1500);
			        } else if(radioValue == 'sms'){
                        $(".result").html('<p class="success ">Les details ont été envoyé par sms sur votre numéro.</p>');
                        setTimeout(function(){$('.result').hide(); }, 1500);
                        console.log(details.code);
                    }
					
				}else {
					$(".result").html('<p class="error ">Vous avez soit tapé un mauvais numéro de billet ou votre billet n\'est pas valide.</p>');
					setTimeout(function(){$('.result').hide(); }, 1500);
				}
				
		    
			
	    }
   }
  function userDetails(){
	  
	   if ($('#userForm').parsley().validate() ) {
		   $(".loader").show();
			var data =$('#userForm').serializeArray();
		
		    var url=base_url+"payment/userDetails";
			var result = post_ajax(url,data);
			
			var details = JSON.parse(result);
			
			
			if(details.status =='success'){
				
				//alert(details.code);
				$(".item_name_s").val(details.Bookingido);
				$(".item_names").val(details.uneaqueid);
				$("#ORDER_ID").val(details.uneaqueid);
				
				
				if(details.BookingidR !='null'){
					var url ="?ido="+details.Bookingido+"&idR="+details.BookingidR;
				}else{
					var url="?ido="+details.Bookingido+"&idR=";
				}
				//alert(details.Bookingido);
				successurl =base_url+"payment/result"+url;
				$(".sucess_url").val(successurl);
				payment = $("#pament_option").val();
				//alert(payment);
				if(payment =='paypal'){
					 $("#paypals").submit(); 
				}else if(payment =='paytm'){
					$("#paytmm").submit(); 
				}
				 
				 
			}else{
				$(".loader").hide();
				$('#myModalp').modal('show');
				//alert("booking seat already exist");
				//$("#myModalp").click();
			}
		 }
  }function Selectedseat(elm){
	  var existB =$( elm ).hasClass('sseater'); 
	  var existB2 =$( elm ).hasClass('sseater');
	
	  if(existB !=true || existB2 !=true){
	  seat = $(elm).data("seat");
	  bus = $(elm).data("bus");
	  amount = $(elm).data("rate");
	  classs =$(elm).data("class");
	  
	  //alert($( elm ).hasClass( classs ));
	  if($( elm ).hasClass( classs )){
		 $(elm).removeClass(classs); 
		 if(classs=='seater'){
			 $(elm).addClass('selectedseat'); 
			  $(elm).addClass('selecteds'); 
		 }else{
			 $(elm).addClass('selectedsleeper'); 
			 $(elm).addClass('selecteds'); 
		 }
		
	  }else{
		  $(elm).removeClass('selectedseat');
		  $(elm).removeClass('selecteds');
		  
		  $(elm).removeClass('selectedsleeper'); 
		 $(elm).addClass(classs);
	  }
	   var texts= $("#bus"+bus+" .selecteds").map(function() {
             return $(this).data("seat");
        }).get();

      if(texts.length >6){
         alert("A maximum of 6 Seats can be selected");
           $(elm).removeClass('selectedseat');
		  $(elm).removeClass('selecteds');
		   $(elm).removeClass('selectedsleeper'); 
        }

      var texts= $("#bus"+bus+" .selecteds").map(function() {
             return $(this).data("seat");
         }).get();
	  $("#bus"+bus+ " .seat_no").text(texts); 
	  $("#bus"+bus+ " .seat_nos").val(texts);
	  $("#bus"+bus+ " .rate_bus").text(amount);
	  $("#bus"+bus+ " .total_rate").text(amount*texts.length);
	  console.log(("#bus"+bus+ " .seat_no"));
	  }
  }
   function paypal(){
	   
	   $("#Customerdetails").click();
   }
   function post_ajax(url, data) {
	var result = '';
	$.ajax({
        type: "POST",
        url: url,
		data: data,
		success: function(response) {
			result = response;
		},
		error: function(response) {
			result = 'error';
		},
		async: false
		});
		
		return result;
}
