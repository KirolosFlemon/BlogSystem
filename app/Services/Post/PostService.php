<?php
// app/Services/PostService.php
namespace App\Services\Post;

use App\Repositories\Post\PostRepository;
use App\Traits\HelperFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Retrieves all posts with pagination if specified.
     *
     * @param mixed $is_paginate Indicates if pagination is required.
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection The collection of posts.
     */
    public function getAllPosts($is_paginate)
    {
        return $this->postRepository->all($is_paginate);
    }

    /**
     * A description of the entire PHP function.
     * 
     * @param Request $request 
     * @throws \Exception if an error occurs during post creation
     * @return Post The created post object.
     */
    public function createPost(Request $request)
    {
        try {
            DB::beginTransaction();
            $userId = auth()->user()->id;
            $request['user_id'] = $userId;
            $post =  $this->postRepository->create($request);
            // Commit the transaction if all operations are successful
            DB::commit();
            return $post;
        } catch (\Throwable $th) {
            // Roll back the transaction if any operation fails
            DB::rollback();
            throw new \Exception($th->getMessage());
        }
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $id description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function getPostById($id)
    {
        return $this->postRepository->find($id);
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function updatePost($id, $request)
    {
        try {

            DB::beginTransaction();
            $userId = auth()->user()->id;
            $request['user_id'] = $userId;
            $post = $this->postRepository->update($id, $request);

            // Commit the transaction if all operations are successful
            DB::commit();
            return $post;
        } catch (\Throwable $th) {
            // Roll back the transaction if any operation fails
            DB::rollback();
            throw new \Exception($th->getMessage());
        }
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $id description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function deletePost($id)
    {
        $this->postRepository->delete($id);
    }

    /**
     * Retrieves soft deleted records from the post repository.
     *
     * @return Some_Return_Value
     */
    public function getSoftDeleted()
    {
        return $this->postRepository->getSoftDeleted();
    }



    /**
     * Restores a soft deleted post by its ID.
     *
     * @param int $id The ID of the post to restore.
     * @return void
     */
    public function restore($id)
    {
        // Call the restore method on the post repository
        // to restore the soft deleted post.
        return $this->postRepository->restore($id);
    }
}
