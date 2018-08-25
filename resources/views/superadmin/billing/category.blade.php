<form role="form" enctype="multipart/form-data" method="post" action="{{ route('bill_cat')}}">
    {{ csrf_field() }}


    <div class="form-group">
    <label for="exampleInputEmail1">Categories</label>
    <input type="text" name="category" class="form-control" id="exampleInputEmail1" placeholder="Full Name" required>
</div>

    <div class="row" style="padding: 5px 0px 15px 0px; float:right; font-size: 12px; text-align: center;">
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
    </div>
</form>
