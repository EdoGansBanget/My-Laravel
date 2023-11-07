<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.mi
n.css">
    <title>Homepage</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">My CV</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">MY CV</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">CONTACT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">ABOUT ME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">LOGIN</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <div class="container mt-5">
        <div class="text-center mt-2">
            <img src="{{ asset('image/fotosaya.png') }}" class="rounded-circle" width="150">
            <br>
            <br>
            <br>
            <h3 class="mt-2">MUHAMMAD ATTHOILLAH</h3>
            <p>Mahasiswa</p>
        </div>
        <div class="text-center mt-4">
            <p>Hari ini saya belajar framework laravel, dimana hal ini merupakan pengalaman baru saya dibidang rekayasa
                perangkat lunak</p>
        </div>
        <br>
        <table class="table border">
            <tr>
                <td class="col-md-5 ">
                    <h4 class="text-center">Skill</h4>
                    <hr class="text-center">
                    <ul>
                        <li>
                            Programer
                        </li>
                        <li>
                            Pro player dan pro gaming
                        </li>
                        <li>
                            Microsoft word, excel dan Power Point
                        </li>
                    </ul>
                </td>
                <td class="col-md-5">
                    <h4 class="text-center">Pengalaman Organisasi</h4>
                    <hr class="text-center">
                    <ul>
                        <li>
                            Pernah menjadi bagian dari kepanitian
                        </li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <footer class="footer bg-dark text-white text-center py-2 fixed-bottom">
        <p>Copyright 2023 @Atthoillah Corporation</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bund
le.min.js"></script>
</body>

</html>