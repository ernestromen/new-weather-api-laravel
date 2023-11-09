<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Database\QueryException;

class PageController extends Controller
{

    public function index(){
        dd('laravel endpoint work!');
    }

    public function showAllFavorites(){
        $favorites = Favorite::all();
        return view('favorites',[
            'favorites' => $favorites
        ]);
    }

    public function getAllFavorites(){
        try {
            $favorites = Favorite::all();

        return response()->json($favorites);
        
        } catch (\Exception $e) {

        return view('404');
        }

    }

    public function store(Request $request){

        try {
            Favorite::insert($request->get('data'));
        
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
    
    public function delete($favoritecity){
        try {
            Favorite::where('favorite_city', $favoritecity)->delete();
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
//    @method('delete')
    public function deleteById($id){
     
        try {
            Favorite::where('id', $id)->delete();
            return redirect()->route('favorite_list');
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }
}