@extends(backpack_view('blank'))
@section('after_scripts')
{{-- <script src="{{mix('js/createTag.js')}}">
</script> --}}
@endsection
@section('content')
<section class="container-fluid">
	<h2>
		<span class="text-capitalize">tags</span>
		<small>Add tag.</small>

		<small><a href="{{route('tag.index')}}" class="hidden-print font-sm"><i class="fa fa-angle-double-left"></i> Back to all  <span>tags</span></a></small>
	</h2>
</section>
<div class="row">
	<div class="col-md-8 bold-labels">
		<!-- Default box -->
		<form method="post"
		action="{{route('tag.store')}}" id="addTagForm" 
		>
		@csrf
		<div class="card">
			<div class="card-body row">
				<!-- load the view from type and view_namespace attribute if set -->
				<!-- text input -->
				<div class="form-group col-sm-12"
				>
				<label>Name:</label>
				<input
				type="text"
				name="name"
				value=""
				placeholder="Nhập tên thẻ"
				class="form-control"
				>
			</div>
		</div>
	</div>
	<div id="saveActions" class="form-group">
		<input type="hidden" name="save_action" value="save_and_back">
		<div class="btn-group" role="group">
			<button type="submit" class="btn btn-success">
				<span class="fa fa-save" role="presentation" aria-hidden="true"></span> &nbsp;
				<span data-value="save_and_back">Save and back</span>
			</button>
			<div class="btn-group" role="group">
				<button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span><span class="sr-only">&#x25BC;</span></button>
				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
					<a class="dropdown-item" href="javascript:void(0);" data-value="save_and_edit">Save and edit this item</a>
					<a class="dropdown-item" href="javascript:void(0);" data-value="save_and_new">Save and new item</a>
				</div>
			</div>
		</div>
		<a href="{{route('tag.index')}}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;Cancel</a>
	</div>
</form>
</div>
</div>
@endsection