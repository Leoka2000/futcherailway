@extends('layouts.app')

@section('content')
<x-steps wire:model="step" class="border my-5 p-5">
    <x-step step="1" text="Register">
        Register step
    </x-step>
    <x-step step="2" text="Payment">
        Payment step
    </x-step>
    <x-step step="3" text="Receive Product" class="bg-orange-500/20">
        Receive Product {{$produt->name}}
    </x-step>
</x-steps>

<x-button label="Previous" wire:click="prev" />
<x-button label="Next" wire:click="next" />
@endsection