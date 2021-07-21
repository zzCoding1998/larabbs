<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Topic;
use App\Http\Requests\TopicRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request)
	{
		$topics = Topic::with(['user','category'])->withOrder($request->order)->paginate(10);
		return view('topics.index', compact('topics'));
	}

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

	public function store(TopicRequest $request,Topic $topic)
	{
	    $topic->fill($request->all());
	    $topic->user_id = Auth::id();
	    $topic->save();
		return redirect()->route('topics.show', $topic->id)->with('success', '发布成功！');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		return view('topics.create_and_edit', compact('topic'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
	}

	public function uploadImages(Request $request,ImageUploadHandler $handler)
    {
        if($request->upload_file){
            $result = $handler->save($request->upload_file,'topics',Auth::id());
            if($result){
                return [
                    'success' => true,
                    'msg' => '上传成功',
                    'file_path' => config('app.url') . '/' . $result['path']
                ];
            }
        }

        return ['success'=>false,'msg' => '上传失败'];
    }
}
