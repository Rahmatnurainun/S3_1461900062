<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('buku')
            ->join('rak_buku', 'rak_buku.id_buku', '=', 'buku.id')
            ->join('jenis_buku', 'jenis_buku.id', '=', 'rak_buku.id_jenis_buku')
            ->select('buku.id', 'judul', 'tahun_terbit', 'jenis_buku.jenis')
            ->get();
        return view('buku0062', ['data' => $data]);
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $data = DB::table('buku')
            ->where('judul', 'like', "%" . $search . "%")
            ->join('rak_buku', 'rak_buku.id_buku', '=', 'buku.id')
            ->join('jenis_buku', 'jenis_buku.id', '=', 'rak_buku.id_jenis_buku')
            ->select('buku.id', 'judul', 'tahun_terbit', 'jenis_buku.jenis')
            ->get();
        return view('buku0062', ['data' => $data]);
    }

    public function tambah()
    {
        return view('tambah0062');
    }

    public function hapus($id)
    {
        $id_jenis = DB::table('rak_buku')->where('id_buku', $id)->select('id_jenis_buku')->get();
        $id_jenis = json_decode(json_encode($id_jenis), true);
        DB::table('rak_buku')->where('id_buku', $id)->delete();
        DB::table('buku')->where('id', $id)->delete();
        DB::table('jenis_buku')->where('id', $id_jenis)->delete();
        return redirect('/');
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
        DB::table('buku')->insert([
            'judul' => $request->judul,
            'tahun_terbit' => $request->tahun_terbit,
        ]);
        $id_buku = DB::getPdo()->lastInsertId();



        DB::table('jenis_buku')->insert([
            'jenis' => $request->jenis
        ]);

        $id_jenis = DB::getPdo()->lastInsertId();

        DB::table('rak_buku')->insert([
            'id_buku' => $id_buku,
            'id_jenis_buku' => $id_jenis,
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
