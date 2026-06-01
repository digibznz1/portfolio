<?php

namespace App\Livewire\Site;

use Livewire\Component;
use App\Models\Contact;
use App\Enums\ContactTypeEnum;

class ContactForm extends Component
{
    public string $tab = 'rfq';

    // RFQ fields
    public string $rfq_name         = '';
    public string $rfq_email        = '';
    public string $rfq_company_name = '';
    public string $rfq_activity_type= '';
    public int    $rfq_budget_range = 70;
    public string $rfq_project_scope= '';
    public bool   $rfq_agreed       = false;

    // Quick fields
    public string $quick_name    = '';
    public string $quick_email   = '';
    public string $quick_phone   = '';
    public string $quick_message = '';

    public string $successMessage = '';
    public string $errorMessage   = '';

    public function getBudgetLabel(): string
    {
        $v = $this->rfq_budget_range;
        if ($v < 20) return '< 50k SAR';
        if ($v < 40) return '50k - 100k SAR';
        if ($v < 60) return '100k - 150k SAR';
        if ($v < 80) return '150k - 200k SAR';
        return '200k+ SAR';
    }

    public function submitRfq(): void
    {
        $this->resetMessages();

        $this->validate([
            'rfq_name'          => ['required', 'string', 'max:255'],
            'rfq_email'         => ['required', 'email', 'max:255'],
            'rfq_company_name'  => ['nullable', 'string', 'max:255'],
            'rfq_activity_type' => ['nullable', 'string', 'max:255'],
            'rfq_budget_range'  => ['nullable', 'integer', 'min:0', 'max:100'],
            'rfq_project_scope' => ['required', 'string'],
            'rfq_agreed'        => ['accepted'],
        ]);

        Contact::create([
            'type'          => ContactTypeEnum::RFQ,
            'name'          => $this->rfq_name,
            'email'         => $this->rfq_email,
            'company_name'  => $this->rfq_company_name,
            'activity_type' => $this->rfq_activity_type,
            'budget_range'  => $this->rfq_budget_range,
            'project_scope' => $this->rfq_project_scope,
        ]);

        $this->reset(['rfq_name', 'rfq_email', 'rfq_company_name', 'rfq_activity_type', 'rfq_project_scope', 'rfq_agreed']);
        $this->rfq_budget_range = 70;
        $this->successMessage   = __('site.contact.success');
    }

    public function submitQuick(): void
    {
        $this->resetMessages();

        $this->validate([
            'quick_name'    => ['required', 'string', 'max:255'],
            'quick_email'   => ['required', 'email', 'max:255'],
            'quick_phone'   => ['nullable', 'string', 'max:30'],
            'quick_message' => ['required', 'string'],
        ]);

        Contact::create([
            'type'    => ContactTypeEnum::QUICK,
            'name'    => $this->quick_name,
            'email'   => $this->quick_email,
            'phone'   => $this->quick_phone,
            'message' => $this->quick_message,
        ]);

        $this->reset(['quick_name', 'quick_email', 'quick_phone', 'quick_message']);
        $this->successMessage = __('site.contact.success');
    }

    private function resetMessages(): void
    {
        $this->successMessage = '';
        $this->errorMessage   = '';
    }

    public function render()
    {
        return view('livewire.site.contact-form');
    }
}
