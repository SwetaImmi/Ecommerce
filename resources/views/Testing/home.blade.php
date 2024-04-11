<form action="test_submit" method="post">
@if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @csrf
    <input type="text"  name="name" value="">
    <input type="text"  name="email" value="skdas@yopmail.com">
    <input type="text"  name="password" value="123">
    <input type="text"  name="role" value="User">
    <input type="text"  name="mobile" value="1234567890">
    <input type="text"  name="remember_token" value="32333333">

<button type="submit">Submit</button>

</form>