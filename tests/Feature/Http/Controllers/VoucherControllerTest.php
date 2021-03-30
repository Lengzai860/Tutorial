<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewVoucher;
use App\Jobs\SyncMedia;
use App\Notification\ReviewNotification;
use App\Voucher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VoucherController
 */
class VoucherControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $vouchers = Voucher::factory()->count(3)->create();

        $response = $this->get(route('voucher.index'));

        $response->assertOk();
        $response->assertViewIs('voucher.index');
        $response->assertViewHas('vouchers');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VoucherController::class,
            'store',
            \App\Http\Requests\VoucherStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $order_id = $this->faker->word;

        Notification::fake();
        Queue::fake();
        Event::fake();

        $response = $this->post(route('voucher.store'), [
            'order_id' => $order_id,
        ]);

        $vouchers = Voucher::query()
            ->where('order_id', $order_id)
            ->get();
        $this->assertCount(1, $vouchers);
        $voucher = $vouchers->first();

        $response->assertRedirect(route('voucher.index'));
        $response->assertSessionHas('voucher.title', $voucher->title);

        Notification::assertSentTo($voucher->author, ReviewNotification::class, function ($notification) use ($voucher) {
            return $notification->voucher->is($voucher);
        });
        Queue::assertPushed(SyncMedia::class, function ($job) use ($voucher) {
            return $job->voucher->is($voucher);
        });
        Event::assertDispatched(NewVoucher::class, function ($event) use ($voucher) {
            return $event->voucher->is($voucher);
        });
    }
}
