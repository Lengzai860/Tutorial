<?php

namespace App\Http\Controllers;

use App\Events\NewVoucher;
use App\Http\Requests\VoucherStoreRequest;
use App\Jobs\SyncMedia;
use App\Notification\ReviewNotification;
use App\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class VoucherController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vouchers = Voucher::all();

        return view('voucher.index', compact('vouchers'));
    }

    /**
     * @param \App\Http\Requests\VoucherStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherStoreRequest $request)
    {
        $voucher = Voucher::create($request->validated());

        Notification::send($voucher->author, new ReviewNotification($voucher));

        SyncMedia::dispatch($voucher);

        event(new NewVoucher($voucher));

        $request->session()->flash('voucher.title', $voucher->title);

        return redirect()->route('voucher.index');
    }
}
