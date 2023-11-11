<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Movies as AdminMovies;
use App\Http\Requests\Admin\MoviesRequest;
use App\Models\Admin\Movies;
use FFMpeg\Driver\FFMpegDriver;
use Hamcrest\Type\IsString;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;
use FFMpeg\FFMpeg;

class MoviesController extends Controller
{
    private $data;
    private $movies;
    private $categorys;

    const _PER_PAGE = 10;

    public function __construct()
    {
        $this->movies = new Movies();
        $this->categorys = new Movies();
    }

    public function index()
    {
        $this->data['title'] = 'Movies';
        $this->data['movies'] = $this->movies->getMovies(self::_PER_PAGE);

        // dd($this->data['movies']);

        return view('clients.admin.movies.list', $this->data);
    }

    public function add()
    {
        $this->data['title'] = 'Thêm Movies';
        $this->data['category'] = $this->categorys->getCategorys();

        return view('clients.admin.movies.add', $this->data);
    }

    public function postAdd(Request $request)
    {


        if ($request->poster != null) {
            $poster = md5($request->poster->getClientoriginalName()) . uniqid() . '.' . $request->poster->getClientOriginalExtension();
            $request->poster->move(public_path('asset\clients\video'), $poster);
        } else {
            $trailer = null;
        }

        if ($request->image != null) {
            $image = md5($request->image->getClientoriginalName()) . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('asset\clients\video'), $image);
        } else {
            $trailer = null;
        }

        if ($request->trailer != null) {
            $trailer = md5($request->trailer->getClientoriginalName()) . uniqid() . '.' . $request->trailer->getClientOriginalExtension();
            $request->trailer->move(public_path('asset\clients\video'), $trailer);
        } else {
            $trailer = null;
        }

        if ($request->movie != null) {
            $movieLink = md5($request->movie->getClientoriginalName()) . uniqid() . '.' . $request->movie->getClientOriginalExtension();
            $request->movie->move(public_path('asset\clients\video'), $movieLink);
        } else {
            $movieLink = null;
        }


        $data = [
            'name' => $request->name,
            'poster' => $poster,
            'image' =>  $image,
            'trailer' => $trailer,
            'movieLink' => $movieLink,
            'content' => $request->content,
            'year' => $request->year,
            'performer' => $request->performer,
            'nation' => $request->nation,
            'length' => $request->length,
            'episode' => $request->episode,
            'age' => $request->age,
            'id_category' => $request->category,
            'create_at' => date('Y-m-d H:i:s')
        ];

        // dd($data);


        $this->movies->insertMovie($data);

        return back()->with('msg', 'Thêm thành công');
    }

    public function getEdit(Request $request, $id = 0)
    {
        $this->data['title'] = 'Cập nhật Movie';
        // dd($id);

        if (!empty($id)) {
            $this->data['movieDetail'] = $this->movies->getMovieId($id);
            $this->data['category'] = $this->categorys->getCategorys();
            // dd($this->data['movieDetail'][0]->name);
            if (!empty($this->data['movieDetail'][0]->id)) {
                # code...
                $request->session()->put('id_mv', $id);
            } else {
                return redirect()->route('admin.movies.index')->with('msg', 'Movie không tồn tại!');
            }
        } else {
            return redirect()->route('admin.movies.index')->with('msg', 'Liên kết không tồn tại!');
        }

        return view('clients.admin.movies.edit', $this->data);
    }

    public function postEdit(MoviesRequest $request, $id = 0)
    {
        $id = session('id_mv');
        if (empty($id)) {
            return back()->with('msg', 'Liên kết không tồn tại');
        }
        $dataOld = $this->movies->getMovieId($id);

        if ($request->poster == null) {
            $poster = $dataOld[0]->poster;
        } else {
            $poster = md5($request->poster->getClientoriginalName()) . uniqid() . '.' . $request->poster->getClientOriginalExtension();
            $request->poster->move(public_path('asset\clients\images'), $poster);
            if ($dataOld[0]->poster != null && file_exists(public_path('asset/clients/images/') . $dataOld[0]->poster)) {
                unlink(public_path('asset/clients/images/') . $dataOld[0]->poster);
            }
        }

        if ($request->image == null) {
            $image = $dataOld[0]->image;
        } else {
            $image = md5($request->image->getClientoriginalName()) . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('asset\clients\images'), $image);
            if ($dataOld[0]->image != null && file_exists(public_path('asset/clients/images/') . $dataOld[0]->image)) {
                unlink(public_path('asset/clients/images/') . $dataOld[0]->image);
            }
        }

        if ($request->trailer == null) {
            $trailer = $dataOld[0]->trailer;
        } else {
            $trailer = md5($request->trailer->getClientoriginalName()) . uniqid() . '.' . $request->trailer->getClientOriginalExtension();
            $request->trailer->move(public_path('asset\clients\video'), $trailer);
            if ($dataOld[0]->trailer != null && file_exists(public_path('asset/clients/video/') . $dataOld[0]->trailer)) {
                unlink(public_path('asset/clients/video/') . $dataOld[0]->trailer);
            }
        }

        if ($request->movie == null) {
            $movieLink = $dataOld[0]->movieLink;
        } else {
            $movieLink = md5($request->movie->getClientoriginalName()) . uniqid() . '.' . $request->movie->getClientOriginalExtension();
            $request->movie->move(public_path('asset\clients\video'), $movieLink);
            if ($dataOld[0]->movieLink != null && file_exists(public_path('asset/clients/video/') . $dataOld[0]->movieLink)) {
                unlink(public_path('asset/clients/video/') . $dataOld[0]->movieLink);
            }
        }

        $dataUpdate = [
            'name' => $request->name,
            'poster' => $poster,
            'image' =>  $image,
            'trailer' => $trailer,
            'movieLink' => $movieLink,
            'content' => $request->content,
            'year' => $request->year,
            'performer' => $request->performer,
            'nation' => $request->nation,
            'length' => $request->length,
            'episode' => $request->episode,
            'age' => $request->age,
            'id_category' => $request->category,
            'update_at' => date('Y-m-d H:i:s')
        ];
        // dd($dataUpdate);





        $this->movies->updateMovie($dataUpdate, $id);

        return redirect()->route('admin.movies.index')->with('msg', 'Cập nhật Movie thành công');
    }

    public function delete($id)
    {
        $data = $this->movies->getMovieId($id);

        $poster = $data[0]->poster == null ? '' : public_path('asset/clients/images/') . $data[0]->poster;
        $image = $data[0]->image == null ? '' : public_path('asset/clients/images/') . $data[0]->image;
        $trailer = $data[0]->trailer == null ? '' : public_path('asset/clients/video/') . $data[0]->trailer;
        $movieLink = $data[0]->movieLink == null ? '' : public_path('asset/clients/video/') . $data[0]->movieLink;


        if ($data) {
            $files = [
                'filePoster' => $poster,
                'fileImgae' => $image,
                'fileTrailer' => $trailer,
                'fileMovie' => $movieLink
            ];
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $this->movies->deleteMovie($id);
        }

        return response()->json(['message' => 'Xóa thành công']);
    }
}
