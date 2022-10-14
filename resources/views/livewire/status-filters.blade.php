<nav class="hidden md:flex items-center justify-between text-gray-400 text-xs">
    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li>
            <a wire:click.prevent="setCurrentStatus('All')" href="{{ route('idea.index', ['status' => 'All']) }}" class="border-b-4 pb-3 hover:border-blue @if ($currentStatus === 'All') border-blue text-gray-900
         @endif">All Ideas ({{ $statusCount->get("All") }})</a>
        </li>
        @foreach(\App\Models\Status::all()->sortBy('sort_order') as $status)
            @if($status->name !== 'Implemented' && $status->name !== 'Closed')
                <li>
                    <a wire:click.prevent="setCurrentStatus('{{ $status->name }}')" href="{{ route('idea.index', ['status' => $status->name]) }}" class=" transition duration-150 ease-in border-b-4 pb-3
        hover:border-blue @if($currentStatus === $status->name) border-blue text-gray-900 @endif">{{ $status->name }} ({{ $statusCount[strtolower($status->name)] }})</a>
                </li>
            @endif
        @endforeach
    </ul>
    @foreach(\App\Models\Status::all()->sortBy('sort_order') as $status)
        @if($status->name === 'Implemented' || $status->name === 'Closed' || $status->name === 'Done')
            <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                <li>
                    <a wire:click.prevent="setCurrentStatus('{{ $status->name }}')" href="{{ route('idea.index', ['status' => $status->name]) }}"
                       class=" transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($currentStatus === $status->name) border-blue text-gray-900 @endif">{{ $status->name }}
                        ({{ $statusCount[strtolower($status->name)] }})</a>
                </li>
            </ul>
        @endif
    @endforeach
</nav>
