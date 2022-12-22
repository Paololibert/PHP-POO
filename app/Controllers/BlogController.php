<?php
 
namespace App\Controllers;
use App\Models\Post;
use App\Models\Tag;
 
class BlogController extends Controller
{ 


    public function welcome()
    {
        return $this->view('blog.welcom');
    }

    public function index()
    {
        $post = new Post($this->getDB());

        $posts = $post->all();
 
    	return $this->view('blog.index',compact('posts'));
    }
 
 
 
 
    public function show(int $id)
    {
       $post = new Post($this->getDB());
       $post = $post->findByID($id);
        
        //var_dump($post);
    	return $this->view('blog.show', compact('post'));
    }


    /**
     * @param int $id
     */
    public function tag($id)
    {
        $tag = (new Tag($this->getDB()))->findByID($id);

        
        
        return $this->view('blog.tag',compact('tag'));
    }
    
}

 
