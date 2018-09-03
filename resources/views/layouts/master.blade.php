<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>To-do List</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
</head>
<body>
    <div class="container">
        
        <div class="row">
            <div class="col s12">
                <form action="{{ route('logout') }}" method="POST"">
                    @csrf
                    <p>
                        Log in as <strong>{{Auth::user()->name}}</strong> <button type="submit" class="waves-effect waves-light btn">Logout</button>
                    </p>
                </form>

                @isAdmin
                @if(count($invitations) > 0)
                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header">
                            <i class="material-icons">person_add</i>
                            Invitation
                            <span class="new badge red">{{count($invitations)}}</span>
                        </div>
                        <div class="collapsible-body">
                            @foreach($invitations as $invitation)
                            <p>
                                <span class="red-text"><strong>{{ $invitation->worker->name }}</strong> <a href="{{ route('acceptInv', ['id'=> $invitation->id]) }}">Accept</a> | <a href="{{ route('denyInv', ['id'=> $invitation->id]) }}">Deny</a></span>
                            </p>
                            @endforeach
                        </div>
                    </li>
                </ul>
                @endif
                @endisAdmin
                <h1 class="center-align green-text">To-do List</h1>
            </div>
        </div>
        @yield('content')
    </div>

    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
    <script>
        var elems = document.querySelectorAll('.collapsible');
        var options;
        var instances = M.Collapsible.init(elems, options);

        var elems2 = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems2);
    </script>
  </body>
</html>