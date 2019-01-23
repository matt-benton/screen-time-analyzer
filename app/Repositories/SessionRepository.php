<?php

namespace App\Repositories;

use App\Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionRepository
{

    protected $session;



    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function all()
    {
        return Auth::user()->sessions()->orderBy('date', 'desc')->paginate(20);
    }

    public function create(Request $request)
    {
        $start = new Carbon($request->date . ' ' . $request->start);
        $end = new Carbon($request->date . ' ' . $request->end);

        $session = new Session;
        $session->date = $request->date;
        $session->user_id = Auth::user()->id;
        $session->daytime_id = $request->daytime;
        $session->save();

        return $session;
    }

    public function find($id)
    {
        return Auth::user()->activities()->where('id', $id)->first();
    }

    public function update($id, array $attributes)
    {
        return Auth::user()->activities()->where('id', $id)->first()->update($attributes);
    }

    public function delete($id)
    {
        return Auth::user()->activities()->where('id', $id)->delete();
    }
}
