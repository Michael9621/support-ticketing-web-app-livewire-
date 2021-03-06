<div>
    {{-- Do your work, then step back. --}}
    <div class="flex justify-center">
       
        <div class="w-6/12">
            <h1 class="my-10 text-3x1">comments</h1>

            @error('newComment')<span class="text-red-500 text-xs">{{ $message }}
            </span>@enderror

            @if(session()->has('message'))
                <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
                    {{ session('message') }}
                </div>
            @endif

            <section>
               
                @if($image)
                    <img src={{$image}} width="200" />
                    <br>
                @endif

                <input type="file" id="image" wire:change="$emit('fileChoosen')">
            </section>

            <form class="my-4 flex" wire:submit.prevent>
                <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="what is in your mind" wire:model.debounce.500ms="newComment">
                <div class="py-2">
                    <button class="p-2 bg-blue-500 w-20 rounded shadow text-white" wire:click="addComment">Add</button>
                </div>
            </form>

            @foreach($comments as $comment)
            <div class="rouded border shadow p-3 my-2">
                <div class="flex justify-between  my-2">
                    <div class="flex justify-start my-2">
                        <p class="font-bold text-lg">{{$comment->creator->name}}</p>
                        <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">{{$comment->created_at->diffForHumans()}}</p>
                    </div>

                    <i class="fa fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$comment->id}})" ></i>
                
                </div>
                @if($comment->image)
                    <img src="{{$comment->imagePath}}" >
                @endif
                <p class="text-gray-800">{{$comment->body}}</p>
            </div>
            @endforeach

            {{ $comments->links('pagination-links') }}
        </div>
    
    </div>

    <script>
        window.livewire.on('fileChoosen', () => {
            //alert('asdfasd')
            let inputField = document.getElementById('image')
            let file = inputField.files[0]

            console.log(file)
            let reader = new FileReader()

            reader.onloadend = () => {
                window.livewire.emit('fileUpload', reader.result)
            }

            reader.readAsDataURL(file)
        })
    </script>

</div>

