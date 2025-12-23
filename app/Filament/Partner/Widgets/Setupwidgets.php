<?php

namespace App\Filament\Partner\Widgets;

use Filament\Widgets\Widget;
use App\Models\UserManagement\Partner; // আপনার পার্টনার মডেলটি ইমপোর্ট করুন
use Illuminate\Support\Facades\Auth;

class Setupwidgets extends Widget
{
    protected string $view = 'filament.partner.widgets.setupwidgets';

    protected int | string | array $columnSpan = 'full';

    public function getCards(): array
    {
        $user = Auth::user();

        // চেক করছি পার্টনার টেবিলে এই ইউজার আইডির কোনো এন্ট্রি আছে কি না
        $isPartnerSetupDone = Partner::where('user_id', $user->id)->exists();

        $cards = [];

        // যদি পার্টনার সেটআপ না করা থাকে (ডাটাবেসে নেই), তবে শুধু প্রথম কার্ডটি দেখাবে
        if (!$isPartnerSetupDone) {
            $cards[] = [
                'title' => 'Business Profile Setup',
                'desc' => 'আপনার দোকানের ডিটেইলস এবং লোগো আপডেট করুন। এটি না করলে আপনি সার্ভিস শুরু করতে পারবেন না।',
                'icon' => 'heroicon-o-user-circle',
                'button_text' => 'Profile Update',
                'link' => '/partner/business', // নিশ্চিত করুন এই লিঙ্কটি সঠিক
            ];
        } else {
            // যদি সেটআপ করা থাকে, তবে বাকি কার্ডগুলো দেখাবে
            $cards = [
                [
                    'title' => 'Payment Method',
                    'desc' => 'ব্যাংক অ্যাকাউন্ট বা মোবাইল ব্যাংকিং সেটআপ করুন।',
                    'icon' => 'heroicon-o-credit-card',
                    'button_text' => 'Setup Bank',
                    'link' => '/partner/settings/bank',
                ],
                [
                    'title' => 'Add Products',
                    'desc' => 'আপনার প্রথম প্রোডাক্টটি আজকেই লিস্ট করুন।',
                    'icon' => 'heroicon-o-plus-circle',
                    'button_text' => 'Add Now',
                    'link' => '/partner/products/create',
                ],
            ];
        }

        return $cards;
    }
}
