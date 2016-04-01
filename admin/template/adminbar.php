<style>	
body{
	margin:0;
	padding:0;
	font: 13px arial, sans-serif; 
	font-family: Calibri;
	font-size: 10pt;
}
#admin_header{
	margin-bottom: 10px;
	height: 18px;
	float: left;
	width: 100%;
	background: url('../admin/template/images/bg_panel.png') repeat;
	border-bottom: 1px solid #C9D7F1;
	padding: 5px;	
}

#admin_header a{
	font: 13px arial, sans-serif; 
	color: gray;
	text-decoration: none;
}

#admin_header a:hover{
	color: orange;
}

#admin_header .menu{
	float:left;
	margin-top:1px;
}

#admin_header .menu ul{
	margin:0;
	padding:0;
	list-style:none;
}

#admin_header .menu ul li{
	float:left;
	margin-right:15px;
	padding:0 15px 0 23px;
	border-right:1px solid #C9D7F1;
}


#admin_header .menu li.orders{
	background:url(../admin/template/images/icons/orders.png) 0 50% no-repeat;
}
#admin_header .menu li.categories{
	background:url(../admin/template/images/icons/categories.png) 0 50% no-repeat;
}
#admin_header .menu li.products{
	background:url(../admin/template/images/icons/products.png) 0 50% no-repeat;
}

#admin_header .user{
float:right;
margin-right:15px;
}
</style>

	
	<div id="admin_header">
		<div class="menu">
			<ul>
				<li ><a href="/" id="look">Просмотр магазина</a></li>
				<li class="orders"><a href="/orders" id="orders">Заказы</a></li>
				<li class="products"><a href="/products" id="products">Товары</a></li>
				<li class="categories"><a href="/categories" id="categories">Категории</a></li>
			</ul>
		</div>
		<div class="user">
			<a href="#"><?=$_SESSION["User"]?></a> (<a href="/authorization?out=1">Выход</a>)
		</div>
	</div>
	
	