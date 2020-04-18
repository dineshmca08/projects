<?php

namespace App\Http\Controllers;

use App\VideoSubscribe;
use App\UserVideoLike;
use App\Video;
use App\Category;
use App\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDF;
class VideoSubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response_data["videos"] = VideoSubscribe::with(["usersubscribe","user"])->get();
        return view("subscribe.list")->with($response_data);
    }

    public function free()
    {
        $response_data["videos"] = Video::with(["category:id,name","videocategory:id,name"])->whereCategoryType(1)->get();
        return view("user.freelist")->with($response_data);
    }

    public function subscribe()
    {
        $response_data["videos"] = Video::with(["category:id,name","videocategory:id,name"])->whereCategoryType(2)->get();
        return view("user.subscribelist")->with($response_data);
    }

    public function details($id)
    {
        $response_data["videos"] = Video::with(["category:id,name","videocategory:id,name"])->whereId($id)->first();
        return view("user.details")->with($response_data);
    }

    public function usersubscribelist(){
        $response_data["videos"] = VideoSubscribe::with(["usersubscribe"])->whereUserId(Auth::user()->id)->get();
        return view("user.usersubscribelist")->with($response_data);
    }

    public function likevideos(){
        $response_data["videos"] = UserVideoLike::with(["usersubscribe","usersubscribe.category:id,name","usersubscribe.videocategory:id,name"])->whereUserId(Auth::user()->id)->get();
        return view("user.likevideos")->with($response_data);
    }

    public function usersubscribe(Request $request){
        $validator = Validator::make($request->all(),
            [
              'data' => 'required|exists:videos,id,deleted_at,NULL',
            ]);
            
        if (!$validator->fails()) 
        { 
            $check =VideoSubscribe::whereVideosId($request->data)->whereUserId(Auth::user()->id)->first();
            if(!$check)
            {
                $subscribe = new VideoSubscribe();
                $subscribe->videos_id = $request->data; 
                $subscribe->user_id = Auth::user()->id; 
                if($subscribe->save()){
                    $response_data =  ['success' => 1, 'message' => 'Video Subscribe Successfully']; 
                }else{
                    $response_data =  ['success' => 0, 'message' =>'Server Error'];
                }
            }
            else
            {
                 $response_data =  ['success' => 0, 'message' =>'You Alread subscribe this!'];
            }

        }else{
            $response_data = ["success" => 0, "message" => "Check the input field", "errors" => $validator->errors()];
        }
        return response()->json($response_data);
    }

    public function userlike(Request $request){
        $validator = Validator::make($request->all(),
            [
              'data' => 'required|exists:videos,id,deleted_at,NULL',
            ]);
            
        if (!$validator->fails()) 
        { 
            $check =UserVideoLike::whereVideosId($request->data)->whereUserId(Auth::user()->id)->first();
            if(!$check)
            {
                $like = new UserVideoLike();
                $like->videos_id = $request->data; 
                $like->user_id = Auth::user()->id; 
                if($like->save()){
                    $video = Video::find($request->data);
                    $video->increment('like_count');
                    $video->save();
                    $response_data =  ['success' => 1, 'message' => 'Video liked Successfully']; 
                }else{
                    $response_data =  ['success' => 0, 'message' =>'Server Error'];
                }
            } else{
                $response_data =  ['success' => 0, 'message' =>'You Alread like this!'];
            }

        }else{
            $response_data = ["success" => 0, "message" => "Check the input field", "errors" => $validator->errors()];
        }

        return response()->json($response_data);
    }


    public function viewpdf()
    {
        $response_data["videos"] = VideoSubscribe::with(["usersubscribe","user"])->get();
         $response_data["title"] = "Video streaming system";
         $response_data["heading"] = "Subscribe User list";
        $pdf = PDF::loadView('pdf.view', $response_data);  
        return $pdf->download('medium.pdf');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VideoSubscribe  $videoSubscribe
     * @return \Illuminate\Http\Response
     */
    public function show(VideoSubscribe $videoSubscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VideoSubscribe  $videoSubscribe
     * @return \Illuminate\Http\Response
     */
    public function edit(VideoSubscribe $videoSubscribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VideoSubscribe  $videoSubscribe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VideoSubscribe $videoSubscribe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VideoSubscribe  $videoSubscribe
     * @return \Illuminate\Http\Response
     */
    public function destroy(VideoSubscribe $videoSubscribe)
    {
        //
    }
}
