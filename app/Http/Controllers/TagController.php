<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;

class TagController extends Controller
{
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return back();
    }
}
