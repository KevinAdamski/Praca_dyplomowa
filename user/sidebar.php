<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
	@import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

body {
    font-family: 'Lato';
    background-color: #F2F2F2;
}

.content {
    height: 100%;
    display: flex;
    align-items: left;
    justify-content: left;
}

.sidebar {
    width: 300px;
	height: 350px;
    display: block;
    background-color: #FFFFFF;
    border-radius: 25px;
    padding-bottom: 35px;
}


.sidebar__item {
    display: flex;
    text-decoration: none;
    margin-top: 25px;
    padding-right: 15px;
    margin-left: 20px;
    padding-left: 20px;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-top: 10px
}

.sidebar__item:hover {
    background-color: #519BDF33;
    border-radius: 200px;
    width: fit-content;
}

.sidebar__item:hover i,
.sidebar__item:hover span {
    color: #0b5ed7 !important;
}

.sidebar__item__icon {
    display: flex;
    align-items: center;
    color: #5B5C5E;
    font-size: 28px !important;
}

.sidebar__item__text {
    display: flex;
    align-items: center;
    color: #5B5C5E;
    font-weight: bold;
    padding-left: 25px;
    font-size: 30px;
}



	</style>
</head>
<body>
	<div class="d-none d-sm-block d-sm-none d-md-block d-md-none d-lg-block">
	<div class="col-3">
    <div class="content">
        <div class="sidebar">
            <div class="sidebar__brand">
            </div>
            <a href="https://serwer2241105.home.pl/user/" class="sidebar__item">
                <i class="sidebar__item__icon fa fa-align-left"></i>
                <span class="sidebar__item__text">Aktualne</span>
            </a>

            </a>
            <a href="https://serwer2241105.home.pl/user/qadd.php" class="sidebar__item">
                <i class="sidebar__item__icon fa fa-plus"></i>
                <span class="sidebar__item__text">Dodaj</span>
			</a>
			 <a href="https://serwer2241105.home.pl/user/team.php" class="sidebar__item">
                <i class="sidebar__item__icon fa fa-users"></i>
                <span class="sidebar__item__text">Zespoły</span>
			</a>
        </div>
    </div>
	</div>
	</div>
</body>
</html>
