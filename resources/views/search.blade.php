<form method="GET" action="{{ route('search.result') }}">
	  @csrf
	  <h2 class="text-white text-center text-4xl pb-5">Get users by ID</h2>
	
	  @if(session('error'))
	  <div class="bg-red-500 text-white text-center text-xl m-4 p-4">{{ session('error') }}</div>
	  @endif
	
	  <input type="text" name="user_id" placeholder="Enter User ID" class="py-3 px-4 text-xl" value="{{ old('user_id') }}">
	  <input type="submit" value="Submit" class="bg-yellow-500 py-3 px-4 text-white text-xl cursor-pointer">
</form>