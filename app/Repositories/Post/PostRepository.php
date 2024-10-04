<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Http\Request;

class PostRepository
{
    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function all($is_paginate)
    {
        if (isset($is_paginate) && $is_paginate != 0) {
            return Post::with('user')->paginate($is_paginate);
        }
        return Post::with('user')->get();
    }

    /**
     * A description of the entire PHP function.
     *
     * @param Request $request 
     * @throws None
     * @return Post The created Post object.
     */
    public function create(Request $request)
    {

        $post = Post::create($request->all());
        return $post->load('user');
    }

    /**
     * Finds a post by its ID.
     *
     * @param int $id The ID of the post to find.
     * @throws ModelNotFoundException if the post with the given ID is not found.
     * @return Post The found post object.
     */
    public function find($id)
    {
        return Post::with('user')->findOrFail($id);
    }

    /**
     * Updates a post by its ID with the provided request data.
     *
     * @param int $id The ID of the post to update.
     * @param mixed $request The request data for updating the post.
     * @return Post The updated post object.
     */
    public function update($id, $request)
    {
        $post = $this->find($id);
        $post->update($request->all());
        return $post->load('user');
    }

    /**
     * Deletes a post by its ID.
     *
     * @param int $id The ID of the post to delete.
     * @throws ModelNotFoundException if the post with the given ID is not found.
     * @return void
     */
    public function delete($id)
    {
        $post = $this->find($id);
        $post->delete();
    }

    
    /**
     * Retrieves soft deleted records from the post repository.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator Paginated post of soft deleted records.
     */
    public function getSoftDeleted()
    {
        // Retrieve soft deleted records from the post repository.
        // Only retrieves 15 records at a time.
        return Post::onlyTrashed()->with('user')->paginate(15);
    }

    /**
     * Restores a soft deleted post.
     *
     * @param int $id The ID of the post to restore.
     * @throws ModelNotFoundException if the post with the given ID is not found.
     * @return bool Returns true if the post is successfully restored, false otherwise.
     */
    public function restore($id)
    {
     // Find the post with the given ID
     $post = Post::withTrashed()->with('user')->findOrFail($id);
    
     // Restore the post and return the result
     return $post->restore();
    }

}
