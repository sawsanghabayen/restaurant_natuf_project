<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sawsan Resturant | My Cart</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
	
	<link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	{{-- <link rel="stylesheet" href="assets/css/style.css"> --}}

    <style>

* {
    font-family: 'Nunito', sans-serif;
    margin: 0;
    padding: 0;
	padding-top:10;
    box-sizing: border-box;
    text-decoration: none;
    outline: none;
    border: none;
    text-transform: capitalize;
    transition: all .2s linear;
}
html {
    /* font-size: 62.5%; */
    overflow-x: hidden;
    scroll-padding-top: 5.5rem;
    scroll-behavior: smooth;
}

	
.heading {
    text-align: center;
    color: var(--black);
    font-size: 3rem;
    padding-bottom: 2rem;
    text-transform: uppercase;
}

 .shopping-cart{
	padding-bottom: 50px;
	font-family: 'Montserrat', sans-serif;
}

.shopping-cart.dark{
	background-color: #f6f6f6;
}

.shopping-cart .content{
	box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
	background-color: white;
}

.shopping-cart .block-heading{
    padding-top: 50px;
    margin-bottom: 40px;
    text-align: center;
}

.shopping-cart .block-heading p{
	text-align: center;
	max-width: 420px;
	margin: auto;
	opacity:0.7;
}

.shopping-cart .dark .block-heading p{
	opacity:0.8;
}

.shopping-cart .block-heading h1,
.shopping-cart .block-heading h2,
.shopping-cart .block-heading h3 {
	margin-bottom:1.2rem;
	color: #3b99e0;
}

.shopping-cart .items{
	margin: auto;
}

.shopping-cart .items .product{
	margin-bottom: 20px;
	padding-top: 20px;
	padding-bottom: 20px;
}

.shopping-cart .items .product .info{
	padding-top: 0px;
	text-align: center;
}

.shopping-cart .items .product .info .product-name{
	font-weight: 600;
}

.shopping-cart .items .product .info .product-name .product-info{
	font-size: 14px;
	margin-top: 15px;
}

.shopping-cart .items .product .info .product-name .product-info .value{
	font-weight: 400;
}

.shopping-cart .items .product .info .quantity .quantity-input{
    margin: auto;
    width: 80px;
}

.shopping-cart .items .product .info .price{
	margin-top: 15px;
    font-weight: bold;
    font-size: 22px;
 }

.shopping-cart .summary{
	border-top: 2px solid #5ea4f3;
    background-color: #f7fbff;
    height: 100%;
    padding: 30px;
}

.shopping-cart .summary h3{
	text-align: center;
	font-size: 1.3em;
	font-weight: 600;
	padding-top: 20px;
	padding-bottom: 20px;
}

.shopping-cart .summary .summary-item:not(:last-of-type){
	padding-bottom: 10px;
	padding-top: 10px;
	border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.shopping-cart .summary .text{
	font-size: 1em;
	font-weight: 600;
}

.shopping-cart .summary .price{
	font-size: 1em;
	float: right;
}

.shopping-cart .summary button{
	margin-top: 20px;
}

@media (min-width: 768px) {
	.shopping-cart .items .product .info {
		padding-top: 25px;
		text-align: left; 
	}

	.shopping-cart .items .product .info .price {
		font-weight: bold;
		font-size: 22px;
		top: 17px; 
	}

	.shopping-cart .items .product .info .quantity {
		text-align: center; 
	}
	.shopping-cart .items .product .info .quantity .quantity-input {
		padding: 4px 10px;
		text-align: center; 
	}

}
</style>
</head>
<body>

<main  class="page">
	 	<section class="shopping-cart dark">
	 		<div class="container">
		        <div class="block-heading">
		          <h2>Shopping Cart</h2>
		          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
		        </div>
		        <div class="content">
					<div class="row">
						<div class="col-md-12 col-lg-8">
							@php $total=0; @endphp
								@foreach ($carts as $cart )
							<div class="items">
								{{-- {{dd($cart)}} --}}

								
								 
				 				<div class="product">
									 <div class="row">
					 					<div class="col-md-3">
					 						<img class="img-fluid mx-auto d-block image" src="{{Storage::url($cart->meal->image ?? '')}}">
					 					</div>
									 </div>
					 					<div class="col-md-8">
					 						<div class="info">
						 						<div class="row">
							 						<div class="col-md-5 product-name">
							 							<div class="product-name">
								 							<a href="#">{{$cart->meal->title}}</a>
								 							<div class="product-info">
									 							{{$cart->meal->description}}
									 						</div>
									 					</div>
							 						</div>
							 						<div class="col-md-4 quantity">
														 <form>
							 							<label for="quantity">Quantity:</label>
							 							<input onchange="updateQuantity('{{$cart->id}}')" id="quantity_{{$cart->id}}" type="number" value ="{{$cart->quantity}}" class="form-control quantity-input"  min="1">
														 </form>
													</div>
							 						<div class="col-md-3 price">
							 							<span>${{$cart->price}}</span> 

														 <a href="#" onclick="confirmDelete('{{$cart->id}}' ,this)"
														 class="btn btn-danger">
														 <i class="fas fa-trash"></i> </a>
							 						</div>
							 					
							 					</div>
							 				</div>
					 					</div>
					 				</div>
								</div>
								@php $total+=$cart->quantity *$cart->price; @endphp
								@endforeach
							</div>
                           @if(!$carts)
                           <div class="block-heading">
                                <h2>Empty Cart</h2>
                                <a href="{{route('resturants.index')}}" class="btn btn-primary btn-lg btn-block">Continue To shopping!</a>
                              </div>
                              @else
							<div class="col-md-12 col-lg-4">
								<div class="summary">
									<h3>Summary</h3>
									<div class="summary-item"><span class="text">Total</span><span class="price">{{$total}}</span></div>
									<button type="button" onclick="performCheckout('{{$total}}')" class="btn btn-primary btn-lg btn-block">Palce Order</button>
								</div>
							</div>
                            @endif
		 			</div> 


					{{-- <div class="row">
					<div class="col-md-12 col-lg-6">
					 <form id="save-address" class="addreses">
						 <label for="city"><i class="fa fa-institution"></i> City</label>
						 <input type="text" id="name" placeholder="New York">

						 <label for="area"><i class="fa fa-institution"></i>Area</label>
						 <input type="text" id="area"  placeholder="Area">

						<label for="treet"><i class="fa fa-institution"></i> Street</label>
						<input type="text" id="street" placeholder="Street">
							<label for="building">Building Name</label>
							<input type="text" id="building"  placeholder="Building Name">
							<label for="flat">Flat Number</label>
							<input type="text" id="flate_num"  placeholder="# Flat">
							<div class="row">
							<div class="col-md-12 col-lg-3">
							<button type="button" onclick="performSaveAddress()" class="btn btn-primary btn-lg btn-block">Save</button>
						</div>
						</div>
						</div>
					  </form> --}}
					{{-- </div>
					</div> --}}
		 		</div>
	 		</div>
		</section>
</main>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>


<script>
    function confirmDelete(id,reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id,reference);
        }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/rest/carts/'+id)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            // reference.closest('tr').remove();
			$(reference).closest(".product").remove()
            showMessage(response.data);
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
            showMessage(error.response.data);
        });
    }

    function showMessage(data) {
        Swal.fire(
            data.title,
            data.text,
            data.icon
        );
    }

	// $("input").change(
		
		function updateQuantity(id) {
        axios.put('/rest/carts/'+id, {
            quantity: document.getElementById('quantity_'+id).value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
  
// );

function performCheckout(totalprice) {
        axios.post('/rest/orders', {
            total: totalprice,
       
       })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
			window.location.href = '/rest/orders';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }

	// function performSaveAddress() {
    //     axios.post('/front/addresses', {
	// 		name: document.getElementById('name').value,
    //         area: document.getElementById('area').value,
    //         street: document.getElementById('street').value,
    //         building: document.getElementById('building').value,
    //         flate_num: document.getElementById('flate_num').value,
       
    //    })
    //     .then(function (response) {
    //         console.log(response);
    //         toastr.success(response.data.message);
	// 		document.getElementById('save-address').reset();
    //     })
    //     .catch(function (error) {
    //         console.log(error.response);
    //         toastr.error(error.response.data.message);
    //     });
    // }


</script>
</body>
</html>
