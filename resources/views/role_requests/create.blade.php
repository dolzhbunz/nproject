@extends("layouts.app")

@section("content")
    <div class="px-4 py-5 sm:p-6">
        @if($hasPending)
            <div>
                <p>У вас уже есть заявка на смену роли</p>
                <a href="{{route('dashboard')}}" class=" ">
                    Вернуться на dashboard
                </a>
            </div>
        @else
            <h3 class="">Запрос на повышение прав</h3>
            <form action="{{route('role_requests.store')}}" method="POST" class="">
                @csrf
                <div class="mb-4">
                    <label for="requested_role" class="font-medium text-red-700">Роль</label>
                    <select name="requested_role" id="requested_role" class="border-black-300">
                        <option value="author">Author (creating new Posts)</option>
                        <option value="editor">Editor (edit all posts)</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="requested_role" class="text-sm text-black-700">Обоснование запроса:
                        <textarea name="reason" id="reason" rows="4" class="mt-1 w-full border-pink-200">Почему ты достойный кандидат для получения этих прав?</textarea>
                    </label>
                </div>

                <button type="submit" class="inline-flex py-2 px-4 border text-white bg-green-900">
                    Отправить запрос!
                </button>
            </form>
        @endif
    </div>
@endsection

