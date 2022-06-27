<form action="{{route('contact')}}" method="post">
    @csrf
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" class="form-control" name="phone" id="phone">
    </div>
    <div class="form-group">
      <label for="message">Message:</label>
      <textarea class="form-control" name="message" id="message"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
