<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Book</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
body {
    background-image: url(https://i.pinimg.com/1200x/9b/5e/53/9b5e53eeac857a80f499dff6b881f713.jpg);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}
</style>

<body>
<div class="container mt-4 p-3 w-100">
    <!-- Button trigger modal -->
    <button id="add" type="button" class="btn btn-dark float-end mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
        + Add New Book
    </button> 
    <h1 class="text-link-light fw-bold">Welcome To LibraryBook</h1>
    <table class="table text-center table-hover mt-4 rounded-3 shadow">
        <thead class="table-warning">
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Publish Year</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($librarybooks as $d)
            <tr class="align-middle">
                <td>{{$d['id']}}</td>
                <td><img width="50" height="50" class="rounded-circle object-fit-cover" src="{{$d['image']}}"></td>
                <td>{{$d['title']}}</td>
                <td>{{$d['author']}}</td>
                <td>{{$d['category']}}</td>
                <td>${{$d['price']}}</td>
                <td>{{$d['quantity']}}</td>
                <td>{{$d['publish_year']}}</td>
                <td>{{$d['created_at']}}</td>
                <td>{{$d['updated_at']}}</td>
                <td>
                    <button class="btn btn-warning edit" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                    <a href="/delete/{{$d['id']}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
         <form action="{{url('insert')}}" id="form" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Title</label>
                <input id="title"  name="title" type="text" class="form-control" placeholder="Title...">
            </div>
            <div class="mb-3">
                <label for="author" class="fw-bold form-label" >Author</label> 
                <input  type="text" name="author" id="author" class="form-control" placeholder="Author...">
            </div>
            <div class="mb-3">
                <label for="category" class="fw-bold form-label">Category</label>
                <input name="category" id="category" class="form-control" placeholder="Category...">
            </div>
            <div class="mb-3">
                <label for="price" class="fw-bold form-label" >Price</label> 
                <input type="number" name="price" id="price" step="0.1" class="form-control" placeholder="Price...">
            </div>
            <div class="mb-3">
                <label for="quantity" class="fw-bold form-label" >Quantity</label> 
                <input name="quantity" id="quantity" class="form-control" placeholder="Quantity...">
            </div>
            <div class="mb-3">
                <label for="publish_year" class="fw-bold form-label" >Publish Year</label> 
                <input name="publish_year" id="publish_year" class="form-control" placeholder="Publish Year...">
            </div>
            <div class="mb-3">
                <label for="file" class="fw-bold form-label" >Image</label> <br>
                <img id="image" width="170px" height="170px" class="rounded-circle object-fit-cover" 
                     src="https://i.pinimg.com/736x/a4/01/d7/a401d7e68482fec650a277be810807e5.jpg" alt="">
                <input type="file" name="image" id="file" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="save" name="submit" class="btn btn-primary">Save</button>
                <button type="submit" id="update" name="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

    $('#add').click(function(){
        $('#save').show()
        $('#update').hide()
        $('#exampleModalLabel').text('Add New Book')
        $('#form').attr('action', '{{ url("insert") }}')
        $('#form')[0].reset()
        $('#image').attr('src', 'https://i.pinimg.com/736x/30/3a/df/303adffc97f75b29b90194b93d857f43.jpg')
    })

    $(document).on('click', '.edit', function(){
        $('#save').hide()
        $('#update').show()
        $('#exampleModalLabel').text('Update Book')
        const row = $(this).closest('tr')
        const id = row.find('td:eq(0)').text().trim()
        const image = row.find('td:eq(1) img').attr('src')
        const title = row.find('td:eq(2)').text().trim()
        const author = row.find('td:eq(3)').text().trim()
        const category = row.find('td:eq(4)').text().trim()
        const price = row.find('td:eq(5)').text().trim().replace('$', '')
        $('#price').val(price)
        const quantity = row.find('td:eq(6)').text().trim()
        const publish_year = row.find('td:eq(7)').text().trim()

        $('#title').val(title)
        $('#author').val(author)
        $('#category').val(category)
        $('#price').val(price)
        $('#quantity').val(quantity)
        $('#publish_year').val(publish_year)
        $('#image').attr('src', image)
        $('#id').val(id)

        $('#form').attr('action', '/edit/' + id)
    })


    $('#file').hide()
    $('#image').click(function(){
        $('#file').click()
    })
    $('#file').change(function(){
        const file = this.files[0];
        if(file){
            const image = URL.createObjectURL(file)
            $('#image').attr('src', image)
        }
    })

})
</script>