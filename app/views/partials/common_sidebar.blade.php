<div id="common-sidebar">
  <div class="list-group">
    <a class="list-group-item " href="/">
        <h1 class=""><img class="img-rounded portrait portrait-s" alt="Yahtzee" src="{{asset('/img/yahtzee-nt.png')}}"/>&nbsp;Yahtzee</h1>
    </a>
    <a  href="#" data-target="#rules-modal" data-toggle="modal" class="list-group-item">
      <h4 class="list-group-item-heading">Rules</h4>
      <p class="list-group-item-text">Check our Yahtzee game rules and get ready to play</p>
    </a>
    <a href="/game" class="list-group-item {{ isset($sidebar_game)? 'active' : ''}}">
      <h4 class="list-group-item-heading">Games</h4>
      <p class="list-group-item-text">Some kind of description</p>
    </a>
    <a href="/tournaments" class="list-group-item {{ isset($sidebar_tournament)? 'active' : ''}}">
      <h4 class="list-group-item-heading">Tournaments</h4>
      <p class="list-group-item-text">See all tournaments</p>
    </a>
    <a href="/replay" class="list-group-item {{ isset($sidebar_replay)? 'active' : ''}}">
      <h4 class="list-group-item-heading">Replays</h4>
      <p class="list-group-item-text">Some kind of description</p>
    </a>
    <a href="/calendar" class="list-group-item {{ isset($sidebar_calendar)? 'active' : ''}}">
      <h4 class="list-group-item-heading">Calendar</h4>
      <p class="list-group-item-text">Some kind of description</p>
    </a>
    <a href="/ranking" class="list-group-item {{ isset($sidebar_ranking)? 'active' : ''}}">
      <h4 class="list-group-item-heading">Ranking</h4>
      <p class="list-group-item-text">Some kind of description</p>
    </a>
  </div>
</div>
