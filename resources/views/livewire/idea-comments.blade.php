<div>
    @if ($comments->isNotEmpty())

        <div class="comments-container relative space-y-6 md:ml-22 pt-4 my-8 mt-1">

            @foreach ($comments as $comment)
                <livewire:idea-comment
                        :key="$comment->id"
                        :comment="$comment"
                        :ideaUserId="$idea->user->id"
                />
            @endforeach
        </div>

        <div class="my-8 md:ml-22">
            {{ $comments->onEachSide(1)->links() }}
        </div>
    @else
        <div class="mx-auto w-70 mt-12 text-center">
            <div class="flex space-x-2 justify-center text-center">
                <i class="text-gray-400 fa-regular fa-thought-bubble mix-blend-luminosity text-2xl" alt="No Ideas"></i>
                <p class="text-gray-400 text-center font-bold">No comments yet...</p>
            </div>
        </div>
    @endif
</div>
