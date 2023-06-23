<?php
session_start();
include 'server/connection.php';
include 'server/query_products.php';
?>

<?php include 'layouts/header.php' ?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
			<div class="col-first">
				<h1>Shop Category page</h1>
				<nav class="d-flex align-items-center">
					<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
					<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
					<a href="category.html">Fashon Category</a>
				</nav>
			</div>
		</div>
	</div>
</section>
<!-- End Banner Area -->
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4 col-md-5">
			<div class="sidebar-categories">
				<div class="head">Browse Categories</div>
				<ul class="main-categories">
					<li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable"><span class="lnr lnr-arrow-right"></span>Shoes Categories<span class="number">(<?php $totalProduct = mysqli_query($conn, "SELECT COUNT(product_name) FROM products");
																																																										$row = mysqli_fetch_assoc($totalProduct);
																																																										$total = $row["COUNT(product_name)"];

																																																										echo $total ?>)</span></a>
						<ul class="collapse" id="fruitsVegetable" data-toggle="collapse" aria-expanded="false" aria-controls="fruitsVegetable">
							<li class="main-nav-list child"><a href="#">All Categories<span class="number">(<?php $totalProduct = mysqli_query($conn, "SELECT COUNT(product_name) FROM products");
																											$row = mysqli_fetch_assoc($totalProduct);
																											$total = $row["COUNT(product_name)"];

																											echo $total ?>)</span></a></li>
							<li class="main-nav-list child"><a href="#">Casual<span class="number">(<?php $totalProduct = mysqli_query($conn, "SELECT COUNT(product_name) FROM products WHERE product_category='casual'");
																									$row = mysqli_fetch_assoc($totalProduct);
																									$total = $row["COUNT(product_name)"];

																									echo $total ?>)</span></a></li>
							<li class="main-nav-list child"><a href="#">Sporty<span class="number">(<?php $totalProduct = mysqli_query($conn, "SELECT COUNT(product_name) FROM products WHERE product_category='sport'");
																									$row = mysqli_fetch_assoc($totalProduct);
																									$total = $row["COUNT(product_name)"];

																									echo $total ?>)</span></a></li>
							<li class="main-nav-list child"><a href="#">Unisex<span class="number">(<?php $totalProduct = mysqli_query($conn, "SELECT COUNT(product_name) FROM products WHERE product_category='unisex'");
																									$row = mysqli_fetch_assoc($totalProduct);
																									$total = $row["COUNT(product_name)"];

																									echo $total ?>)</span></a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="sidebar-filter mt-50">
				<div class="top-filter-head">Product Filters</div>
				<div class="common-filter">
					<div class="head">Brands</div>
					<form action="#">
						<ul>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple">Adidas</label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="asus" name="brand"><label for="asus">Nike</label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="gionee" name="brand"><label for="gionee">New Balance</label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="micromax" name="brand"><label for="micromax">Puma</label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="samsung" name="brand"><label for="samsung">Ventela</label></li>
						</ul>
					</form>
				</div>
				<div class="common-filter">
					<div class="head">Color</div>
					<form action="#">
						<ul>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black
									Leather<span>(29)</span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black
									with red<span>(19)</span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
							<li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
						</ul>
					</form>
				</div>
				<div class="common-filter">
					<div class="head">Price</div>
					<div class="price-range-area">
						<div id="price-range"></div>
						<div class="value-wrapper d-flex">
							<div class="price">Price:</div>
							<span>Rp</span>
							<div id="lower-value"></div>
							<div class="to">to</div>
							<span>Rp</span>
							<div id="upper-value"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-8 col-md-7">
			<!-- Start Filter Bar -->
			<div class="filter-bar d-flex flex-wrap align-items-center">
				<div class="sorting">
					<select>
						<option value="1">Default sorting</option>
						<option value="1">Default sorting</option>
						<option value="1">Default sorting</option>
					</select>
				</div>
				<div class="sorting mr-auto">
					<select>
						<option value="1">Show 3</option>
						<option value="1">Show 6</option>
						<option value="1">Show 9</option>
					</select>
				</div>
				<div class="pagination">
					<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
					<a href="#" class="active">1</a>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<a href="#">6</a>
					<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
				</div>
			</div>
			<!-- End Filter Bar -->
			<!-- Start Best Seller -->
			<section class="lattest-product-area pb-40 category-list">
				<div class="row">
					<?php while ($row = mysqli_fetch_assoc($result_all_products)) : ?>
						<!-- single product -->
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
								<img class="img-fluid" src="img/product/<?php echo $row['product_image1'] ?>" alt="">
								<div class="product-details">
									<h6><?php echo $row['product_name'] ?></h6>
									<div class="price">
										<h6><?php echo setRupiah(($row['special_offer'] * $kurs_dollar)) ?></h6>
										<h6 class="l-through"><?php echo setRupiah(($row['product_price'] * $kurs_dollar))   ?></h6>
									</div>
									<div class="prd-bottom">

										<a href="<?php echo "single-product.php?product_id=" . $row['product_id'] ?>" class="social-info">
											<span class="ti-bag"></span>
											<p class="hover-text">add to bag</p>
										</a>
										<a href="#" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Wishlist</p>
										</a>
										<a href="#" class="social-info">
											<span class="lnr lnr-sync"></span>
											<p class="hover-text">compare</p>
										</a>
										<a href="#" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</section>
			<!-- End Best Seller -->
			<!-- Start Filter Bar -->
			<div class="filter-bar d-flex flex-wrap align-items-center">
				<div class="sorting mr-auto">
					<select>
						<option value="1">Show 3</option>
						<option value="1">Show 6</option>
						<option value="1">Show 9</option>
					</select>
				</div>
				<div class="pagination">
					<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
					<a href="#" class="active">1</a>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<a href="#">6</a>
					<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
				</div>
			</div>
			<!-- End Filter Bar -->
		</div>
	</div>
</div>

<!-- Start related-product Area -->
<section class="related-product-area section_gap">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 text-center">
				<div class="section-title">
					<h1>Deals of the Week</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
						magna aliqua.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-9">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
						<div class="single-related-product d-flex">
							<a href="#"><img src="img/r1.jpg" alt=""></a>
							<div class="desc">
								<a href="#" class="title">Black lace Heels</a>
								<div class="price">
									<h6>$189.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
						<div class="single-related-product d-flex">
							<a href="#"><img src="img/r2.jpg" alt=""></a>
							<div class="desc">
								<a href="#" class="title">Black lace Heels</a>
								<div class="price">
									<h6>$189.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
						<div class="single-related-product d-flex">
							<a href="#"><img src="img/r3.jpg" alt=""></a>
							<div class="desc">
								<a href="#" class="title">Black lace Heels</a>
								<div class="price">
									<h6>$189.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
						<div class="single-related-product d-flex">
							<a href="#"><img src="img/r5.jpg" alt=""></a>
							<div class="desc">
								<a href="#" class="title">Black lace Heels</a>
								<div class="price">
									<h6>$189.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
						<div class="single-related-product d-flex">
							<a href="#"><img src="img/r6.jpg" alt=""></a>
							<div class="desc">
								<a href="#" class="title">Black lace Heels</a>
								<div class="price">
									<h6>$189.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
						<div class="single-related-product d-flex">
							<a href="#"><img src="img/r7.jpg" alt=""></a>
							<div class="desc">
								<a href="#" class="title">Black lace Heels</a>
								<div class="price">
									<h6>$189.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="single-related-product d-flex">
							<a href="#"><img src="img/r9.jpg" alt=""></a>
							<div class="desc">
								<a href="#" class="title">Black lace Heels</a>
								<div class="price">
									<h6>$189.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="single-related-product d-flex">
							<a href="#"><img src="img/r10.jpg" alt=""></a>
							<div class="desc">
								<a href="#" class="title">Black lace Heels</a>
								<div class="price">
									<h6>$189.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="single-related-product d-flex">
							<a href="#"><img src="img/r11.jpg" alt=""></a>
							<div class="desc">
								<a href="#" class="title">Black lace Heels</a>
								<div class="price">
									<h6>$189.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="ctg-right">
					<a href="#" target="_blank">
						<img class="img-fluid d-block mx-auto" src="img/category/c5.jpg" alt="">
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End related-product Area -->
<?php include 'layouts/footer.php' ?>