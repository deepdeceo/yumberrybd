<?php

namespace App\Filament\Partner\Pages;

use App\Models\Business\Cities;
use App\Models\Business\Zones;
use App\Models\UserManagement\Partner;
use App\Models\Wallet\PartnerPaymentMethod;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Form;
use Filament\Support\Icons\Heroicon;
use Livewire\WithFileUploads;
use UnitEnum;

class SetupBank extends Page
{

    use WithFileUploads; // Use this

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Banknotes;

    protected  string $view = 'filament.partner.pages.setup-bank';

    protected static string|UnitEnum|null $navigationGroup = 'Business Setup';
    protected static ?int $navigationSort = 2;



  public $payment_method = '';
 // Form Properties
    public $time_type = '';
    public $bank_name = '';
    public $account_holder = '';
    public $account_number = '';
    public $branch_name = '';
    public $bkash_number = '';

    public function mount(): void
    {
        $partner = Partner::where('user_id', Auth::id())->first();

        if ($partner) {
            $paymentInfo = PartnerPaymentMethod::where('partner_id', $partner->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($paymentInfo) {
                $this->time_type = $paymentInfo->time_type ?? '';
                $this->payment_method = $paymentInfo->payment_method ?? '';

                // pay_details অ্যারে থেকে ডাটা প্রপার্টিতে লোড করা
                $details = $paymentInfo->pay_details ?? [];
                $this->bank_name = $details['bank_name'] ?? '';
                $this->account_holder = $details['account_holder'] ?? '';
                $this->account_number = $details['account_number'] ?? '';
                $this->branch_name = $details['branch_name'] ?? '';
                $this->bkash_number = $details['bkash_number'] ?? '';
            }
        }
    }

    public function save(): void
    {
        // ১. ভ্যালিডেশন
        $rules = [
            'time_type' => 'required|in:weekly,day,cash_on_delivery',
        ];

        if ($this->time_type !== 'cash_on_delivery') {
            $rules['payment_method'] = 'required|in:bkash,bank';

            if ($this->payment_method === 'bank') {
                $rules += [
                    'bank_name' => 'required|string',
                    'account_holder' => 'required|string',
                    'account_number' => 'required|string',
                    'branch_name' => 'required|string',
                ];
            } elseif ($this->payment_method === 'bkash') {
                $rules['bkash_number'] = 'required|digits:11';
            }
        }

        $this->validate($rules);

        $partner = Partner::where('user_id', Auth::id())->first();

        if (!$partner) {
            Notification::make()->title('Error')->body('বিজনেস প্রোফাইল খুঁজে পাওয়া যায়নি।')->danger()->send();
            return;
        }

        // ২. pay_details অ্যারে তৈরি করা
        $payDetails = [];
        if ($this->time_type !== 'cash_on_delivery') {
            if ($this->payment_method === 'bank') {
                $payDetails = [
                    'bank_name'      => $this->bank_name,
                    'account_holder' => $this->account_holder,
                    'account_number' => $this->account_number,
                    'branch_name'    => $this->branch_name,
                ];
            } else {
                $payDetails = [
                    'bkash_number' => $this->bkash_number,
                ];
            }
        }

        // ৩. ডাটাবেসে সেভ করা (আপনার মডেলের কলাম অনুযায়ী)
        PartnerPaymentMethod::updateOrCreate(
            ['user_id' => Auth::id(), 'partner_id' => $partner->id],
            [
                'time_type'      => $this->time_type,
                // COD হলে 'bank' বা null সেভ করছি যাতে ENUM এরর না আসে
                'payment_method' => $this->time_type === 'cash_on_delivery' ? 'bank' : $this->payment_method,
                'pay_details'    => $payDetails, // Model Casts এর কারণে এটি JSON হয়ে যাবে
            ]
        );

        Notification::make()->title('Saved Successfully')->success()->send();
        $this->redirect('/partner');
    }
}
