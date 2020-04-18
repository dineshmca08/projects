<?php

namespace App\Http\Controllers;

use App\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class VideoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response_data["category"] = VideoCategory::all();
        return view("videocategory.list")->with($response_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_request = $request->all();
        $validator = Validator::make($new_request,
            [
                'name'=> 'required|min:3|max:75|string|unique:video_categories,name',
            ]);

        if(!$validator->fails()){
            $categories = new VideoCategory();
            $categories->name           = $request->name;
            if($categories->save()){
                $response_data = ["success" => 1,"message" =>"Video Category Created Successfully" ];
            }else{
                $response_data = ["success" => 0, "message" => "Server Error"];
            }
        }else{
            $response_data = ["success" => 0, "message" => "Check the input field", "errors" => $validator->errors()];
        }
    
        return response()->json($response_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function show(VideoCategory $videoCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
              'data' => 'required|exists:vidoe_categories,id,deleted_at,NULL',
            ]);
            
        if (!$validator->fails()) 
        { 
            $typeId = $request->data;
            $category = VideoCategory::where('id', $typeId)->first();
            if($category)
            {
                $response_data = ["success" => 1, "data" => $category];
            }
            else
            {
                $response_data = ["success" => 0, "message" => 'Server Error'];
            }
        }
        else
        {
            $response_data = ["success" => 0, "message" => 'Check the input field', "errors" => $validator->errors()];
        }
        return response()->json($response_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoCategory $videoCategory)
    {
        $typeId = $request->data;
        $new_request = $request->all();
        $validator = Validator::make($new_request,
            [
                'data' => 'required|exists:video_categories,id,deleted_at,NULL',
                'name' => 'required|min:3|max:75|string|unique:video_categories,name,'.$typeId.',id,deleted_at,NULL',
            ]);

        if(!$validator->fails()){
            $category = VideoCategory::find($typeId);
            $category->name           = $request->name;
            if($category->save()){
                $response_data = ["success" => 1,"message" => "Video Category Updated Successfully"];
            }else{
                $response_data = ["success" => 0, "message" => 'Server Error'];
            } 
        
        }else{
            $response_data = ["success" => 0, "message" =>"Check the input field" , "errors" => $validator->errors()];
        }
       
        return response()->json($response_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideoCategory  $videoCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
              'data' => 'required|exists:video_categories,id,deleted_at,NULL',
            ]);
            
        if (!$validator->fails()) 
        { 
            $category = VideoCategory::find($request->data); 
            if($category->delete()){
                    $response_data =  ['success' => 1, 'message' => 'Video Category Deleted Successfully']; 
            }else{
                $response_data =  ['success' => 0, 'message' =>'Server Error'];
            }

        }else{
            $response_data = ["success" => 0, "message" => "Check the input field", "errors" => $validator->errors()];
        }

        return response()->json($response_data);
    }
}
