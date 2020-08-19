@extends('adminPanel.layouts.app')
@section('content')
<div class="app-title">
	<div>
		<h1><i class="fas fa fa-file-word"></i>&nbsp;&nbsp;&nbsp;{{__('pages.pages')}}</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb side">
		<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
		<li class="breadcrumb-item">{{__('pages.pages')}}</li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<div class="row">
					<div class="col-6">
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addPage">{{__('general.new')}} <i class="fa fa-plus"></i>
					</div>
					<div class="col-6 table-search">
						{{__('general.search')}} :&nbsp;&nbsp;
					<input type="text" id="mySearch" onkeyup="searchInTable()" placeholder="{{__('general.enterInput')}}" title="Type in a name">
					</div>
				</div>
				<table class="table table-hover table-bordered" id="myTable">
					<thead>
						<tr>
							<th>{{__('pages.name')}}</th>
							<th>{{__('pages.layout')}}</th>
							<th>{{__('pages.url')}}</th>
							<th>{{__('pages.actions')}}</th>
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

				{{-- Model for adding New page : START --}}
				<div class="modal" id='addPage'>
					<div class="modal-dialog" role="document">
					  <div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title">{{__('pages.addNewPage')}}</h5>
						  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						</div>
						<form action="{!! route('pageAdd') !!}" method="POST">
							{{csrf_field()}}
							<div class="modal-body">
								<div class="form-group">
									<label class="control-label">{{__('pages.pageName')}}</label>
									<div class="form-group">
										<input class="form-control" name="pageName" required="required" placeholder="{{__('pages.pageName')}}">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label">{{__('pages.enTitle')}}</label>
									<div class="form-group">
										<input class="form-control" name="enTitle" required="required" placeholder="{{__('pages.enTitle')}}">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">{{__('pages.enRoute')}}</label>
									<div class="form-group">
										<input class="form-control" name="enRoute" required="required" placeholder="{{__('pages.enRoute')}}">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label">{{__('pages.laTitle')}}</label>
									<div class="form-group">
										<input class="form-control" name="laTitle" required="required" placeholder="{{__('pages.laTitle')}}">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">{{__('pages.laRoute')}}</label>
									<div class="form-group">
										<input class="form-control" name="laRoute" required="required" placeholder="{{__('pages.laRoute')}}">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-primary" type="submit">{{__('general.add')}}</button>
								<button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('general.cancel')}}</button>
							</div>
						</form>
					  </div>
					</div>
				  </div>
				{{-- Model for adding New page : END --}}

			</div>
		</div>
	</div>
</div>
@endsection
