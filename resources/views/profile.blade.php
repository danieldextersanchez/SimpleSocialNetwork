<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layouts.app')

@section('content')



<div class='center' >
<form >
<img src="storage/profile_pictures/default.png"  alt="">
<h2 >{{$userinfo[0]->firstname}}  </h2>

</form>
</div>


@endsection




