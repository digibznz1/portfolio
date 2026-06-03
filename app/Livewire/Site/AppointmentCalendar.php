<?php

namespace App\Livewire\Site;

use Livewire\Component;
use App\Models\Appointment;
use App\Enums\AppointmentStatusEnum;
use Carbon\Carbon;

class AppointmentCalendar extends Component
{
    public int    $year;
    public int    $month;
    public string $selectedDate = '';
    public string $selectedSlot = '';

    public string $name  = '';
    public string $email = '';
    public string $phone = '';

    public string $successMessage = '';
    public string $errorMessage   = '';

    public function mount(): void
    {
        $this->year  = now()->year;
        $this->month = now()->month;
    }

    public function prevMonth(): void
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->subMonth();
        $this->year  = $date->year;
        $this->month = $date->month;
        $this->selectedDate = '';
        $this->selectedSlot = '';
    }

    public function nextMonth(): void
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->addMonth();
        $this->year  = $date->year;
        $this->month = $date->month;
        $this->selectedDate = '';
        $this->selectedSlot = '';
    }

    public function selectDate(string $date): void
    {
        $this->selectedDate = $date;
        $this->selectedSlot = '';
    }

    public function selectSlot(string $slot): void
    {
        $this->selectedSlot = $slot;
    }

    public function getCalendarDaysProperty(): array
    {
        $first   = Carbon::createFromDate($this->year, $this->month, 1);
        $daysInMonth = $first->daysInMonth;
        $startDay    = $first->dayOfWeek; // 0 = Sunday
        $today       = Carbon::today();
        $days        = [];

        // Padding from previous month
        for ($i = 0; $i < $startDay; $i++) {
            $days[] = ['label' => '', 'date' => null, 'current' => false, 'past' => true, 'selected' => false];
        }

        for ($d = 1; $d <= $daysInMonth; $d++) {
            $date     = Carbon::createFromDate($this->year, $this->month, $d);
            $dateStr  = $date->toDateString();
            $days[]   = [
                'label'    => $d,
                'date'     => $dateStr,
                'current'  => true,
                'past'     => $date->lt($today),
                'selected' => $this->selectedDate === $dateStr,
            ];
        }

        return $days;
    }

    private function getTimeSlots(): array
    {
        $default = ['09:00 AM', '10:30 AM', '01:15 PM', '03:45 PM'];
        $raw     = setting('contact')->toArray();
        $slots   = $raw['time_slots'] ?? $default;

        return array_values(array_filter(
            is_array($slots) ? $slots : $default,
            fn($s) => is_string($s)
        ));
    }

    public function getAvailableSlotsProperty(): array
    {
        if (!$this->selectedDate) {
            return $this->getTimeSlots();
        }

        $allSlots = $this->getTimeSlots();

        $booked = Appointment::where('date', $this->selectedDate)
                             ->where('status', '!=', AppointmentStatusEnum::CANCELLED->value)
                             ->pluck('time_slot')
                             ->toArray();

        return array_values(array_filter(
            is_array($allSlots) ? $allSlots : [],
            fn($slot) => !in_array($slot, $booked)
        ));
    }

    public function submit(): void
    {
        $this->successMessage = '';
        $this->errorMessage   = '';

        $this->validate([
            'selectedDate' => ['required', 'date', 'after_or_equal:today'],
            'selectedSlot' => ['required', 'string'],
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:30'],
        ]);

        $taken = Appointment::where('date', $this->selectedDate)
                            ->where('time_slot', $this->selectedSlot)
                            ->where('status', '!=', AppointmentStatusEnum::CANCELLED->value)
                            ->exists();

        if ($taken) {
            $this->errorMessage = __('site.contact.slot_taken');
            return;
        }

        Appointment::create([
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'date'      => $this->selectedDate,
            'time_slot' => $this->selectedSlot,
        ]);

        $this->reset(['selectedDate', 'selectedSlot', 'name', 'email', 'phone']);
        $this->successMessage = __('site.contact.appointment_success');
    }

    public function render()
    {
        return view('livewire.site.appointment-calendar', [
            'calendarDays'   => $this->calendarDays,
            'availableSlots' => $this->availableSlots,
            'monthLabel'     => Carbon::createFromDate($this->year, $this->month, 1)
                                      ->locale(app()->getLocale())
                                      ->isoFormat('MMMM YYYY'),
        ]);
    }
}
