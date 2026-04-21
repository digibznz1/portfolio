<?php

namespace App\Livewire\Dashboard\Organization\InitialEvaluation;

use App\Models\InitialEvaluation;
use Livewire\Component;

class Questions extends Component
{
    public $questions = [];
    public $answers = [];
    public $currentStep = 1;

    public function mount()
    {
        //$this->questions = InitialEvaluation::where('organization_type_id', auth('organization')->user()->organization_type_id)->pluck('question', 'id');
        $this->questions = InitialEvaluation::pluck('question', 'id');
    }

    public function next()
    {
        $this->validate([
            "answers.{$this->currentStep}" => 'required|in:yes,no'
        ]);

        $this->currentStep++;
    }

    public function prev()
    {
        $this->currentStep--;
    }

    public function submit()
    {
        $this->validate([
            'answers.*' => 'required|in:yes,no'
        ]);

        // خزّن البيانات هنا
        // dd($this->answers);

        session()->flash('success', 'تم الإرسال بنجاح');
    }

    public function render()
    {
        return view('livewire.dashboard.organization.initial-evaluation.questions');
    }
}
