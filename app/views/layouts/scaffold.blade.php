<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>Yahtzee</title>
</head>
<body>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-th">Yahtzee</span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#" data-target="#myModal" data-toggle="modal">Rules</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                   @if (Auth::check())
                   <li><a href="/logout">Log Out</a></li>
                   <li><a href="/profile">{{ Auth::user()->first_name }}</a></li>
                   @else
                   <li><a href="/user/create">Register</a></li>
                   <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @include('users.login')
                        <li class="divider"></li>
                        <li><a href="/user/create">Register</a></li>
                        <li><a href="#">Forgot password</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Rules</h4>
            </div>
            <div class="modal-body">
                <div id="rules-page" class="inner-page">
                    <h2>Yahtzee Rules</h2>

                    <p>
                        The objective of YAHTZEE is to get as many points as possible by rolling five dice and getting certain combinations of dice.
                    </p>
                    <h3>Gameplay</h3>
                    <p>
                        In each turn a player may throw the dice up to three times. A player doesn't have to roll all five dice on the second and third throw of a round, he may put as many dice as he wants to the side and only throw the ones that don't have the numbers he's trying to get. For example, a player throws and gets 1,3,3,4,6. He decides he want to try for the small straight, which is 1,2,3,4,5. So, he puts 1,3,4 to the side and only throws 3 and 6 again, hoping to get 2 and 5.
                    </p>
                    <p>
                        In this game you click on the dice you want to keep. They will be moved down and will not be thrown the next time you press the 'Roll Dice' button. If you decide after the second throw in a turn that you don't want to keep the same dice before the third throw then you can click them again and they will move back to the table and be thrown in the third throw.
                    </p>
                    <h3>Upper section combinations</h3>
                    <ul>
                        <li><b>Ones: </b>Get as many ones as possible.</li>
                        <li><b>Twos: </b>Get as many twos as possible.</li>
                        <li><b>Threes: </b>Get as many threes as possible.</li>
                        <li><b>Fours: </b>Get as many fours as possible.</li>
                        <li><b>Fives: </b>Get as many fives as possible.</li>
                        <li><b>Sixes: </b>Get as many sixes as possible.</li>
                    </ul>
                    <p>
                        For the six combinations above the score for each of them is the sum of dice of the right kind. E.g. if you get 1,3,3,3,5 and you choose Threes you will get 3*3 = 9 points. The sum of all the above combinations is calculated and if it is 63 or more, the player will get a bonus of 35 points. On average a player needs three of each to reach 63, but it is not required to get three of each exactly, it is perfectly OK to have five sixes, and zero ones for example, as long as the sum is 63 or more the bonus will be awarded.
                    </p>
                    <h3>Lower section combinations</h3>
                    <ul>
                        <li><b>Three of a kind: </b>Get three dice with the same number. Points are the sum all dice (not just the three of a kind).</li>
                        <li><b>Four of a kind: </b>Get four dice with the same number. Points are the sum all dice (not just the four of a kind).</li>
                        <li><b>Full house: </b>Get three of a kind and a pair, e.g. 1,1,3,3,3 or 3,3,3,6,6. Scores 25 points.</li>
                        <li><b>Small straight: </b>Get four sequential dice, 1,2,3,4 or 2,3,4,5 or 3,4,5,6. Scores 30 points.</li>
                        <li><b>Large straight: </b>Get five sequential dice, 1,2,3,4,5 or 2,3,4,5,6. Scores 40 points.</li>
                        <li><b>YAHTZEE: </b>Five of a kind. Scores 50 points. In this version of the game there are no YAHTZEE bonuses, so a player can only get YAHTZEE once.</li>
                    </ul>
                    <h3>Strategy tips</h3>
                    <p>
                        Try to get the bonus. Focus on getting good throws with fives and sixes, then it won't matter if you put 0 in the ones or twos. You can always put in 0 for a combination if you don't have it, even if you have some other combination. E.g. if you had 2,3,4,5,6 and the only things you had left were Ones and Sixes, then it would be better to put 0 in Ones than to put only 6 in Sixes.
                    </p>
                    <h3>Maximum score</h3>
                    <p>
                        The maximum possible score is 375, and you would get that by getting 5 ones (5), 5 twos (10), 5 threes (15), 5 fours (20), 5 fives (25), 5 sixes (30), get the bonus points (35), five sixes (30) for three of a kind, five sixes (30) for four of a kind, get a full house (25), get a small straight (30), get a large straight (40), five sixes for chance (30), get a YAHTZEE (50). 5 + 10 + 15 + 20 + 25 + 30 + 35 + 30 + 30 + 25 + 30 + 40 + 30 + 50 = 375!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @if(Session::has('message'))
                <div class="alert-box success">
                    <h2>{{ Session::get('message') }}</h2>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    <div class="container">
        <div class="row">
            @yield('body')
        </div>
    </div>
</body>
</html>
