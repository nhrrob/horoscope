<?php

namespace App\Http\Controllers;

use App\Http\Requests\HoroscopeRequest;
use App\Http\Traits\GlobalTrait;
use App\Models\Horoscope;
use Exception;
use Illuminate\Support\Facades\Auth;

class HoroscopeController extends Controller
{
    use GlobalTrait;

    public function index()
    {
        $data['horoscopes'] = Horoscope::latest()->get();
        return view('horoscope.index', $data);
    }

    public function create()
    {
        $this->adminOnly();

        return view('horoscope.create');
    }

    public function store(HoroscopeRequest $request)
    {
        $this->adminOnly();
        
        try{
            $horoscope = Horoscope::create($request->all());

            $notification = array(
                'message' => 'Horoscope saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('horoscopes.index')->with($notification);

        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('horoscopes.index')->with($notification);
        }
    }

    public function show(Horoscope $horoscope)
    {
        //
    }

    public function edit(Horoscope $horoscope)
    {
        $this->adminOnly();
        
        $data['horoscope'] = $horoscope;
        return view('horoscope.edit', $data);
    }

    public function update(HoroscopeRequest $request, Horoscope $horoscope)
    {
        $this->adminOnly();

        try {
            $horoscope = $horoscope->update($request->all());

            $notification = array(
                'message' => 'Horoscope saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('horoscopes.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('horoscopes.index')->with($notification);
        }
    }

    public function destroy(Horoscope $horoscope)
    {
        $this->adminOnly();

        try{
            Horoscope::find($horoscope->id)->delete();

            $notification = array(
                'message' => 'Horoscope deleted successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('horoscopes.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('horoscopes.index')->with($notification);
        }
    }

    
}
