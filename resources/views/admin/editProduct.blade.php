@extends('admin.layouts.main')

@section('content')

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Manage products</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Add Product</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />

									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                                  @csrf
								  @method('put')
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="add-product">name <span class="required">*</span>
											</label>
											@error('name')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="add-product" required="required" class="form-control" name="name" value="{{old('name',$product->name)}}">
											</div>
										</div>
										
										

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="add-product">price <span class="required">*</span>
											</label>
											@error('price')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="add-product" required="required" class="form-control" name="price" value="{{old('price',$product->price)}}">
											</div>
										</div>


										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="add-product">rate <span class="required">*</span>
											</label>
											@error('rate')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="add-product" required="required" class="form-control " name="rate" value="{{old('rate',$product->rate)}}">
											</div>
										</div>
										<div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align" for="stock">Stock *</label><div class="col-md-6 col-sm-6"><input type="number" id="stock" class="form-control" name="stock" min="0" value="{{ old('stock', $product->stock) }}" required>@error('stock')<div class="alert alert-warning">{{ $message }}</div>@enderror</div></div>

										<div class="item form-group">
											
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="add-product">category name <span class="required">*</span>
											</label>

											<select name="category_id" id="" class="col-md-6 col-sm-6 ">
												@error('category_id')
													<div class="alert alert-danger">{{ $message }}</div>
												@enderror
												<option value="">Select Category</option>
				
												@foreach ($categories as $category)
													<option value="{{$category->id}}"@selected(old('category_id',$product->category_id) == $category->id)>{{$category->category_name}}</option>
												@endforeach
				
				
											</select>
				
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">published</label>
											<div class="checkbox">
												<input type="hidden" name="published" value="0">
												<label>
													<input type="checkbox" class="flat" name="published"@checked(old('published',$product->published)) value="1" >
												</label>
											</div>
										</div>


										<div class="item form-group ">
											<label for="" class="col-form-label col-md-3 col-sm-3 label-align">Image:</label>
											<div class="col-md-6">
												<input type="file" placeholder="" class="form-control py-2" name="image"
													value="{{ old('image',$product->image) }}" />
												@error('image')
													<div class="alert alert-warning">{{ $message }}</div>
												@enderror
											</div>
										</div>



										<div class="ln_solid"></div>

										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button type="submit" class="btn btn-success">edit</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- /page content -->
@endsection
