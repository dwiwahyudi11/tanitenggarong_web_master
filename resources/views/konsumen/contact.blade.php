 @extends('layouts/app')

 @section('title', 'Contact')

 @section('content')
 <div id="contact-page" class="container">
 	<div class="bg">
 		@foreach($data as $dt)
 		<div class="row">    		
 			<div class="col-sm-12">    			   			
 				<h2 class="title text-center">Contact <strong>Us</strong></h2>    			
 				<address>
 					<p >{{$dt->name}}</p>
 					<p >{{$dt->alamat}}</p>
 					<p >Telp: {{$dt->no_telp}}</p>
 					<p >Email: {{$dt->email}}</p>
 				</address>   				    				

 			</div>			 		
 		</div>
 		@endforeach 
 	</div>
 </div> 
 @endsection