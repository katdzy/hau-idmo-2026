@if($dept->count() == 0)
    <div class="w-full flex items-center justify-center text-sm text-gray-400 pt-4 pb-12">
        <span class="italic"> No records. </span>
    </div>
@else
    <div class="flex flex-col items-start">
        @foreach($dept as $item)
            <div class="w-full bg-gray text-gray-500 grid grid-cols-[10%_10%_55%_25%] p-2 border bt-gray-100">
                @if($item->logo != '')
                    <img src="{{ asset('storage/dept/logo/' . $item->logo) }}" class="w-[50px] h-[50px]"/>
                @else
                    <img src="{{ asset('images/logo-circle.png') }}" class="w-[50px] h-[50px]"/>
                @endif
                <div class="flex items-center">
                    <h1>{{ $item->code }}</h1>
                </div>
                <div class="flex items-center">
                    <h1>{{ $item->dept }}</h1>
                </div>
                <div class="flex items-center justify-end">
                    <form class="flex items-center" action="{{ route('admin.dept.view', ['id'=> $item->id]) }}">
                        <button class="w-[95%] bg-green-700 hover:bg-green-800 px-4 py-1 text-white rounded-lg" title="Edit">
                            <img src="{{ asset('images/icons/edit.png') }}" alt="" class="w-[20px] h-[20px]">
                        </button>
                    </form>
                    <form class="flex items-center" action="{{ route('admin.dept.delete', ['id'=> $item->id]) }}" method="POST">
                        @csrf 
                        @method('DELETE')
                        <button onclick="confirmDelete(this)" type="button" class="w-[95%] bg-red-700 px-4 py-1 text-white rounded-lg" title="Delete">
                            <img src="{{ asset('images/icons/delete.png') }}" alt="" class="w-[20px] h-[20px]">
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <div class="w-full p-4">
        {{ $dept->links() }}
    </div>
@endif
