@if (session()->has('success'))
	<div class="container">
    		<div class="row">
        	<div class="col-md-6">
            	<div class="alert alert-success">
                	{{session()->get('success')}}
            	</div>
        	</div>
    		</div>
	</div>
@endif
@if (session()->has('deleted'))
	<div class="container">
    		<div class="row">
        	<div class="col-md-6">
            	<div class="alert alert-danger">
                	{{session()->get('deleted')}}
            	</div>
        	</div>
    		</div>
	</div>
@endif