<?php

namespace App\Http\Controllers\Admin;
use App\Http\Traits\CategoriesTrait;
use App\Http\Traits\SizesTrait;
use App\Http\Traits\ColorsTrait;
use App\Http\Traits\TaxesTrait;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Product_attr;
use App\Models\Admin\ProductmultiImage;
use App\Http\Traits\BrandsTrait;

class ProductController extends Controller
{
    // Use Traits
    use CategoriesTrait;
    use SizesTrait;
    use ColorsTrait;
    use BrandsTrait;
    use TaxesTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_data['title'] = "admin product";
        $string_search_data = $request->post("searchText");
        if($string_search_data != ""){
            $page_data['products'] = Product::where('product_name', "LIKE", '%'.$string_search_data.'%')->orderBy('id', 'DESC')->paginate(5);
        } else {
            $page_data['products'] = Product::orderBy('id', 'DESC')->paginate(5);
        }

        $page_data['total'] = $page_data['products']->total();
        $page_data['firstItem'] = $page_data['products']->firstItem();
        $page_data['lastItem'] = $page_data['products']->lastItem();
        return view('admin.product', $page_data);
    }

    /**
     * Show the form for creating a new resource. and editing
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_product($id = '', Request $request)
    {
        if($id > 0){
            $result = Product::where(["id" => $id])->first()->toArray();
            $page_data['title'] = "edit product";
            $page_data['product_name'] = $result['product_name'];
            $page_data['image'] = $result['image'];
            $page_data['brand_id'] = $result['brand'];
            $page_data['slug'] = $result['slug'];
            $page_data['model'] = $result['model'];
            $page_data['short_desc'] = $result['short_desc'];
            $page_data['desc'] = $result['desc'];
            $page_data['keywords'] = $result['keywords'];
            $page_data['technical_specification'] = $result['technical_specification'];
            $page_data['uses'] = $result['uses'];
            $page_data['warranty'] = $result['warranty'];

            $page_data['lead_time'] =  $result['lead_time'];
            $page_data['tax_id'] =  $result['tax_id'];
            $page_data['taxes'] = $this->getTaxes();
            $page_data['is_promo'] =  $result['is_promo'];
            $page_data['is_featured'] =  $result['is_featured'];
            $page_data['is_discounted'] =  $result['is_discounted'];
            $page_data['is_tranding'] =  $result['is_tranding'];

            $page_data['product_id'] = $result['id'];
            $page_data['cat_id'] = $result['category_id'];
            $page_data['productAttrArr'] = DB::table("product_attrs")->where(['products_id' => $id])->get();
            $page_data['productMulImgArr'] = DB::table("productmulti_images")->where(['products_id' => $id])->get();
            
            if(isset($page_data['productMulImgArr'][0])){
                
            } else {
                $page_data['productMulImgArr'][0]['multi_image'] = "";
                $page_data['productMulImgArr'][0]['id'] = "";
            }
        

        } else {

            $page_data['title'] = "add product";
            $page_data['product_name'] = "";
            $page_data['model'] = "";
            $page_data['brand_id'] = "";
            $page_data['short_desc'] = "";
            $page_data['desc'] = "";
            $page_data['keywords'] = "";
            $page_data['technical_specification'] = "";
            $page_data['uses'] = "";
            $page_data['warranty'] = "";
            $page_data['product_id'] = "";
            $page_data['slug'] = "";
            $page_data['image'] = "";
            $page_data['cat_id'] = "";
            $page_data['lead_time'] = "";
            $page_data['tax_id'] = "";
            $page_data['taxes'] = $this->getTaxes();
            $page_data['is_promo'] = "";
            $page_data['is_featured'] = "";
            $page_data['is_discounted'] = "";
            $page_data['is_tranding'] = "";

            $page_data['productAttrArr'][0]['products_id'] =  "";
            $page_data['productAttrArr'][0]['sku'] = "";
            $page_data['productAttrArr'][0]['attr_image'] = "";
            $page_data['productAttrArr'][0]['mrp'] = "";
            $page_data['productAttrArr'][0]['price'] = "";
            $page_data['productAttrArr'][0]['qty'] = "";
            $page_data['productAttrArr'][0]['size_id'] = "";
            $page_data['productAttrArr'][0]['color_id'] = "";
            $page_data['productAttrArr'][0]['id'] = "";
            $page_data['productMulImgArr'][0]['multi_image'] = "";
            $page_data['productMulImgArr'][0]['id'] = "";
        }

        // echo "<pre>";

        // print_r($page_data);
        // die();

        // Get data using Trait method
        $page_data['categories'] = $this->getCategories();
        $page_data['sizes'] = $this->getSizes();
        $page_data['colors'] = $this->getColors();
        $page_data['brands'] = $this->getBrands();

       
       return view("admin.addproduct", $page_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_product_process(Request $request)
    {
       
        if($request->post('product_id') > 0) {
            $validate_img = 'mimes:jpeg,png,jpg';
        } else {
            $validate_img = 'required|mimes:jpeg,png,jpg';
        }

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|unique:products,product_name,'.$request->post("product_id"),
            'slug' => 'required|unique:products,slug,'.$request->post("product_id"),
            'category' => 'required',
            'image' => $validate_img,
            'attr_image.*' => 'mimes:jpeg,png,jpg',
            'multi_image.*' => 'mimes:jpeg,png,jpg'
        ]);

        if($request->post('product_id') > 0) {
            if ($validator->fails()) {
                return redirect()->route('editproduct', ['id' => $request->post('product_id')])
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = Product::find($request->post('product_id'));
                if($request->hasfile('image')){
                    if($data->id != ''){
                        if($data->image){
                            if(file_exists(public_path("pro_img/".$data->image))){
                                unlink("pro_img/".$data->image);
                            }
                        }
                    }
                }
                

                if($request->hasfile('image')){
                    $img = $request->file('image');
                    $ext = $img->extension();
                    $imageName = 'pro_'.time().'.'.$ext;
                    $request->image->move(public_path('pro_img'), $imageName);
                    $data->image = $imageName;
                }

                $data->product_name = $request->post("product_name");
                $data->model = $request->post("model");
                $data->brand = $request->post("brand");
                $data->short_desc = $request->post("short_desc");
                $data->desc = $request->post("desc");
                $data->keywords = $request->post("keywords");
                $data->technical_specification = $request->post("technical_specification");
                $data->uses = $request->post("uses");
                $data->warranty = $request->post("warranty");

                $data->lead_time = $request->post("lead_time");
                $data->tax_id = $request->post("tax_id");
                $data->is_promo = $request->post("is_promo");
                $data->is_featured = $request->post("is_featured");
                $data->is_discounted = $request->post("is_discounted");
                $data->is_tranding = $request->post("is_tranding");

                $data->slug = Str::slug($request->post("slug"));
                $data->category_id = $request->post("category");
            }
        } else {
            if ($validator->fails()) {
                return redirect()->route('add_product')
                ->withErrors($validator)
                ->withInput();
            } else {
                $data = new Product();

                if($request->hasfile('image')){
                    $img = $request->file('image');
                    $ext = $img->extension();
                    $imageName = 'pro_'.time().'.'.$ext;
                    $request->image->move(public_path('pro_img'), $imageName);
                    $data->image = $imageName;
                }

                $data->product_name = $request->post("product_name");
                $data->model = $request->post("model");
                $data->brand = $request->post("brand");
                $data->short_desc = $request->post("short_desc");
                $data->desc = $request->post("desc");
                $data->keywords = $request->post("keywords");
                $data->technical_specification = $request->post("technical_specification");
                $data->uses = $request->post("uses");
                $data->warranty = $request->post("warranty");
                $data->lead_time = $request->post("lead_time");
                $data->tax_id = $request->post("tax_id");
                $data->is_promo = $request->post("is_promo");
                $data->is_featured = $request->post("is_featured");
                $data->is_discounted = $request->post("is_discounted");
                $data->is_tranding = $request->post("is_tranding");
                $data->slug = Str::slug($request->post("slug"));
                $data->category_id = $request->post("category");
            }
        }

        $data_validate = $data->save();
        $pid = $data->id;

        if($request->post('product_id') > 0) {
            
           
            /*Product Attr Start*/
            $skuArr = $request->post('sku');
            $mrpArr = $request->post('mrp');
            $priceArr = $request->post('price');
            $qtyArr = $request->post('qty');
            $sizeArr = $request->post('size');
            $colorArr = $request->post('color');
            $productArr_id = $request->post('prodAttr_id');
            $prodmultiArr_id = $request->post('prodmulti_id');


            foreach($prodmultiArr_id as $key => $val){
                $mul_random = rand(111111111,999999999);
                $prodmulti_id = $prodmultiArr_id[$key];
                $products_id = $pid;
                $multiImg = array(
                    'products_id'=>$products_id,
                );


                if($request->hasFile("multi_image.$key")){
                    if($prodmultiArr_id[$key] != ''){
                        $prod_multi_img=ProductmultiImage::where('id',$prodmultiArr_id[$key])->first()->toArray();
                        if(file_exists(public_path("pro_multi_img/".$prod_multi_img['multi_image']))){
                            unlink("pro_multi_img/".$prod_multi_img['multi_image']);
                        }
                    }
                    $multi_img = $request->file("multi_image.$key");
                    $ext = $multi_img->extension();
                    $multiimageName = 'pro_multi_img_'.$mul_random.'.'.$ext;
                    $request->file("multi_image.$key")->move(public_path('pro_multi_img'), $multiimageName);
                    $multiImg['multi_image'] = $multiimageName;
                }

                if($prodmulti_id == ''){
                    DB::table('productmulti_images')->insert($multiImg);
                } else {
                    DB::table('productmulti_images')->where('id',$prodmulti_id)->update($multiImg);
                }


            }
            
            foreach ($skuArr as $key => $val) {
                $random = rand(111111111,999999999);
                $id = $productArr_id[$key];
                $products_id = $pid;
                $sku = $skuArr[$key];
                $mrp = $mrpArr[$key];
                $price = $priceArr[$key];
                $qty = $qtyArr[$key];
                $size_id = $sizeArr[$key];
                $color_id = $colorArr[$key];
                
                $data = array(
                    'products_id'=>$products_id,
                    'sku'=>$sku,
                    'mrp'=>$mrp,
                    'price'=>$price,
                    'qty'=>$qty,
                    'size_id'=>$size_id,
                    'color_id'=>$color_id
                );

                

                if($request->hasFile("attr_image.$key")){

                    if($productArr_id[$key] != ''){
                        $prod_attr_img=Product_attr::where('id',$productArr_id[$key])->first()->toArray();
       
                        if(file_exists(public_path("pro_attr_img/".$prod_attr_img['attr_image']))){
                            unlink("pro_attr_img/".$prod_attr_img['attr_image']);
                        }
                    }

                    $attr_img = $request->file("attr_image.$key");
                    $ext = $attr_img->extension();
                    $imageName = 'pro_attr_'.$random.'.'.$ext;
                    $request->file("attr_image.$key")->move(public_path('pro_attr_img'), $imageName);
                    $data['attr_image'] = $imageName;
                }
                if($id == ''){
                    DB::table('product_attrs')->insert($data);
                } else {
                    DB::table('product_attrs')->where('id',$id)->update($data);
                }
                
            } 
           
            /*Product Attr End*/
        } else {

            /*Product Attr Start*/
            $skuArr = $request->post('sku');
            $mrpArr = $request->post('mrp');
            $priceArr = $request->post('price');
            $qtyArr = $request->post('qty');
            $sizeArr = $request->post('size');
            $colorArr = $request->post('color');
            foreach ($skuArr as $key => $val) {
                $random = rand(111111111,999999999);
                $productAttrArr['products_id'] = $pid;
                $productMultiImageArr['products_id'] = $pid;
                $productAttrArr['sku'] = $skuArr[$key];
                $productAttrArr['mrp'] = $mrpArr[$key];
                $productAttrArr['price'] = $priceArr[$key];
                $productAttrArr['qty'] = $qtyArr[$key];
                $productAttrArr['size_id'] = $sizeArr[$key];
                $productAttrArr['color_id'] = $colorArr[$key];
                if($request->hasFile("attr_image.$key")){
                    $attr_img = $request->file("attr_image.$key");
                    $ext = $attr_img->extension();
                    $imageName = 'pro_attr_'.$random.'.'.$ext;
                    $request->file("attr_image.$key")->move(public_path('pro_attr_img'), $imageName);
                    $productAttrArr['attr_image'] = $imageName;
                }
                if($request->hasFile("multi_image.$key")){
                    $multi_img = $request->file("multi_image.$key");
                    $ext = $multi_img->extension();
                    $multiimageName = 'pro_multi_img_'.$random.'.'.$ext;
                    $request->file("multi_image.$key")->move(public_path('pro_multi_img'), $multiimageName);
                    $productMultiImageArr['multi_image'] = $multiimageName;
                }

                DB::table('product_attrs')->insert($productAttrArr);
                DB::table('productmulti_images')->insert($productMultiImageArr);

            }
            /*Product Attr End*/
        }


        if($request->post('product_id') > 0){
            if($data_validate == 1){
                $request->session()->flash('success', "Product updated successfully");
                return redirect()->route('admin_product');
            } else {
                $request->session()->flash('error', "Product not updated successfully");
                return redirect()->route('admin_product');
            }
        } else {
            if($data_validate == 1){
                $request->session()->flash('success', "Product created successfully");
                return redirect()->route('admin_product');
            } else {
                $request->session()->flash('error', "Product not created successfully");
                return redirect()->route('admin_product');
            }
        }
    }

    /**
     * Delete Attr of Product.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function deleteAttr(Request $request){
        
        $prod_attr_id = $request->post('prod_attr_id');
        $prod_attr_img=Product_attr::where('id',$prod_attr_id)->first()->toArray();
       
        if(file_exists(public_path("pro_attr_img/".$prod_attr_img['attr_image']))){
            unlink("pro_attr_img/".$prod_attr_img['attr_image']);
        }

        $result=Product_attr::where('id',$prod_attr_id)->delete();
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Product Attribute Deleted Successfully'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Something Went Wrong'
            )); 
        }
    }

    public function deleteMultiImage(Request $request){
        $prod_multi_id = $request->post('prod_multi_id');
        $prod_multi_img=ProductmultiImage::where('id',$prod_multi_id)->first()->toArray();
       
        if(file_exists(public_path("pro_multi_img/".$prod_multi_img['multi_image']))){
            unlink("pro_multi_img/".$prod_multi_img['multi_image']);
        }
        
        $result=ProductmultiImage::where('id',$prod_multi_id)->delete();
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Product Multiple Image Deleted Successfully'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Something Went Wrong'
            )); 
        }
    }

    

    /**
     * Change Status of Product.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function change_product_status(Request $request ){
        $product_status = $request->post('product_status');
        $product_id  = $request->post('product_id');
        $data = array('status'=>$product_status);
        $result = DB::table('products')->where('id',$product_id)->update($data);
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Product Status Updated'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Product Status Not Updated'
            )); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $product_id = $request->post('product_id');
        $prod_attr_imgs=Product_attr::where('products_id',$product_id)->get()->toArray();
        foreach ($prod_attr_imgs as $key => $prod_attr_img) {
            if(file_exists(public_path("pro_attr_img/".$prod_attr_img['attr_image']))){
                unlink("pro_attr_img/".$prod_attr_img['attr_image']);
            }
        }

        $prod_multi_imgs=ProductmultiImage::where('products_id',$product_id)->get()->toArray();
        foreach ($prod_multi_imgs as $key => $prod_multi_img) {
            if(file_exists(public_path("pro_multi_img/".$prod_multi_img['multi_image']))){
                unlink("pro_multi_img/".$prod_multi_img['multi_image']);
            }
        }

        Product_attr::where('products_id',$product_id)->delete();
        ProductmultiImage::where('products_id',$product_id)->delete();
            
        $result=Product::where('id',$product_id)->delete();
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Product Deleted Successfully'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Something Went Wrong'
            )); 
        }
    }
}
