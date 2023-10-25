<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog-form</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-confirm.min.css') }}">
</head>

<body>
    <header>
        <nav class="navbar bg-dark">
            <div class="container-fluid">
                <div>
                    <a class="navbar-brand text-white bold" href="/">BLOG</a>
                </div>
                <form class="d-flex">
                    <input class="form-control me-3" type="search" placeholder="Rechercher un blog">
                    <button class="btn btn-success" type="submit">Rechercher</button>
                </form>
            </div>

        </nav>
    </header>

    <section class="container">
        @if ($errors->any())
    <div class="alert alert-danger mt-3" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <h2 class="muted text-center mt-5">Vous pouvez ajouter votre article sur le blog des etudiants de l'ecole229</h2>
        <form class="p-3 mt-2" id="form" enctype="multipart/form-data">
            @csrf
            <input value="{{ old("title") }}" name="title" class="form-control mb-4" type="text" placeholder="Objet">
            <input name="picture" class="form-control mb-4" type="file" placeholder="Ajouter une image">
            <textarea name="content" class="form-control mb-4" name="" rows="8" placeholder="Description">{{ old("content") }}</textarea>
            <button type="submit" class="btn btn-primary add">Enregistrer</button>
        </form>
    </section>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
    <script>
        $('.add').click(function(e){
            e.preventDefault();
    
            $.confirm({
                title : "Confirmation !",
                type : "blue",
                content : "Voulez vous enregistrer ces informations ?",
                buttons :{
                    Oui :{
                        btnClass : "btn-success",
                        action : function(){
                            var self = this;
                            var dataForm = $('#form').serialize();
                            $.ajax({
                                url: "{{ route('blogStore') }}",
                                type: 'POST',
                                data: dataForm,
                                beforeSend: function(){
                                    self.showLoading(true);
                                    self.buttons.Oui.hide();
                                    self.buttons.Non.hide();
                                },
                                success: function(response){
                                    $('#form').trigger('reset');
                                    self.hideLoading(true);
                                    self.setType('green');
                                    self.setContent(`${response.message}`);
                                    self.buttons.Oui.hide();
                                    self.buttons.Non.show();
                                    self.buttons.Non.setText('Fermer');
                                },
                                error: function(){
                                    return false;
                                }
                            })
                            return false;
                        }
                    },
                    Non :{
                        btnClass: "btn-danger",
                        action: function(){
                            return true;
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>