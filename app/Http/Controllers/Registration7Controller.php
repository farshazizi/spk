<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\registration1;
use App\registration7;
use Auth;
use DB;
use Random;

class Registration7Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $data['id_user'] = $request['id_user'];
        // return view('form/registration7', $data);

        $a = DB::table('registration1s')
        ->select('posisi')
        ->where('id_user', '=', Auth::user()->id)->get();

        if ($a->isEmpty()){
            $posisi=1;
        } else{
            $posisi = ($a[0]->posisi);
        }

        if ($posisi == 1) {
            // return redirect('registration');
            return redirect()->route('registration1');
        } elseif ($posisi == 2) {
            // return redirect('registration2');
            return redirect()->route('registration2');
        } elseif ($posisi == 3) {
            // return redirect('registration3');
            return redirect()->route('registration3');
        } elseif ($posisi == 4) {
            // return redirect('registration4');
            return redirect()->route('registration4');
        } elseif ($posisi == 7) {
            // return redirect('registration/7');
            // return view('form/registration7');
            $c = DB::table('registration1s')
            ->select('jenis_kelamin')
            ->where('id_user', '=', Auth::user()->id)->first();
            return view('form.registration7')->with('jekel', $c);
        } elseif ($posisi == 8) {
            // return redirect('registration8');
            return redirect()->route('registration8');
        } elseif ($posisi == 9) {
            // return redirect('registration/8');
            return view('form/waiting');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // validate the data
        $this->validate($request, array(
            'umur_calon_pasangan'           => 'required',
            'tb_calon_pasangan'             => 'required',
            'merokok_calon_pasangan'        => 'required',
            'penghasilan_calon_pasangan'    => 'required',
            'suku_calon_pasangan'           => 'required',
            'bb_calon_pasangan'             => 'required',
            'status_calon_pasangan'         => 'required',
            'karakter_pasangan'             => 'required',
        ));

        // // store in the database
        $reg1 = new Registration1;
        $reg7 = new Registration7;

        $reg7->id_user                      = Auth::user()->id;
        $reg7->umur_calon_pasangan          = $request->umur_calon_pasangan;
        if ($reg7->umur_calon_pasangan == "Remaja") {
            $int = Random::generateInt(18, 27);
            $reg7->randUmur = $int;
        } elseif ($reg7->umur_calon_pasangan == "Dewasa") {
            $int = Random::generateInt(24, 32);
            $reg7->randUmur = $int;
        } elseif ($reg7->umur_calon_pasangan == "Tua") {
            $int = Random::generateInt(29, 35);
            $reg7->randUmur = $int;
        }
        $reg7->tb_calon_pasangan            = $request->tb_calon_pasangan;
        if ($reg7->tb_calon_pasangan == "Pendek") {
            $int = Random::generateInt(120, 167);
            $reg7->randTb = $int;
        } elseif ($reg7->tb_calon_pasangan == "Sedang") {
            $int = Random::generateInt(161, 174);
            $reg7->randTb = $int;
        } elseif ($reg7->tb_calon_pasangan == "Tinggi") {
            $int = Random::generateInt(169, 200);
            $reg7->randTb = $int;
        }
        $reg7->merokok_calon_pasangan       = $request->merokok_calon_pasangan;
        $reg7->penghasilan_calon_pasangan   = $request->penghasilan_calon_pasangan;
        if ($reg7->penghasilan_calon_pasangan == "Rendah") {
            $int = Random::generateInt(500000, 7999999);
            $reg7->randPenghasilan = $int;
        } elseif ($reg7->penghasilan_calon_pasangan == "Sedang") {
            $int = Random::generateInt(3500001, 11999999);
            $reg7->randPenghasilan = $int;
        } elseif ($reg7->penghasilan_calon_pasangan == "Tinggi") {
            $int = Random::generateInt(8000001, 15000000);
            $reg7->randPenghasilan = $int;
        }
        $reg7->suku_calon_pasangan          = $request->suku_calon_pasangan;
        $reg7->bb_calon_pasangan            = $request->bb_calon_pasangan;
        if ($reg7->bb_calon_pasangan == "Kurus") {
            $int = Random::generateInt(40, 64);
            $reg7->randBb = $int;
        } elseif ($reg7->bb_calon_pasangan == "Berisi") {
            $int = Random::generateInt(51, 74);
            $reg7->randBb = $int;
        } elseif ($reg7->bb_calon_pasangan == "Gemuk") {
            $int = Random::generateInt(66, 100);
            $reg7->randBb = $int;
        }
        $reg7->status_calon_pasangan        = $request->status_calon_pasangan;
        $reg7->karakter_pasangan            = $request->karakter_pasangan;

        $b = DB::table('registration1s')
        ->select('id')
        ->where('id_user', '=', Auth::user()->id)->get();

        $reg1 = Registration1::find($b[0]->id);
        // $reg1 = Registration1::find($request->id_user);
        $reg1->posisi = 8;
        $reg1->save();

        $reg7->save();

        // dd($request->all());
        // $data['id_user'] = $reg7->id_user;

        // Session::flash = temporary, exists for one page request
        // Session::put = permanent, exists until the session is removed
        // Session::flash('success', 'Selamat!!!');

        // redirect to another page
        // return redirect()->route('registration4.create', $reg4->id);
        // return redirect()->route('registration8.create', $data);
        return redirect()->route('registration8');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
       
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
