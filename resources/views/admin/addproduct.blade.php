@extends('admin.layouts')
@section("content")
<!-- MAIN CONTENT-->
<div class="main-content">
  <div class="section__content section__content--p30">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="overview-wrap">
            <h2 class="title-1">{{ ucfirst($title) }}</h2>
          </div>
        </div>
      </div>
      <script src="{{ asset('admin_assets/js/ckeditor.js') }}"></script>
      <div class="row">
        <div class="col-md-12">
          <div class="overview-wrap float-right">
            <a href="{{ route('admin_product') }}">
            <button type="button" class="btn btn-secondary">Go Back</button>
            </a>
          </div>
        </div>
      </div>
      @error('attr_image.*')
        <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
      @enderror

      @error('multi_image.*')
        <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
      @enderror
      <form action="{{ route('manage_product_process') }}" method="post" enctype="multipart/form-data">
        <div class="row m-t-30">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                @csrf
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="product_name" class="control-label mb-1">Product Name</label>
                      <input id="product_name" name="product_name" type="text" class="form-control" value="{{ $product_name }}" placeholder="Product Name" >
                      @error('product_name')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <input type="hidden" value="{{ $product_id }}" name="product_id" />
                  <div class="col-md-4">
                    <div class="form-group">
                        <label for="slug" class="control-label mb-1">product Slug</label>
                        <input id="slug" placeholder="Slug" name="slug" type="text" class="form-control" value="{{ $slug }}" >
                        @error('slug')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="brand" class="control-label mb-1">select Brand</label>
                      <select name="brand" id="brand" class="form-control">
                        <option value="">select Brand</option>
                        @if(count($brands) > 0)
                        @foreach($brands as $key => $brand)
                        <option value="{{ $brand->id }}" {{  ($brand_id == $brand->id) ? "selected=selected" : "" }}>{{ $brand->brand }}</option>
                        @endforeach
                        @else
                        <option value="">Please Insert Brand From Admin Brand Section OR Activate The Brand</option>
                        @endif
                      </select>
                      @error('brand')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="model" class="control-label mb-1">Model</label>
                      <input id="model" placeholder="model"  name ="model" type="text" class="form-control" value="{{ $model }}"  >
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="category" class="control-label mb-1">select Category</label>
                      <select name="category" id="category" class="form-control">
                        <option value="">select Category</option>
                        @if(count($categories) > 0)
                        @foreach($categories as $key => $category)
                        <option value="{{ $category->id }}" {{  ($cat_id == $category->id) ? "selected=selected" : "" }}>{{ $category->category_name }}</option>
                        @endforeach
                        @else
                        <option value="">Please Insert Category From Admin Category Section OR Activate The Category</option>
                        @endif
                      </select>
                      @error('category')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="image" class="control-label mb-1">Product Image</label>
                      <input type="file" id="pro_image" name="image" class="form-control-file" value={{ $image }}>
                    </div>
                    <?php 
                        if($image == ''){
                          $display = 'display : none';
                        } else {
                          $display = 'display : block';
                        }
                        ?>
                    <img  id="preview-image-before-upload" src=""
                        style="max-height: 100px;{{ $display }}">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="short_desc" class="control-label mb-1">Short Description</label>
                      <textarea id="short_desc" name="short_desc"  class="form-control" value="" rows="2" placeholder="Short Description" class="form-control">{{ $short_desc }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="desc" class="control-label mb-1"> Description</label>
                      <textarea id="desc" name="desc"  class="form-control"  rows="2  " placeholder="Description" class="form-control">{{ $desc }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="keywords" class="control-label mb-1"> Keywords</label>
                      <textarea id="keywords" name="keywords"  class="form-control"  rows="2" placeholder="Keywords" class="form-control">{{ $keywords }}</textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="technical_specification" class="control-label mb-1"> Technical Specification</label>
                      <textarea id="technical_specification" name="technical_specification"  class="form-control" rows="2" placeholder="Technical Specification" class="form-control">{{ $technical_specification }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="uses" class="control-label mb-1"> Uses</label>
                      <textarea id="uses" name="uses"  class="form-control" value="" placeholder="uses" class="form-control">{{ $uses }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="warranty" class="control-label mb-1"> Warranty</label>
                      <textarea id="warranty" name="warranty" class="form-control" rows="2" placeholder="warranty" class="form-control">{{ $warranty }}</textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="lead_time" class="control-label mb-1"> Lead Time</label>
                      <input id="lead_time" placeholder="lead time"  name ="lead_time" type="text" class="form-control" value="{{ $lead_time }}"  >
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      
                      <label for="category" class="control-label mb-1">select Tax</label>
                      <select name="tax_id" id="tax_id" class="form-control">
                        <option value="">Select Tax</option>
                        @if(count($taxes) > 0)
                        @foreach($taxes as $key => $tax)
                        
                        <option value="{{ $tax->id }}" {{  ($tax_id == $tax->id) ? "selected=selected" : "" }}>{{ $tax->tax_desc }}</option>
                        @endforeach
                        @else
                        <option value="">Please Insert Tax From Admin Tax Section OR Activate The Tax</option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="is_promo" class="control-label mb-1"> Select Promo</label>
                      <select name="is_promo" id="is_promo" class="form-control">
                        <option value="">select Promo</option>
                        <option value="{{ $is_promo == 0 ? 0 : 0 }}" {{  ($is_promo == 0) ? "selected=selected" : "" }}>No</option>
                        <option value="{{ $is_promo == 1 ? 1 : 1 }}" {{  ($is_promo == 1) ? "selected=selected" : "" }}>Yes</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="is_featured" class="control-label mb-1"> Select featured</label>
                      <select name="is_featured" id="is_featured" class="form-control">
                        <option value="">select featured</option>
                        <option value="{{ $is_featured == 0 ? 0 : 0 }}" {{  ($is_featured == 0) ? "selected=selected" : "" }}>No</option>
                        <option value="{{ $is_featured == 1 ? 1 : 1 }}" {{  ($is_featured == 1) ? "selected=selected" : "" }}>Yes</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="is_discounted" class="control-label mb-1"> Select discounted</label>
                      <select name="is_discounted" id="is_discounted" class="form-control">
                        <option value="">select discounted</option>
                        <option value="{{ $is_discounted == 0 ? 0 : 0 }}" {{  ($is_discounted == 0) ? "selected=selected" : "" }}>No</option>
                        <option value="{{ $is_discounted == 1 ? 1 : 1 }}" {{  ($is_discounted == 1) ? "selected=selected" : "" }}>Yes</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="is_tranding" class="control-label mb-1"> Select tranding</label>
                      <select name="is_tranding" id="is_tranding" class="form-control">
                        <option value="">select tranding</option>
                        <option value="{{ $is_tranding == 0 ? 0 : 0 }}" {{  ($is_tranding == 0) ? "selected=selected" : "" }}>No</option>
                        <option value="{{ $is_tranding == 1 ? 1 : 1 }}" {{  ($is_tranding == 1) ? "selected=selected" : "" }}>Yes</option>
                      </select>
                    </div>
                  </div>
                </div>



                @if ($image == '')
                <input type="hidden" name="pro_old_img" id="pro_old_img" value="">
                @else
                  @if(file_exists(public_path("pro_img/".$image)))
                    <input type="hidden" name="pro_old_img" id="pro_old_img" value="{{ asset('pro_img') }}/{{$image  }}">
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>

        {{-- Products Multiple Images --}}
        <div class="row">
          <div class="col-md-12">
            <div class="overview-wrap">
              <h2 class="title-1 mb-3">Products Multiple Images</h2>
            </div>
          </div>
        </div>

        <div>
          <div class="row">
            <div class="col-md-12">
              @php
              $loop_count_num_img = 1;     
              @endphp
             
              <div class="card">
                <div class="card-body">
                  <div class="row" id="multi_box">
                    @foreach($productMulImgArr as $key => $value)
                    @php
                      $loop_count_prev_img = $loop_count_num_img;
                      $pIArr = (array)$value; 
                    @endphp
                    <div class="col-md-6" id="multi_img_data_{{ $loop_count_num_img++ }}">
                      <div class="row">
                        <div class="form-group col-md-4">
                          <input  name="prodmulti_id[]" type="hidden" class="form-control" value="{{ $pIArr['id'] }}" >
                            <input type="file"  name="multi_image[]" {{ ($pIArr['multi_image'] == '') ? 'required' : "" }}>
                            @if($pIArr['multi_image'] != '')
                              <img width="80" src="{{ asset('pro_multi_img') }}/{{ $pIArr['multi_image'] }}" />
                            @else
                              
                            @endif
                        </div>
                        <div class="col-md-2">
                          @if($loop_count_num_img ==2)
                            <button id="add_more_attr" onclick="addMoreMultiImg()" type="button"  class="btn  btn-success">
                              <i class="fa fa-plus"></i>Add More
                            </button>
                          @else
                            <button id="remove_attr" onclick="removeMultiImgDatadb({{  $pIArr['id']}})" type="button"  class="btn  btn-danger">
                            <i class="fa fa-minus"></i> Remove
                          </button>
                          @endif
                          
                        </div>
                      </div>
                    </div>
                    @endforeach

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Product Attributes --}}
        <div class="row">
          <div class="col-md-12">
            <div class="overview-wrap">
              <h2 class="title-1 mb-3">Products Attributes</h2>
            </div>
          </div>
        </div>
        <div>
          <div class="row">
            <div class="col-md-12" id="attr_box">
              @php
              $loop_count_num = 1;     
              @endphp
              @foreach($productAttrArr as $key => $value)
              @php
                $loop_count_prev = $loop_count_num;
                $pAArr = (array)$value; 
              @endphp
              <div class="card" id="attr_data_{{ $loop_count_num++ }}">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="sku" class="control-label mb-1">SKU</label>
                        <input  name="sku[]" type="text" class="form-control" placeholder="sku" value="{{ $pAArr['sku'] }}" required>

                        <input  name="prodAttr_id[]" type="hidden" class="form-control" value="{{ $pAArr['id'] }}" >
                      </div>
                    </div>
                    
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="mrp" class="control-label mb-1">MRP</label>
                        <input  placeholder="mrp" name="mrp[]" type="number" value="{{ $pAArr['mrp'] }}"  class="form-control" required>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="price" class="control-label mb-1">PRICE</label>
                        <input  placeholder="price" value="{{ $pAArr['price'] }}"  name ="price[]" type="number" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="qty" required class="control-label mb-1">QTY</label>
                        <input placeholder="qty" value="{{ $pAArr['qty'] }}"  name ="qty[]" type="number" class="form-control" >
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="size" class="control-label mb-1">Size</label>
                        <select name="size[]"  class="form-control">
                          <option value="0">Select</option>
                          @if(count($sizes) > 0)
                            @foreach($sizes as $key => $size)
                            <option value="{{ $size->id }}" {{  ($size->id == $pAArr['size_id']) ? "selected=selected" : "" }}>{{ $size->size }}</option>
                            @endforeach
                          @else
                            <option value="">Please Insert Size From Admin Size Section OR Activate The Size</option>
                          @endif
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                          <label for="color" class="control-label mb-1">Color</label>
                          <select name="color[]" class="form-control">
                            <option value="0">Select</option>
                            @if(count($colors) > 0)
                              @foreach($colors as $key => $color)
                              <option value="{{ $color->id }}" {{  ($color->id == $pAArr['color_id']) ? "selected=selected" : "" }}>{{ $color->color }}</option>
                              @endforeach
                            @else
                              <option value="">Please Insert Color From Admin Color Section OR Activate The Color</option>
                            @endif
                          </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="attr_image" class="control-label mb-1">Attribute Image</label>
                          <input type="file"  name="attr_image[]" class="form-control-file" {{ ($pAArr['attr_image'] == '') ? 'required' : "" }}>
                          @if($pAArr['attr_image'] != '')
                            <img width="80" src="{{ asset('pro_attr_img') }}/{{ $pAArr['attr_image'] }}" />
                            
                          @else
                            
                          @endif
                      </div>
                    </div>


                    <div class="col-md-2">
                      @if($loop_count_num ==2)
                        <button id="add_more_attr" onclick="addMoreAttr()" type="button"  class="btn  btn-success">
                          <i class="fa fa-plus"></i> Add More
                        </button>
                      @else
                        <button id="remove_attr" onclick="removeAttrData({{  $pAArr['id']}})" type="button"  class="btn  btn-danger">
                        <i class="fa fa-minus"></i> Remove
                      </button>
                      @endif
                      
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
              
            
          </div>
        </div>
          
        <div>
          <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
          Submit
          </button>
          </button>
          <button style = "{{ ($product_id > 0) ? 'display:none' : '' }}" id="payment-button" type="reset"  class="btn btn-lg  btn-block btn-secondary">
          Reset
          </button>
        </div>
      </form>
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
            <p>Copyright © @php
              echo date('Y')
              @endphp Colorlib. All rights reserved. Developed by <a href="{{ route('admin_dashboard') }}">Piyush Shyam</a>.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
   ClassicEditor
      .create( document.querySelector( '#short_desc' ) )
  ClassicEditor
      .create( document.querySelector( '#desc' ) )
  ClassicEditor
      .create( document.querySelector( '#keywords' ) )
  ClassicEditor
      .create( document.querySelector( '#technical_specification' ) )
  ClassicEditor
      .create( document.querySelector( '#uses' ) )
  ClassicEditor
      .create( document.querySelector( '#warranty' ) )
  let  i = "{{ $loop_count_prev }}";
  function addMoreAttr(){
    
    if(i < 6){
    i++;

      let html = `
              <div class="card" id="attr_data_${i}">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="sku" class="control-label mb-1">SKU</label>
                        <input name="sku[]" type="text" class="form-control" placeholder="sku" required>
                        <input  name="prodAttr_id[]" type="hidden" class="form-control" value="" >
                       </div>
                    </div>
                    
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="mrp" class="control-label mb-1">MRP</label>
                        <input placeholder="mrp" name="mrp[]" type="number"  class="form-control" required>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="price" class="control-label mb-1">PRICE</label>
                        <input id="price" placeholder="price"  name ="price[]" type="number" class="form-control" required >
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="qty" required class="control-label mb-1">QTY</label>
                         <input placeholder="qty"  name ="qty[]" type="number" class="form-control" >
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="size" class="control-label mb-1">Size</label>
                        <select name="size[]" class="form-control">
                          <option value="0">Select</option>
                          @if(count($sizes) > 0)
                            @foreach($sizes as $key => $size)
                            <option value="{{ $size->id }}">{{ $size->size }}</option>
                            @endforeach
                          @else
                            <option value="">Please Insert Size From Admin Size Section OR Activate The Size</option>
                          @endif
                        </select>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                         <label for="color" class="control-label mb-1">Color</label>
                         <select name="color[]" class="form-control">
                          <option value="0">Select</option>
                            @if(count($colors) > 0)
                              @foreach($colors as $key => $color)
                              <option value="{{ $color->id }}">{{ $color->color }}</option>
                              @endforeach
                            @else
                              <option value="">Please Insert Color From Admin Color Section OR Activate The Color</option>
                            @endif
                         </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                         <label for="attr_image" class="control-label mb-1">Attribute Image</label>
                         <input type="file" name="attr_image[]" class="form-control-file" required>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <button id="remove_attr" onclick="removeAttr(${i})" type="button"  class="btn  btn-danger">
                        <i class="fa fa-minus"></i> Remove
                      </button>
                    </div>

                  </div>
                </div>
              </div>
          
          `;

          $("#attr_box").append(html);
    
    } else {
      alert('Limit is exceeded only 5 attributes you can add');
      return false;
    }
    

  }

  
  function removeAttr(attr){
    
    $(`#attr_data_${attr}`).remove();
    i--;
    console.log(i);
  }
  

  let  im = "{{ $loop_count_prev_img }}";
  function addMoreMultiImg(){

    if(im < 6){
      im++;
      let html = `
                    <div class="col-md-6" id="multi_img_data_${im}">
                      <div class="row">
                        <div class="form-group col-md-4">
                          <input  name="prodmulti_id[]" type="hidden" class="form-control" value="" >
                          <input type="file" name="multi_image[]"  required>
                        </div>
                        <div class="col-md-2">
                          <button id="remove_attr" onclick="removeMultiImgData(${im})" type="button"  class="btn  btn-danger">
                            <i class="fa fa-minus"></i> Remove
                          </button>
                        </div>
                      </div>
                    </div>
          
          `;

      $("#multi_box").append(html);
    } else {
      alert('Limit is exceeded only 5 images you can add');
      return false;
    }

    
  }

  function removeMultiImgData(attr){
    $(`#multi_img_data_${attr}`).remove();
    im--;
  }

  function removeMultiImgDatadb(prod_multi_id){
    let data = {
      _token : $("meta[name=csrf-token]").attr("content"),
      prod_multi_id : prod_multi_id
    }

    $.ajax({
      type : "POST",
      url : "{{ route('deleteMultiImage') }}",
      data : data,
      success : function(data){
        if(data.result == 'success'){
          alert(data.data);
          window.location.reload();
        } else {
          alert(data.data);
          window.location.reload();
        }
      }
    })
  }

  function removeAttrData(prod_attr_id){
    let data = {
      _token : $("meta[name=csrf-token]").attr("content"),
      prod_attr_id : prod_attr_id
    }

    $.ajax({
      type : "POST",
      url : "{{ route('deleteAttr') }}",
      data : data,
      success : function(data){
        if(data.result == 'success'){
          alert(data.data);
          window.location.reload();
        } else {
          alert(data.data);
          window.location.reload();
        }
      }
    })

    

  }

  
</script>
<!-- END MAIN CONTENT-->
@endsection