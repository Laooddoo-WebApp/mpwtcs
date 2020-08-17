@extends('adminPanel.layouts.app')
@section('content')
<div class="app-title">
	<div>
		<h1><i class="fas fa fa-file-word"></i>&nbsp;&nbsp;&nbsp;Pages</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb side">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item">Pages</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<div class="table-search">
					Search :&nbsp;&nbsp;
					<input type="text" id="mySearch" onkeyup="searchInTable()" placeholder="Search for names.." title="Type in a name">
				</div>
				<table class="table table-hover table-bordered" id="myTable">
					<thead>
						<tr>
							<th>Name</th>
							<th>Layout</th>
							<th>URL</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@isset($pages)
						@foreach($pages as $currentPage)
						<tr class="text-center">
							<td>{{$currentPage->title}}</td>
							<td>{{$currentPage->layout}}</td>
							<td>{{$currentPage->route}}</td>
							<td>
							<a class="btn btn-primary btn-view" target='_blank' href="{{ url($currentPage->route)}}">{{__('general.view')}}</a>
								<a class="btn btn-primary btn-edit" href="{!! route('pagebuilder.build',$currentPage->id) !!}">{{__('general.edit')}}</a>
								<a class="btn btn-primary btn-delete" href="{!! route('pageDelete',$currentPage->id) !!}">{{__('general.delete')}}</a>
							</td>
						</tr>
						@endforeach
						@endisset
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
