@extends('layouts.default')
@section('content')
	<div class="wrapper clearfix">
			<div class="content">
				{{-- {{print_r($vms, true)}} --}}
				<div class='row' >
					<div class='col-md-8' style="float:none; margin:0 auto;">
						{{ link_to('vm/add', 'Add New VM (Virtual Machine)', array('class' => ' btn btn-primary btn-lg dropdown-toggle'), null) }}
						<hr/>
						<table class="vm-table table table-striped table-bordered">
						 	<tr>
						 		<th>#</th>
						 		<th>Name</th>
						 		<th>Description</th>
						 		<th>State</th>
						 		<th></th>
						 		<th></th>
						 		<th></th>
						 	</tr>
						 	@for($i = 0; $i < count($vms); $i++)
						 		<tr>
							 		<th>{{$i+1}}</th>
							 		<th>{{$vms[$i]->name}}</th>
							 		<th>
							 	{{ str_replace(',', '<br/>', $vms[$i]->description)}} 
							 		</th>
							 		<th>{{$vms[$i]->state}}</th>
							 		<th >
							 			@if ( $vms[$i]->state === 'PoweredOff' || $vms[$i]->state === 'Aborted')
							 				{{ link_to('vm/start/' . $vms[$i]->name, '', array('title' => 'Start', 'class' => ' glyphicon glyphicon-play'), null) }}

							 				{{ link_to('vm/delete/' . $vms[$i]->name, '', array('style' => 'color:red', 'title' => 'Delete','class' => ' glyphicon glyphicon-remove-sign'), null) }}
							 			@else
							 				@if ( $vms[$i]->state === 'Paused')
							 					{{ link_to('vm/resume/' . $vms[$i]->name, '', array('title' => 'Resume','class' => ' glyphicon glyphicon-play'), null) }}
							 				@else
							 					{{ link_to('vm/pause/' . $vms[$i]->name, '', array('title' => 'Pause','class' => ' glyphicon glyphicon-pause'), null) }}
							 				@endif
							 				{{ link_to('vm/stop/' . $vms[$i]->name, '', array('title' => 'Power Off','class' => ' glyphicon glyphicon-stop'), null) }}
							 			@endif
							 		</th>
							 	</tr>
						 	@endfor
						</table>
							 			@makelink http://llkkjjks.comk						 			
					</div>
				</div><!--'row' -->
			</div><!--content-->
	</div><!--wrapper clearfix-->

@stop
