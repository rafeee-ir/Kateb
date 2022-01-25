<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Ticket;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function statusText($status){
        $s='';
        if ($status===1){
            $s='باز';
        }elseif ($status===2){
            $s='در حال انجام';
        }elseif ($status===3){
            $s='پاسخ داده شده';
        }elseif ($status===4){
            $s='بسته شده';
        }elseif ($status===5){
            $s='پاسخ مشتری';
        }
        return $s;
    }
    public function statusColor($status){
        $s='';
        if ($status===1){
            $s='danger';
        }elseif ($status===2){
            $s='warning';
        }elseif ($status===3){
            $s='success';
        }elseif ($status===4){
            $s='secondary';
        }elseif ($status===5){
            $s='danger';
        }
        return $s;
    }
    public function ticketsStats(){
        $tickets_stats_all = Ticket::all()->where('user_id',Auth::id())->count();
        $tickets_stats_1 = Ticket::all()->where('user_id',Auth::id())->where('status',1)->count();
        $tickets_stats_2 = Ticket::all()->where('user_id',Auth::id())->where('status',2)->count();
        $tickets_stats_3 = Ticket::all()->where('user_id',Auth::id())->where('status',3)->count();
        $tickets_stats_4 = Ticket::all()->where('user_id',Auth::id())->where('status',4)->count();
        return [0=>$tickets_stats_all,1=>$tickets_stats_1,2=>$tickets_stats_2,3=>$tickets_stats_3,4=>$tickets_stats_4];
    }
    public function getMyTickets(){
        $tickets = Ticket::where('user_id',Auth::id())->where('reply_to',0)->latest()->with('department')->get();
        foreach ($tickets as $ticket){
            $v = new Verta($ticket->created_at);
            $t = $v->formatDifference();
            $ticket->when = $t;
            $ticket->created_at = new Verta($ticket->created_at);
            $ticket->statusText=$this->statusText($ticket->status);
            $ticket->statusColor=$this->statusColor($ticket->status);
        }
        return $tickets;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'پشتیبانی';
        $tickets = $this->getMyTickets();
        $tickets_stats=$this->ticketsStats();

        return view('tickets.index',compact('pageTitle','tickets','tickets_stats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'ارسال تیکت جدید';
        $departments=Department::all();

        return view('tickets.create',compact('pageTitle','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $ticket = Ticket::create($request->all());


        return redirect()->route('tickets.index')->with('status','تیکت پشتبانی با کد '.$ticket->id.'  با موفقیت ثبت شد');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {

        if (Auth::id() != $ticket->user_id) {
            abort(403);
        }
        else {

        $pageTitle = 'تیکت پشتیبانی';
        $ticket->statusText = $this->statusText($ticket->status);
        $ticket->statusColor = $this->statusColor($ticket->status);
        $v = new Verta($ticket->created_at);
        $t = $v->formatDifference();
        $ticket->when = $t;
        $ticket->created_at = new Verta($ticket->created_at);
        return view('tickets.show',compact('ticket','pageTitle'));
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function getAnswersOfTheTicket($ticket){
        $tickets = Ticket::where('reply_to',$ticket)->get();
        foreach ($tickets as $ticket){
            $v = new Verta($ticket->created_at);
            $t = $v->formatDifference();
            $ticket->when = $t;
            $ticket->created_at = new Verta($ticket->created_at);
        }
        Return $tickets;
    }
    public function addAnswer(Request $request){
        $ticket = Ticket::create($request->all());
        $ticketReply = Ticket::find($ticket->reply_to);
        if ($ticketReply->user_id===$ticket->user_id){
            //پاسخ مشتری
            $ticketReply->status = 5;
        }else{
            //پاسخ داده شد
            $ticketReply->status = 3;
        }

        $ticketReply->update();


//        Log::create([
//            'code' => 181,
//            'log' => 'ثبت وظیفه '.$task->task.' توسط '. Auth::user()->name,
//            'project_id' => $request->project_id,
//            'user_id' => Auth::id()
//        ]);

        return $this->getAnswersOfTheTicket($ticket->reply_to);

    }
}
