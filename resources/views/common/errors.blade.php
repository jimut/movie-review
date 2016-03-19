@if (count($errors) > 0)
  <h2>{{ count($errors) }} errors found</h2>
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
@endif
