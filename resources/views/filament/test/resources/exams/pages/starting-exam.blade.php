<x-filament-panels::page>
    @foreach ($collections as $pelajaran)
        <div wire:key="pelajaran-{{ $loop->index }}" style="margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.15rem; font-weight: 700; margin-bottom: 0.75rem;">
                {{ $pelajaran['name'] }}
            </h2>

            @foreach ($pelajaran['soals'] as $pertanyaan)
                <div
                    wire:key="soal-{{ $pertanyaan['id'] }}"
                    style="margin-bottom: 1.25rem; padding: 1rem; border-radius: 0.75rem; border: 1px solid rgba(128,128,128,0.25);"
                >
                    {{-- Nomor + soal --}}
                    <div style="display: flex; gap: 0.5rem; margin-bottom: 0.75rem; font-weight: 700;">
                        <span>{{ $loop->iteration }}.</span>
                        <div>{!! $pertanyaan['payload'] !!}</div>
                    </div>

                    {{-- Pilihan A, B, C, D --}}
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        @foreach ($pertanyaan['answers'] as $jawaban)
                            @php
                                $selected = (string) ($answers[$pertanyaan['id']] ?? '') === (string) $jawaban['id'];
                            @endphp

                            <button
                                type="button"
                                wire:key="jawaban-{{ $jawaban['id'] }}"
                                wire:click="$set('answers.{{ $pertanyaan['id'] }}', {{ $jawaban['id'] }})"
                                style="
                                    display: flex; align-items: center; gap: 0.75rem;
                                    width: 100%; text-align: left; cursor: pointer;
                                    padding: 0.6rem 0.9rem; border-radius: 0.6rem;
                                    border: 2px solid {{ $selected ? '#4f46e5' : 'rgba(128,128,128,0.35)' }};
                                    background: {{ $selected ? 'rgba(79,70,229,0.12)' : 'transparent' }};
                                "
                            >
                                <span style="
                                    flex-shrink: 0; width: 2rem; height: 2rem;
                                    display: inline-flex; align-items: center; justify-content: center;
                                    border-radius: 9999px; font-weight: 700;
                                    background: {{ $selected ? '#4f46e5' : 'rgba(128,128,128,0.2)' }};
                                    color: {{ $selected ? '#fff' : 'inherit' }};
                                ">
                                    {{ chr(65 + $loop->index) }}
                                </span>
                                <span>{{ $jawaban['text'] }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    <div class="mt-6">
        <x-filament::button
            color="success"
            size="lg"
            wire:click="submit"
            wire:confirm="Kirim jawaban sekarang? Jawaban tidak bisa diubah setelah dikirim."
            wire:loading.attr="disabled"
        >
            Kirim Jawaban
        </x-filament::button>
    </div>
</x-filament-panels::page>