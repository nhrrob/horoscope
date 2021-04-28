<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZodiacSignRequest;
use App\Http\Traits\GlobalTrait;
use App\Models\ZodiacSign;
use Exception;

class ZodiacSignController extends Controller
{
    use GlobalTrait;

    public function index()
    {
        $data['zodiacSigns'] = ZodiacSign::latest()->get();
        return view('zodiac_sign.index', $data);
    }

    public function create()
    {
        $this->adminOnly();

        return view('zodiac_sign.create');
    }

    public function store(ZodiacSignRequest $request)
    {
        $this->adminOnly();

        try{
            $zodiacSign = ZodiacSign::create($request->all());

            $notification = array(
                'message' => 'Zodiac Sign saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('zodiac-signs.index')->with($notification);

        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('zodiac-signs.index')->with($notification);
        }
    }

    public function show(ZodiacSign $zodiacSign)
    {
        //
    }

    public function edit(ZodiacSign $zodiacSign)
    {
        $this->adminOnly();

        $data['zodiacSign'] = $zodiacSign;
        return view('zodiac_sign.edit', $data);
    }

    public function update(ZodiacSignRequest $request, ZodiacSign $zodiacSign)
    {
        $this->adminOnly();

        try {
            $zodiacSign = $zodiacSign->update($request->all());

            $notification = array(
                'message' => 'Zodiac Sign saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('zodiac-signs.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('zodiac-signs.index')->with($notification);
        }
    }

    // public function destroy(ZodiacSign $zodiacSign)
    // {
    //     try{
    //         ZodiacSign::find($zodiacSign->id)->delete();

    //         $notification = array(
    //             'message' => 'Zodiac Sign deleted successfully!',
    //             'alert-type' => 'success'
    //         );

    //         return redirect()->route('zodiac-signs.index')->with($notification);
    //     } catch (Exception $e) {
    //         $notification = array(
    //             'message' => $e->getMessage(),
    //             'alert-type' => 'error'
    //         );
    //         return redirect()->route('zodiac-signs.index')->with($notification);
    //     }
    // }
}
