@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="p-3">
  <div class="three mb-3 d-flex justify-content-between align-items-center">
    <h1 class="d-inline-block w-25 ">الرسائل</h1>

    <form class="d-f justify-content-center align-items-center" id="search-form" action="{{route('contactus.search')}}" method="get">
      <label>الاسم</label>
      <input class="mySearch w-25" type="text" name="name" id="search-input">
      <label>الايميل</label>
      <input class="mySearch w-25" type="text" name="email" id="search-input">
      <button class="btn btn-outline-secondary py-1" style="border-radius: 12px"  type="submit"><b>بحث</b></button>
    </form>

    
    <a type="button" class="btn btn-secondary py-2" href="{{ route('contactus.archive') }}">الارشيف</a>
  </div>
  @if ($all_messages->count() > 0)
    <table class="table" id="table">
        <thead style="border-bottom: #2f80ed 3px solid">
          <tr style="color: #2f80ed">
            <th scope="col" style="width: 7rem;">#</th>
            <th scope="col">الاسم</th>
            <th scope="col">الايميل</th>
            <th scope="col">تاريخ الارسال</th>
            <th scope="col">الخيارات</th>
          </tr>
        </thead>
        <tbody id="tbody">
          @php
              $counter =1;
          @endphp
          @foreach ($all_messages as $message)
          <tr class="search2 " style="border-bottom: 1px double #5d657b">
            <th scope="row" style="color: #2f80ed">{{$counter++}}</th>
            <td style="width: 15%;max-width: 30px;word-wrap: break-word;padding-left: 40px;"><p class=" title" style=" overflow-wrap: break-word">{{$message->name}}</p></td>
            <td style="max-width: 80px;word-wrap: break-word;padding-left: 40px;"><p class=" title" style=" overflow-wrap: break-word">{{$message->email}}</p></td>
            <td ><p class=" title" style=" overflow-wrap: break-word;max-width: 85px;">{{$message->created_at}}</p></td>
            <td style="width: 25%;">
              <a class="btn btn-secondary ms-1 py-1" href="{{ route('contactus.show', $message->id) }}">عرض</a> 
              <a class="btn btn-danger ms-1 py-1" href="{{ route('contactus.soft_delete', $message->id) }}">حذف</a>  
            </td>
            @if ($message->read == 0)
              <td><i class="fa-solid fa-circle" style="color: #0d6efd;"></i></td>  
            @endif
          </tr>
              
          @endforeach
        </tbody>
    </table>  
    <div class="pagination justify-content-center">
      {{$all_messages->links()}}
    </div>
    @else
    <div class="alert alert-danger fw-bold" role="alert">لا يوجد رسائل</div>
    @endif
    
  </div>
  
</div>
@endsection

{{-- <script>
  function contactus_search() {
  const inputValue = document.getElementById('myInput').value;
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      console.log(this.responseText);
    }
  };
  xhr.open('POST', '{{ route('contactus.search') }}');
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  xhr.send(JSON.stringify({ input: inputValue }));
}
  function contactus_seah() {
    // var csrfToken = getCSRFToken();
  const inputValue = document.getElementById('myInput').value;
  console.log(typeof(inputValue));

  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      console.log(this.responseText);
    }
  };
  
  xhr.open('POST', '/contactus_search');
  // xhr.setRequestHeader("X-CSRFToken", csrfToken);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.send(JSON.stringify({ input: inputValue }));
}


</script> --}}