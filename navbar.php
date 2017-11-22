<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Proeve van Bekwaamheid</a>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
            <ul class="nav navbar-nav navbar-right">
                <li class="logout">
                    <!--            <a href="logout.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Logout</a>-->
                    <form method="POST" action="logout.php">
                        <div style="margin-top: 8px;">
                            <input id="button" type="submit" name="logout" class="btn btn-default" style="float: right" value="Uitloggen">
                        </div>
                    </form>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>