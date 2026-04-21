<div>

    <div class="kt-card kt-card-grid min-w-full p-5 my-5">

        <h2 class="text-xl font-bold mb-5 text-center">
            السؤال {{ $currentStep }} من {{ count($questions) }}
        </h2>

        @foreach ($questions as $id => $question)
            @if ($currentStep == $id)
                <div class="text-center">

                    <h1 class="font-size text-lg font-semibold mb-6">{{ $question }}</h1>

                    <div class="d-flex justify-content-center gap-5">

                        <!-- YES -->
                        <label class="btn btn-outline-success w-100px">
                            <input 
                                type="radio"
                                class="btn-check"
                                name="question_{{ $id }}"
                                wire:model="answers.{{ $id }}"
                                value="yes"
                            >
                            نعم
                        </label>

                        <!-- NO -->
                        <label class="btn btn-outline-danger w-100px">
                            <input 
                            type="radio"
                            class="btn-check"
                            name="question_{{ $id }}"
                            wire:model="answers.{{ $id }}"
                            value="no"
                            >
                            لا
                        </label>

                    </div>

                </div>
            @endif
        @endforeach

        <!-- Buttons -->
        <div class="flex flex-wrap gap-4">

            @if ($currentStep < count($questions))
                <button wire:click="next" class="kt-btn kt-btn-mono">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-big-right-dash-icon lucide-arrow-big-right-dash"><path d="M11 9a1 1 0 0 0 1-1V4.707a.707.707 0 0 1 1.207-.5l6.94 6.94a1.207 1.207 0 0 1 0 1.707l-6.94 6.94a.707.707 0 0 1-1.207-.5V16a1 1 0 0 0-1-1H9a1 1 0 0 1-1-1v-4a1 1 0 0 1 1-1z" data--h-bstatus="0OBSERVED"/><path d="M4 9v6" data--h-bstatus="0OBSERVED"/></svg>
                    التالي
                </button>
            @else
                <button wire:click="submit" class="kt-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bookmark-icon lucide-bookmark"><path d="M17 3a2 2 0 0 1 2 2v15a1 1 0 0 1-1.496.868l-4.512-2.578a2 2 0 0 0-1.984 0l-4.512 2.578A1 1 0 0 1 5 20V5a2 2 0 0 1 2-2z" data--h-bstatus="0OBSERVED"/></svg>
                    إرسال
                </button>
            @endif

             @if ($currentStep > 1)
                <button wire:click="prev" class="kt-btn kt-btn-outline">
                    السابق
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-big-left-dash-icon lucide-arrow-big-left-dash"><path d="M13 9a1 1 0 0 1-1-1V4.707a.707.707 0 0 0-1.207-.5l-6.94 6.94a1.207 1.207 0 0 0 0 1.707l6.94 6.94a.707.707 0 0 0 1.207-.5V16a1 1 0 0 1 1-1h2a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1z" data--h-bstatus="0OBSERVED"/><path d="M20 9v6" data--h-bstatus="0OBSERVED"/></svg>
                </button>
            @endif

        </div>

        @if (session()->has('success'))
            <div class="alert alert-success mt-4 text-center">
                {{ session('success') }}
            </div>
        @endif

    </div>

</div>
