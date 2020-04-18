<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoCategory;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response_data["category"] = Category::all();
        $response_data["categoryType"] = VideoCategory::all();
        $response_data["videos"] = Video::with(["category:id,name","videocategory:id,name"])->get();
        return view("videos.list")->with($response_data);
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
                'name'=> 'required|min:3|max:75|string|unique:videos,name',
                'category'=> 'required|exists:categories,id,deleted_at,NULL',
                'categorytype'=> 'required|exists:video_categories,id,deleted_at,NULL',
                'url'=> 'required|min:3|max:75|string',
                'description'=> 'nullable|min:3|max:75|string',
                'expirydate'=> 'nullable',
            ]);

        if(!$validator->fails()){
            $videos = new Video();
            $videos->name           = $request->name;
            $videos->category_id           = $request->category;
            $videos->category_type           = $request->categorytype;
            $videos->url           = $request->url;
            if($request->has('description'))
            {
               $videos->description           = $request->description; 
            }
            if($request->categorytype==2)
            {
                $add = "+".$request->expirydate." day";
                $videos->expiry_date           = date('Y-m-d',strtotime($add));
            }
            if($videos->save()){
                $response_data = ["success" => 1,"message" =>"Video Created Successfully" ];
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
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
              'data' => 'required|exists:videos,id,deleted_at,NULL',
            ]);
        if (!$validator->fails()) 
        { 
            $typeId = $request->data;
            $video = Video::where('id', $typeId)->first();
            if($video)
            {
                $response_data = ["success" => 1, "data" => $video];
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
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $typeId = $request->data;
        $new_request = $request->all();
        $validator = Validator::make($new_request,
            [
                'data' => 'required|exists:videos,id,deleted_at,NULL',
                'name' => 'required|min:3|max:75|string|unique:videos,name,'.$typeId.',id,deleted_at,NULL',
                'category'=> 'required|exists:categories,id,deleted_at,NULL',
                'categorytype'=> 'required|exists:video_categories,id,deleted_at,NULL',
                'url'=> 'required|min:3|max:75|string',
                'description'=> 'nullable|min:3|max:75|string',
                'expirydate'=> 'nullable',
            ]);

        if(!$validator->fails()){
            $videos = Video::find($typeId);;
            $videos->name           = $request->name;
            $videos->category_id           = $request->category;
            $videos->category_type           = $request->categorytype;
            $videos->url           = $request->url;
            if($request->has('description'))
            {
               $videos->description           = $request->description; 
            }
            if($request->categorytype==2)
            {
                $add = "+".$request->expirydate." day";
                $videos->expiry_date           = date('Y-m-d',strtotime($add));
            }
            if($videos->save()){
                $response_data = ["success" => 1,"message" =>"Video Updated Successfully" ];
            }else{
                $response_data = ["success" => 0, "message" => "Server Error"];
            }
        }else{
            $response_data = ["success" => 0, "message" => "Check the input field", "errors" => $validator->errors()];
        }
    
        return response()->json($response_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
              'data' => 'required|exists:videos,id,deleted_at,NULL',
            ]);
            
        if (!$validator->fails()) 
        { 
            $video = Video::find($request->data); 
            if($video->delete()){
                    $response_data =  ['success' => 1, 'message' => 'Video Deleted Successfully']; 
            }else{
                $response_data =  ['success' => 0, 'message' =>'Server Error'];
            }

        }else{
            $response_data = ["success" => 0, "message" => "Check the input field", "errors" => $validator->errors()];
        }

        return response()->json($response_data);
    }
}
