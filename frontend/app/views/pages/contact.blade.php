@extends('layouts.default')
@section('content')
    <div class="wrapper clearfix ">
		<div class="content">
    		<div class="row">
    			<div class="col-md-8" style="margin: 0 auto!important; float: none;">
				<h2>Contact Us</h2>
				<ul>
				    @foreach($errors->all() as $error)
				        <li>{{ $error }}</li>
				    @endforeach
				</ul>

				{{ Form::open(array('route' => 'contact_store', 'class' => 'form')) }}

				<div class="form-group">
				    {{ Form::label('Your Name') }}
				    {{ Form::text('name', null, 
				        array('required', 
				              'class'=>'form-control', 
				              'placeholder'=>'Your name')) }}
				</div>

				<div class="form-group">
				    {{ Form::label('Your E-mail Address') }}
				    {{ Form::text('email', null, 
				        array('required', 
				              'class'=>'form-control', 
				              'placeholder'=>'Your e-mail address')) }}
				</div>

				<div class="form-group">
				    {{ Form::label('Your Message') }}
				    {{ Form::textarea('message', null, 
				        array('required', 
				              'class'=>'form-control', 
				              'placeholder'=>'Your message')) }}
				</div>

				<div class="form-group">
				    {{ Form::submit('Contact Us!', 
				      array('class'=>'btn btn-primary')) }}
				</div>
				{{ Form::close() }}

    			</div>{{-- col-md-8 --}}	
    		</div>{{-- row --}}
		</div>{{-- content --}}
    </div>{{-- wrapper clearfix --}}
@stop