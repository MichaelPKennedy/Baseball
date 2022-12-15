<html>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="teams.php">Teams</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="homerunkings.php">Homerun Kings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="topsalaries.php">Top Salaries</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="topbattingaverages.php">Top Batting Averages</a>
      </li>
    </ul>
    <form id="search" action='search.php' class="form-inline my-2 my-lg-0" method="post" z>
      <div><input id="input" class="form-control mr-sm-2" type="search" placeholder="Name of Player" aria-label="Search" name="term"></div>
      <div><button id="submit" class="btn btn-outline-success my-2 my-sm-0" type="submit" value="search">Search</button></div>
    </form>
  </div>
</nav>