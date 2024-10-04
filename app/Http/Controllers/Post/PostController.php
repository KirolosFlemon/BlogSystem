<?php
namespace App\Http\Controllers\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\Post\PostResource;
use App\Services\Post\PostService;


class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function get(PostRequest $request)
    {
        $postes = $this->postService->getPostById($request->id);
        return new PostResource($postes);
    }
    /**
     * Retrieves all postes using the post service.
     *
     * @return PostResource
     */
    public function all(PostRequest $request)
    {
        $postes = $this->postService->getAllPosts($request->is_paginate ?? 0);
            return PostResource::collection($postes);
    }

    /**
     * A description of the entire PHP function.
     *
     * @param PostRequest $request 
     * @throws None
     * @return PostResource
     */
    public function create(PostRequest $request)
    {
        $post = $this->postService->createPost($request);
        
        return new PostResource($post);
    }


    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function update(PostRequest $request)
    {
        $post =  $this->postService->updatePost($request->id, $request);
        return new PostResource($post);
    }

    /**
     * Deletes a post by its ID.
     *
     * @param int $id The ID of the post to delete.
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function delete(PostRequest $request)
    {
        $this->postService->deletePost($request->id);
        return response()->json([
            'Message' => 'success.',
            'data' => 'Post deleted successfully.',
        ], 200);
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function getSoftDeleted()
    {
         $post = $this->postService->getSoftDeleted();
        return  PostResource::collection($post);
    }
    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function restore(PostRequest $request)
    {
        $this->postService->restore($request->id);
        return response()->json([
            'data' => 'Post restored successfully.',
            'Message' => 'success.',
        ], 200);
    }
}
