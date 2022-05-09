<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Response;
use App\Http\Traits\CategoriesTrait;
use PDFDOM;

class CategoryController extends Controller
{
    use CategoriesTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
        if($request->post("searchText")){
            $term = $request->post("searchText");
            $categories = DB::table('categories')->where('category_slug','LIKE','%'.$term.'%')->get()->toArray();

            $html = "";
            $i=1;
            if(empty($categories)){
                $html .= "<tr><td class='text-center' colspan='6'>No Category Found</td></tr>";
            } else {
                foreach ($categories as $key => $category) {
                    $html .= "<tr>
                        <td>".$i ."</td>
                        <td>" . ucfirst($category->category_name) . "</td>
                        <td>" . $category->category_slug . "</td>";
                        $html .= "<td>";
                        if ($category->category_image){
                            if(file_exists(public_path("category_image/".$category->category_image))){
                                $html .= '<img src="{!! url('/category_image/'.$category->category_image) !!}" alt="mostafid" height="20" width="20">';
                            } else {
                                $html .= '<img src="{!! url('/pro_img/'.download.png) !!}" alt="mostafid" height="20" width="20">';
                            }
                        } else {
                            $html .= '<img src="{!! url('/pro_img/'.download.png) !!}" alt="mostafid" height="20" width="20">';
                        }

                        $html .= "</td>";
                        $html .= "<td>";
                        if($category->status == true){
                            $html .= "<button onclick='changCatStatus($category->id,$category->status)' type='button' class='btn btn-success'>Active</button>";
                        } else {
                            $html .= "<button onclick='changCatStatus($category->id,$category->status)' type='button' class='btn btn-danger'>Deactive</button>";
                        }

                        
                        $html .= "</td>
                            <td>
                                <a href='http://127.0.0.1:8000/admin/category/manage_category/".$category->id."'>
                                    <button class='btn btn-warning'>Edit</button>
                                </a>
                                <button class='btn btn-danger' onclick='deleteCat($category->id)'>Delete</button>
                            </td>
                        </tr>";
    
                    
                }
            }
            

            print_r($html);


        } else {
            $page_data['categories'] = Category::orderBy('id', 'DESC')->get();
            $page_data['title'] = "admin category";
            return view('admin.category', $page_data);
        }

        
    }

    /**
     * Show the form for creating a new resource. and editing
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_category($id = '', Request $request)
    {
        
        if($id > 0){
            $result = Category::where(["id" => $id])->first()->toArray();
            $page_data['title'] = "edit category";
            $page_data['category_name'] = $result['category_name'];
            $page_data['category_slug'] = $result['category_slug'];
            $page_data['category_image'] = $result['category_image'];
            $page_data['is_home'] = $result['is_home'];
            $page_data['category_id'] = $result['id'];
            $page_data['parent_category_id'] = $result['parent_category_id'];
            $page_data['categories'] = $this->getCategories($id);
        } else {
            $page_data['title'] = "add category";
            $page_data['category_name'] = '';
            $page_data['category_slug'] = '';
            $page_data['category_image'] = '';
            $page_data['is_home'] = '';
            $page_data['category_id'] = '';
            $page_data['parent_category_id'] = '';
            $page_data['categories'] = $this->getCategories();
        }
       
       return view("admin.addcategory", $page_data);
    }


    public function downloadPdfCat(){
      
        $time = time();
        $categories = $this->getCategories();
        $pdf = PDFDOM::loadView('admin.pdf.category', compact('categories'));

        return $pdf->download("categories_$time.pdf");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manage_category_process(Request $request)
    {
        
        
        if($request->post('cat_id') > 0) {
            $validate_img = 'mimes:jpeg,png,jpg';
        } else {
            $validate_img = 'required|mimes:jpeg,png,jpg';
        }

        
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'category_slug' => 'required|unique:categories,category_slug,'.$request->post('cat_id'),
            'category_image' =>  $validate_img
        ]);

        if($request->post('cat_id') > 0) {
            if ($validator->fails()) {
                return redirect()->route('editCat', ['id' => $request->post('cat_id')])
                ->withErrors($validator)
                ->withInput();
            } else {
             
                $data = Category::find($request->post('cat_id'));
                $data->category_name = $request->post("category_name");

                if($request->hasfile('category_image')){
                    if($data->id != ''){
                        if($data->category_image){
                            if(file_exists(public_path("category_image/".$data->category_image))){
                                unlink("category_image/".$data->category_image);
                            }
                        }
                    }
                }
                

                if($request->hasfile('category_image')){
                    $img = $request->file('category_image');
                    $ext = $img->extension();
                    $imageName = 'cat_img_'.time().'.'.$ext;
                    $request->category_image->move(public_path('category_image'), $imageName);
                    $data->category_image = $imageName;
                }
                
                $data->category_slug = Str::slug($request->post("category_slug"));

               
                if(array_key_exists("is_home",$request->post())){
                    $is_home = 1;
                    
                } else {
                    $is_home = 0;
                    
                }

                $data->parent_category_id = $request->post("parent_category_id");
                $data->is_home = $is_home;
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Category updated successfully");
                    return redirect()->route('admin_category');
                } else {
                    $request->session()->flash('error', "Category not updated successfully");
                    return redirect()->route('admin_category');
                }
            }
        } else {
            if ($validator->fails()) {
                return redirect()->route('add_category')
                ->withErrors($validator)
                ->withInput();
            } else {

                
                $data = new Category();
                $data->category_name = $request->post("category_name");
                if(array_key_exists("is_home",$request->post())){
                    $is_home = 1;
                    
                } else {
                    $is_home = 0;
                    
                }
                $data->is_home = $is_home;

                if($request->hasfile('category_image')){
                    $img = $request->file('category_image');
                    $ext = $img->extension();
                    $imageName = 'cat_img_'.time().'.'.$ext;
                    $request->category_image->move(public_path('category_image'), $imageName);
                    $data->category_image = $imageName;
                }

                $data->category_slug = Str::slug($request->post("category_slug"));
                $data->parent_category_id = $request->post("parent_category_id");
    
                $data_validate = $data->save();
                if($data_validate == 1){
                    $request->session()->flash('success', "Category created successfully");
                    return redirect()->route('admin_category');
                } else {
                    $request->session()->flash('error', "Category not created successfully");
                    return redirect()->route('admin_category');
                }
            }
        }
       
    }

    /**
     * Change Status of Category.
     *
     * @param  \App\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function change_cat_status(Request $request ){
        $cat_status = $request->post('cat_status');
        $cat_id  = $request->post('cat_id');
        $data = array('status'=>$cat_status);
        $result = DB::table('categories')->where('id',$cat_id)->update($data);
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Category Status Updated'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Category Status Not Updated'
            )); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $cat_id  = $request->post('cat_id');

        $category_image=Category::where('id',$cat_id)->first()->toArray();
       
        if(file_exists(public_path("category_image/".$category_image['category_image']))){
            unlink("category_image/".$category_image['category_image']);
        }

        $result=Category::where('id',$cat_id)->delete();
        if($result == 1){
            return Response::json(array(
                'result' => 'success',
                'data'   => 'Category Deleted Successfully'
            )); 
        } else {
            return Response::json(array(
                'result' => 'error',
                'data'   => 'Something Went Wrong'
            )); 
        }

    }


    public function activate(Request $request)
    {
        $data = array('status'=>1);
        $result = DB::table('categories')->update($data);
        return Response::json(array(
            'result' => 'success',
            'data'   => 'Status Updated'
        )); 
        
    }
}
