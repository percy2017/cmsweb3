<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>Video conferencias</title>
    </head>
    <body>
        
        <div class="container">
            <br>
            <form id="form" action="" method="post">
                <div class="col-md-12">
                    <div class="card">
                        <h5 class="card-header">Crear video llamada</h5>
                        <div class="card-body">
                            <h5 class="card-title">Ingrese el nombre de la reunión</h5>
                            {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
                            <input type="text" name="name" onkeydown="return /[a-z, ]/i.test(event.key)"
                                onblur="if (this.value == '') {this.value = '';}"
                                onfocus="if (this.value == '') {this.value = '';}"
                                class="form-control" placeholder="Business Meeting" required
                            />
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $('#form').on('submit', function(e){
                    e.preventDefault();
                    let name = escape($('#form input[name="name"]').val());
                    window.location = '{{ url("meet") }}/'+name;
                });
            });
        </script>
    </body>
</html>