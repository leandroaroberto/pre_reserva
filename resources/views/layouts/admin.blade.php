<body>
    <div class="container">
    <nav class="navbar navbar-default navbar-static-top">

                    <div class="navbar-header">
                        <h2>Admin - Gerenciar pré-reservas</h2>
                    </div>
                    <div class="navbar-right">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="">Home</a>
                            </li>
                            <li>
                                <a href="">Listar todas</a>
                            </li>
                            <li>
                                {{ Form::open(['action'=>'Auth\LoginController@logout']) }}
                                {{ Form::submit('Logout',['class'=>'btn btn-default']) }}
                                {{ Form::close()}}
                            </li>
                        </ul>
                    </div>   
    </nav>  
        @yield('admin')
    </div>
        
        {{ Html::script('js/jquery-3.2.1.min.js')}}
        {{ Html::script('js/bootstrap.min.js')}}
</body>
</html>