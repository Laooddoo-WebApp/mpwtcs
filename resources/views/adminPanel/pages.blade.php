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
							<th>UniqueID</th>
							<th>Product ID</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Still Active</th>
							<th>image</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@isset($sliders)
						@foreach($sliders as $currentSlider)
						<tr class="text-center">
							<td>{{$currentSlider->uniqueID}}</td>
							<td>{{$currentSlider->productID}}</td>
							<td>{{$currentSlider->startDate}}</td>
							<td>{{$currentSlider->endDate}}</td>
							<td>{{'cdc'}}</td>
							<td> <img class="slider-table-img img-fluid" src={{ asset("storage/resources/sliders/".$currentSlider->imageName ) }} alt=""></td>
							<td>
								<a class="btn btn-primary btn-view" href="{!! route('vViewSlider',$currentSlider->productID) !!}">View</a>
								<a class="btn btn-primary btn-edit" href="{!! route('vEditSlider',$currentSlider->uniqueID) !!}">Edit</a>
								<a class="btn btn-primary btn-delete" href="{!! route('deleteSlider',$currentSlider->uniqueID) !!}">Delete</a>
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
