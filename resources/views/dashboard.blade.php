<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form :action="route('question.store')">
                <x-textarea label="Question" name="question" />
                <x-buttons.primary>Save</x-buttons.primary>
                <x-buttons.reset>Reset</x-buttons.cancel>
            </x-form>

            <hr class="border-gray-700 border-dashed my-4">

            <div class="dark:text-gray-400 font-bold mb-1">List of Questions</div>
            <div class="dark:text-gray-400 space-y-4">
                @foreach ($questions as $item)
                    <x-question :question="$item" />
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>