<?php
/**
 * 博客
 * @author: yikai
 * @date: 2017/12/22
 */

namespace App\Http\Controllers;

use App\Http\Requests\EditBlogPost;
use App\Posts;
use App\Tags;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Posts::with(['tags','comments','users'])->paginate(5);
        return view('blog.index',[
            'data' => $posts,
        ]);
    }

    public function archives(Request $request)
    {
        $date = $request->input('date','');
        if($date == ''){
            return redirect(route('blog_error',['message' => '参数有误']));
        }
        $list  = Posts::whereRaw('date_format(created_at,"%Y-%m")=?',[$date])->paginate(5);
        return view('blog.list-archives',[
            'list' => $list
        ]);
    }

    public function tags(Request $request)
    {
        $tag = $request->input('tag','');
        if($tag == ''){
            return redirect(route('blog_error',['message' => '参数有误']));
        }
        $list  = Posts::from('posts as p')
            ->select('p.*')
            ->where('t.name','=',$tag)
            ->leftJoin('tags as t','p.id','=','t.posts_id')
            ->orderBy('p.created_at','desc')
            ->paginate(5);
        return view('blog.list-tags',[
            'list' => $list
        ]);
    }

    public function about()
    {
        return view('blog.about');
    }

    public function view(Request $request)
    {
        $id = $request->query('id','');
        if($id == ''){
            return redirect(route('blog_error',['message' => '参数有误']));
        }
        $post = Posts::with(['users','comments','tags'])->find($id);
        if(!$post){
            return redirect(route('blog_error',['message' => '未找到此文章']));
        }
        return view('blog.view',['post' => $post]);
    }

    public function create()
    {
        return view('blog.create');
    }

    public function setting()
    {
        return view('blog.setting');
    }

    public function edit(Request $request)
    {
        $id = $request->query('id');
        $post = Posts::with(['users','comments','tags'])->find($id);
        if(!$post){
            return redirect(route('blog_error',['message' => '未找到要编辑的文章']));
        }
        return view('blog.edit',['post' => $post]);
    }

    public function delete(Request $request)
    {
        $id = $request->query('id');
        $post = Posts::find($id);
        if(!$post){
            return redirect(route('blog_error',['message' => '未找到要删除的文章']));
        }
        $post->delete();
        return redirect(route('blog_index'));
    }

    public function editStore(EditBlogPost $request)
    {
        $id = $request->query('id');
        DB::transaction(function () use ($request, $id){
            $post = Posts::find($id);
            $post->content = $request->input('content');
            $post->title = $request->input('title');
            $post->save();

            Tags::where('posts_id','=',$id)->delete();
            $tags = $request->input('tags');
            foreach(explode(' ',$tags) as $tag){
                $arr[] = [
                    'name' => $tag,
                    'posts_id' => $id,
                ];
            }
            DB::table('tags')->insert($arr);
        });

        return redirect(route('blog_view',['id' => $id]));
    }

    public function store(StoreBlogPost $request)
    {
        DB::transaction(function() use ($request){
            $posts_id = DB::table('posts')->insertGetId(
                [
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'users_id' => Auth::id(),
                    'created_at' => date("Y-m-d H:i:s", time()),
                ]
            );

            $arr = [];
            $tags = $request->input('tags');
            foreach(explode(' ',$tags) as $tag){
                $arr[] = [
                    'name' => $tag,
                    'posts_id' => $posts_id,
                ];
            }

            DB::table('tags')->insert($arr);
        });

        return redirect(route('blog_index'));
    }
}