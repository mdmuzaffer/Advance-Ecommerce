<div class="form-group" id="myAppendCategory">
	<label>Select category level</label>
	<select required="" class="form-control select2 select2-hidden-accessible" id="categoryParent_id" name="categoryParent_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
		<option selected="selected" data-select2-id="3">Select category</option>
		@if(!empty($changCat))
			<option data-select2-id="30"  value="0">Main category</option>
			@foreach($changCat as $cat)
			<option data-select2-id="30"  value="{{$cat['id']}}">{{$cat['category_name']}}</option>
			@endforeach
		@else
			<option data-select2-id="30"  value="0">Main category</option>
		@endif
	</select>
</div>
          